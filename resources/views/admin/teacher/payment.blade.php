@extends("layouts.admin")

@section('content')
    <div class="container">
        <div class="card my-5" id="main-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">

                    <h3>Teacher Payments</h3>
                    <button class="uk-button uk-button-primary uk-margin-small-right" type="button"
                            uk-toggle="target: #modal-example">Make Payment
                    </button>
                </div>
                @include("flash::message")
                <hr>
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="uk-text-bold mb-0">Name</p>
                        <p class="uk-text-middle my-1">{{$teacher->full_name}}</p>
                    </div>
                    <div><p class="uk-text-bold mb-0">Lecture Price</p>
                        <p class="uk-text-middle my-1">{{$teacher->price}}</p></div>
                    <div>
                        <p class="uk-text-bold mb-0">Gender</p>
                        <p class="uk-text-middle my-1">{{$teacher->gender}}</p>
                    </div>
                    <div>
                        <p class="uk-text-bold mb-0">About</p>
                        <p class="uk-text-middle my-1">{{$teacher->about}}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <table class="uk-table uk-table-divider">
                <tbody>
                <tr>
                    <th>Overall Earning</th>
                    <th><p class="uk-text-bold m-0 text-dark">{{$total_earnings}}</p></th>
                </tr>

                <tr>
                    <th>Total Amount Paid</th>
                    <th><p class="uk-text-bold m-0 text-dark">{{$total_paid*(-1)}}</p></th>
                </tr>

                <tr>
                    <th>Remaining amount</th>
                    <th><p class="uk-text-bold m-0 text-dark">{{$total_earnings + $total_paid}}</p></th>
                </tr>
                </tbody>
            </table>
        </div>
        @foreach($formatted_payments as $key => $mon_payment)
            <div class="card my-5">
                <div class="card-body">

                    <p>Month: {{$key}}</p>
                    <table class="uk-table uk-table-divider">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Reference ID</th>
                            <th>Payment Type</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($mon_payment as $payment)
                            <tr>
                                <td>{{$payment->payment_date}}</td>
                                <td>{{$payment->amount}}</td>
                                <td>{{$payment->ref_id}}</td>
                                <td>{{$payment->amount<0?"Paid to teacher":"Class payment"}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="1" class="uk-text-bold">Total</td>
                            <td class="uk-text-bold">{{$monthly_payments[$key]??0}}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        @endforeach
    </div>
    <!-- This is the modal -->
    <div id="modal-example" uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <h3>Add Payment</h3>
            <hr>
            <table class="uk-table">
                <tbody>
                <tr>
                    <th>Remaining amount</th>
                    <th>{{$total_earnings + $total_paid}}</th>
                </tr>
                </tbody>
            </table>
            <form action="{{route('admin.teacher.payment.create',$teacher->id)}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" id="amount" name="amount" required min="1" max="{{$total_earnings + $total_paid}}" value="{{$total_earnings + $total_paid}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="ref_id">Reference ID</label>
                    <input type="text" id="ref_id" name="ref_id" required class="form-control">
                </div>
                <p class="uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="reset">Cancel</button>
                    <button class="uk-button uk-button-primary" type="submit" {{($total_earnings + $total_paid)==0?'disabled="disabled"':"false"}}>Save</button>
                </p>
            </form>
        </div>
    </div>
@endsection
