@extends('layouts.app')

@section('content')
<script src="https://www.paypal.com/sdk/js?client-id={{$paypal_settings->client_id}}&currency={{$paypal_settings->currency}}"></script>

<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-8 m-auto mt-3">
            <div class="card">
                <div class="card-header">
                    <h3>Payment Page</h3>
                </div>
                <div class="loader-container  d-none" style="z-index:9999;width:100%;height:100%;max-width:100%;background-color:#f4f7f9ab">
                    <div class="loader">
                        <div class="spinner">
                            <div class="rect1"></div>
                            <div class="rect2"></div>
                            <div class="rect3"></div>
                            <div class="rect4"></div>
                            <div class="rect5"></div>
                        </div>
                    </div>
                </div>
                <div class="card-body payments">
                    @if($trail)
                    <div class="d-flex-between-center">
                        <label class="custom-control custom-radio">
                            <input type="radio" name="lesson" value="0" class="custom-control-input" <?php echo $trail ? "checked" : "" ?>>
                            Trail Lesson
                        </label>
                        <div>
                            <p class="text-green text-right">{{$teacher->trail_price>0?"$ $teacher->trail_price":'Free'}}</p>
                            @if($teacher->trail_price <= 0) <small>A small amount of 0.01 will be charged for trail lesson</small>
                                @endif
                        </div>
                    </div>
                    @endif
                    <div class="d-flex-between-center">
                        <label class="custom-control custom-radio">
                            <input type="radio" name="lesson" value="1" class="custom-control-input" <?php echo !$trail ? "checked" : "" ?>>
                            1 Lesson
                        </label>
                        <p class="text-green">$ {{$teacher->price - ($teacher->price*$teacher->discount)/100}}</p>
                    </div>
                    <!-- <div class="d-flex-between-center">
                        <label class="custom-control custom-radio">
                            <input type="radio" name="lesson" value="5" class="custom-control-input">
                            5 Lesson
                        </label>
                        <p class="text-green">$ {{5*$teacher->price - (($teacher->price*5)*$teacher->discount)/100}}</p>
                    </div>
                    <div class="d-flex-between-center">
                        <label class="custom-control custom-radio">
                            <input type="radio" name="lesson" value="10" class="custom-control-input">
                            10 Lesson
                        </label>
                        <p class="text-green">$ {{10*$teacher->price - (($teacher->price*10)*$teacher->discount)/100}}</p>
                    </div>
                    <div class="d-flex-between-center">
                        <label class="custom-control custom-radio">
                            <input type="radio" name="lesson" id="lesson" value="15" class="custom-control-input">
                            15 Lesson
                        </label>
                        <p class="text-green">$ {{15*$teacher->price - (($teacher->price*15)*$teacher->discount)/100}}</p>
                    </div> -->
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <div id="paypal-button-container" class=" d-flex justify-content-end" style="width:250px;"><button id="next" class="btn btn-primary">{{$trail?"Book Lesson":"Continue to Payment"}}</button></div>
                </div>
            </div>
            <!-- <form class="form form-horizontal" method="POST" action="/payments/completed">
                @csrf
                <input type="hidden" name="is_dummy" value="1">
                <input type="hidden" name="teacher_id" value="{{$teacher->id}}">
                <div class="form-group">
                    <input class="form-control" id="payment-amount" type="text" name="amount" placeholder="Course Fee" value="{{$teacher->price}}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form> -->
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var value = parseFloat('<?php echo $teacher->price; ?>');
        var discount = parseFloat('<?php echo $teacher->discount; ?>');
        $('#next').click(function() {
            $(this).remove()
            var lesson = $('input[name=lesson]:checked').val();
            if (lesson != 0)
                value = parseFloat((value * lesson) - ((value * lesson) * discount) / 100);
            else {
                value = parseFloat('<?php echo $teacher->trail_price > 0 ? $teacher->trail_price : 0.01; ?>');
            }
            $('input[name=lesson]').attr('disabled', 'disabled');
            if(lesson != 0) {


                paypal.Buttons({ // initialize payment button
                    style: {
                        layout: 'horizontal'
                    },
                    // Set up the transaction
                    createOrder: function (data, actions) { // this will be executed when user initiate payment process
                        return actions.order.create({
                            purchase_units: [{
                                reference_id: '<?php echo 'order-' . Auth::user()->id . '-' . $teacher->id; ?>',
                                amount: {
                                    value: value
                                },
                                description: 'Test payment'
                            }],
                            application_context: {
                                shipping_preference: 'NO_SHIPPING'
                            }
                        });
                    },
                    // Finalize the transaction
                    onApprove: function (data, actions) {
                        return actions.order.capture().then(function (details) {
                            // When the payment is captured by Paypal, it will return captured info, we can use this to create ref in our db
                            $.ajax({
                                url: "/payments/completed?start={{$start}}&end={{$end}}" + "<?php echo $trail ? "&is_trial=1" : ""; ?>",
                                type: 'POST',
                                data: {
                                    _token: $('meta[name="csrf-token"]').attr('content'),
                                    teacher_id: '{{$teacher->id}}',
                                    details: details
                                },
                                beforeSend: function () {
                                    $('.loader-container').removeClass('d-none').addClass('d-block');
                                },
                                dataType: 'json',
                                success: function (response) {
                                    if (response.status == 'success') {
                                        location.href = '/payments/success?id=' + response.pid;
                                    } else {
                                        alert('Something went wrong');
                                    }
                                },
                                error: function (error) {
                                    $('.loader-container').removeClass('d-block').addClass('d-none');
                                    alert('Something went wrong');
                                }
                            });
                        });
                    }
                }).render('#paypal-button-container');
            }else{
                $.ajax({
                    url: "/payments/completed?start={{$start}}&end={{$end}}" + "<?php echo $trail ? "&is_trial=1" : ""; ?>",
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        teacher_id: '{{$teacher->id}}',
                    },
                    beforeSend: function() {
                        $('.loader-container').removeClass('d-none').addClass('d-block');
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            // console.log(response)
                            location.href = '/payments/success?id=' + response.pid;
                        } else {
                            alert('Something went wrong');
                        }
                    },
                    error: function(error) {
                        $('.loader-container').removeClass('d-block').addClass('d-none');
                        alert('Something went wrong');
                    }
                });
            }
        })

    });
</script>
@endsection
