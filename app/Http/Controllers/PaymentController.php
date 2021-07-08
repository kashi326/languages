<?php

namespace App\Http\Controllers;


use App\Events\PaymentReceived;
use App\FreeTrail;
use App\Notifications\BookingConfirmation;
use App\Notifications\PaymentReceived as NotificationsPaymentReceived;
use App\Payments;
use App\Teacher;
use App\TeacherTiming;
use App\User;
use App\UserRegisterWithTeacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teacher_id = request()->get('teacher_id');
        $start = request()->get('start');
        $end = request()->get('end');
        $trail = false;
        if (request()->has('is_trial')) {
            $trail = !(FreeTrail::where('user_id', Auth::id())->where('teacher_id', $teacher_id)->exists());
        }
        $teacher = Teacher::find($teacher_id);
        $paypal_settings = (object)config()->get('paypal');
        return view('payments.index', compact(['teacher', 'paypal_settings', 'start', 'end', 'trail']));
    }

    public function completed()
    {
        $user_id = auth()->user()->id;
        $teacher_id = request()->post('teacher_id');
        $payment_notification = [];
        $payment_id = 0;
        $stime = Carbon::parse(request()->get('start'))->toTimeString();
        $etime = Carbon::parse(request()->get('end'))->toTimeString();
        $timing = TeacherTiming::whereTime('open', '>', $stime)->whereTime('close', '>', $etime)->first();
        if ($timing == null) {
            return response()->json(['status' => 'success', 'pid' => 0]);
        }
        $teacher = Teacher::find($teacher_id);
        $teacher_user = User::find($teacher->user_id);
        if (request()->has('is_trial')) {
            $user = User::find($user_id);
            $lesson = new UserRegisterWithTeacher;
            $lesson->user_id = $user_id;
            $lesson->timing_id = $timing->id;
            $lesson->teacher_id = $teacher_id;
            $lesson->scheduled_date = request()->get('start');
            $lesson->save();
            $free_trail = new FreeTrail;
            $free_trail->user_id = request()->user()->id;
            $free_trail->teacher_id = $teacher_id;
            $free_trail->save();
            $user->notify(new BookingConfirmation($lesson));
            $teacher_user->notify(new BookingConfirmation($lesson));
            return response()->json(['status' => 'success', 'pid' => 1]);
        } else {
            $data = request()->post('details');
            $purchase_units = isset($data['purchase_units']) ? $data['purchase_units'] : NULL;
            $capture = NULL;
            if ($purchase_units) {
                $purchase_unit = array_shift($purchase_units); // get first element from array
                if ($purchase_unit && isset($purchase_unit['payments']['captures'])) {
                    $capture = array_shift($purchase_unit['payments']['captures']); // get first element from array
                }
            }
            if ($capture) {
                // lets verify if it was a valid capture or not
                //   dd($capture);
                $payment_capture = $this->_verifyPaypalCapture($data['id']);
                if ($payment_capture && $data['status'] == 'COMPLETED') {
                    $p = new Payments();
                    $p->teacher_id = $teacher_id;
                    $p->user_id = $user_id;
                    $p->ref_id = $payment_capture['id'];
                    $p->amount = $payment_capture['amount']['value'];
                    $p->save();

                    $payment_id = $p->id;
                    $user = User::find($user_id);
                    $user->notify(new NotificationsPaymentReceived($p));

                    $teacher_user->notify(new NotificationsPaymentReceived($p));

                    $payment_notification['ref_id'] = $p->id;
                    $payment_notification['amount'] = $capture['amount']['value'] . $capture['amount']['currency_code'];
                    event(new PaymentReceived($payment_notification)); // Trigger pusher update
                } else {
                    $payment_notification['ref_id'] = 'NULL';
                    $payment_notification['amount'] = 'FAILED';
                    event(new PaymentReceived($payment_notification)); // Trigger pusher update
                }
                $lesson = new UserRegisterWithTeacher;
                $lesson->user_id = $user_id;
                $lesson->timing_id = $timing->id;
                $lesson->teacher_id = $teacher_id;
                $lesson->scheduled_date = request()->get('start');
                $lesson->save();
                if (request()->has('is_trial')) {
                    $free_trail = new FreeTrail;
                    $free_trail->user_id = request()->user()->id;
                    $free_trail->teacher_id = $teacher_id;
                    $free_trail->save();
                }
                $user->notify(new BookingConfirmation($lesson));
                $teacher_user->notify(new BookingConfirmation($lesson));
            }
        }
        if (request()->ajax()) {
            return response()->json(['status' => 'success', 'pid' => $payment_id]);
        } else {
            return redirect('payments/success?id=' . $payment_id);
        }
    }

    private function _verifyPaypalCapture($order_id)
    {
        $paypal_settings = (object)config()->get('paypal');

        $base_url = $paypal_settings->environment == 'sandbox' ? 'https://api.sandbox.paypal.com/' : 'https://api.paypal.com/';

        $response = Http::send('POST', $base_url . 'v1/oauth2/token', [
            'auth' => [$paypal_settings->client_id, $paypal_settings->client_secret],
            'headers' => [
                'Content-Type: application/json',
                'Accept-Language: en_US'
            ],
            'body' => 'grant_type=client_credentials'
        ]);
        if ($response->ok()) {
            $resp_data = (object)$response->json();

            if (empty($resp_data->access_token) == FALSE) {
                $response2 = Http::withToken($resp_data->access_token)->get($base_url . 'v2/checkout/orders/' . $order_id);
                if ($response2->ok()) {
                    $data = $response2->json();
                    $purchase_units = isset($data['purchase_units']) ? $data['purchase_units'] : NULL;
                    $capture = NULL;
                    if ($purchase_units) {
                        $purchase_unit = array_shift($purchase_units); // get first element from array
                        if ($purchase_unit && isset($purchase_unit['payments']['captures'])) {
                            $capture = array_shift($purchase_unit['payments']['captures']); // get first element from array
                        }
                    }
                    if ($capture) {
                        return $capture;
                    }
                }
            }
        }
        return NULL;
    }

    public function success()
    {
        $success = request()->get('id') ? true : false;
        return view('payments.success', compact('success'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getPayments()
    {
    }
}
