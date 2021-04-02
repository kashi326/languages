@extends('layouts.app')
@section('content')
    <div class="container CheckoutBase margin-top-xl GiftCheckout">
        <div class="row">
            <div class="col-12">
                <h1 class="margin-bottom-xl">Checkout</h1>
            </div>
            <div class="col-md-6 col-12">
                <div class="panel-heading" style="background-color: gainsboro; border-radius: 15px 15px 0 0">
                    <div class="flex flex-align-center">
                        <div class="row" style="padding:0 0 0 10px">
                            <h2 class="col-12">1. Payment</h2>
                            <h6 class="col-12" style="margin: -12px 0 0 0">Pick a payment </h6>
                        </div>
                    </div>
                </div>
                <div class="panel-body" style="padding:10px 0 2px 10px; background-color:white;border-radius:0 0 15px 15px">
                    <ul class="CheckoutBase--PanelList list-unstyled">
                        <img src="{{ asset('/images/paypal2.png') }}" alt="Paypal">

                    </ul>
                    <ul>
                        <a type="button" data-toggle="modal" data-target="#myModal">
                        <img src="{{ asset('/images/mastercard.png') }}" alt="mastercard">
                        <img src="{{ asset('/images/visa.png') }}" alt="visa">
                        <img src="{{ asset('/images/american-express.png') }}" alt="american-express"></a>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="CheckoutSummary"><iframe src="/paypal_context" __idm_frm__="539"
                        style="display: none;"></iframe>
                    <div style=" padding: 10px;background-color:white;border-radius: 15px">
                        <div class="panel-body">

                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">

                                    <div class="text-center flex flex-direction-column flex-align-center flex-justify-content-center"
                                        style="padding: 15px;">
                                        <div
                                            class="GiftCheckoutSummary--Logo flex flex-align-center flex-justify-content-center">
                                            <img alt="Verbling Logo" height="33.64567128542153" width="150"
                                                class="VerblingLogo"
                                                src="https://cdn.verbling.com/static/svg/6fa1864fd902094a6bb600ebf9368d96.logo.svg">
                                        </div>
                                        <h1 class="margin-top-xl"><span
                                                class="currency-converter ">{{ $req->amount }}$</span></h1>
                                    </div>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Product</b> <a class="float-right">Gift Card</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Price</b> <a class="float-right">{{ $req->amount }}$</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Fee</b> <a class="float-right">0</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b></b> <a class="float-right">{{ $req->amount * 158 }}PKr</a>
                                        </li>
                                        <li class="list-group-item" style="background-color: red">
                                            <b>Total</b> <a class="float-right">{{ $req->amount }}$</a>
                                        </li>
                                    </ul>


                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <div style="padding: 20px">
                            <a href="#" class="btn btn-primary btn-block"><b>Complete Secure Checkout</b></a>
                        </div>
                        <div style="padding:0 22%">
                            <img class="margin-sm"
                                src="https://cdn.verbling.com/static/img/checkout/cc2a83074951de14fc68b6606ca94ddc.mcafee-seal.png"
                                style="height: 50px;"><img class="margin-sm"
                                src="https://cdn.verbling.com/static/img/checkout/3bc9251c4c9e252f7c4fbfb350b72012.norton-secured-seal.png"
                                style="height: 50px;"><img class="margin-sm"
                                src="https://cdn.verbling.com/static/img/checkout/54d52a800ca107dd27b6ae8d7960088f.paypal-verfied-seal.jpg"
                                style="height: 50px;">
                        </div>
                    </div>
                </div>
                <div class="text-fine margin-bottom-md">
                    <div class="margin-bottom-md"><small> All purchases are in USD. Foreign
                            transaction fees might apply, according to your bank's policies.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-content" role="document">
                    <div class="modal-header"><button type="button" class="close"><span aria-hidden="true">×</span><span
                                class="sr-only">Close</span></button>
                        <h4 class="modal-title">
                            <h2 class="col-12 margin-bottom-xl">Add Credit Card</h2>
                        </h4>
                    </div>
                    <div class="direction-ltr modal-body">
                        <div class="CCInputBox">
                            <form>
                                <div class="form-group--focuser form-group"><label for="cc-name">Name on card</label>
                                            <i class="fa fa-male"></i>
                                                <input placeholder="Joe Smith" type="text" class="form-control--focuser form-control" value=""></span></div>
                                <div class="form-group--focuser form-group"><label for="cc-number">Card number</label>
                                    <input placeholder="1234 1234 1234 1234" type="number" class="form-control--focuser form-control" value="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group--focuser form-group"><label for="cc-number">Expiration
                                                date</label><span class="input-group--focuser input-group"><span
                                                    class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <div class="form-control CCInputBox__Stripe StripeElement--empty">
                                                    <div class="__PrivateStripeElement"
                                                        style="margin: 0px !important; padding: 0px !important; border: none !important; display: block !important; background: transparent !important; position: relative !important; opacity: 1 !important;">
                                                        <iframe frameborder="0" allowtransparency="true" scrolling="no"
                                                            name="__privateStripeFrame00212" allowpaymentrequest="true"
                                                            src="https://js.stripe.com/v3/elements-inner-card-62df904df783e639ba3050be6f05093f.html#style[base][fontSize]=18px&amp;style[base][letterSpacing]=-0.028rem&amp;style[base][color]=%234f5457&amp;style[base][fontFamily]=%22MBGrotesk%22%2C+sans-serif&amp;style[base][::placeholder][color]=%23b7b7b7&amp;componentName=cardExpiry&amp;wait=false&amp;rtl=false&amp;keyMode=live&amp;apiKey=pk_live_VGLb6bpmAkF8dxZzEYrAiY2l&amp;origin=https%3A%2F%2Fwww.verbling.com&amp;referrer=https%3A%2F%2Fwww.verbling.com%2Fsettings%2Fprofile%2Fpayment&amp;controllerId=__privateStripeController0021"
                                                            title="Secure expiration date input frame"
                                                            style="border: none !important; margin: 0px !important; padding: 0px !important; width: 1px !important; min-width: 100% !important; overflow: hidden !important; display: block !important; user-select: none !important; transform: translateZ(0px) !important; height: 21.6px;"></iframe><input
                                                            class="__PrivateStripeElement-input" aria-hidden="true"
                                                            aria-label=" " autocomplete="false" maxlength="1"
                                                            style="border: none !important; display: block !important; position: absolute !important; height: 1px !important; top: 0px !important; left: 0px !important; padding: 0px !important; margin: 0px !important; width: 100% !important; opacity: 0 !important; background: transparent !important; pointer-events: none !important; font-size: 16px !important;">
                                                    </div>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group--focuser form-group"><label for="cc-number"
                                                style="white-space: nowrap;"><span class="isolate">Security Code</span> <i
                                                    class="fa fa-question-circle"></i></label><span
                                                class="input-group--focuser input-group"><span class="input-group-addon"><i
                                                        class="fa fa-lock"></i></span>
                                                <div class="form-control CCInputBox__Stripe StripeElement--empty">
                                                    <div class="__PrivateStripeElement"
                                                        style="margin: 0px !important; padding: 0px !important; border: none !important; display: block !important; background: transparent !important; position: relative !important; opacity: 1 !important;">
                                                        <iframe frameborder="0" allowtransparency="true" scrolling="no"
                                                            name="__privateStripeFrame00213" allowpaymentrequest="true"
                                                            src="https://js.stripe.com/v3/elements-inner-card-62df904df783e639ba3050be6f05093f.html#style[base][fontSize]=18px&amp;style[base][letterSpacing]=-0.028rem&amp;style[base][color]=%234f5457&amp;style[base][fontFamily]=%22MBGrotesk%22%2C+sans-serif&amp;style[base][::placeholder][color]=%23b7b7b7&amp;componentName=cardCvc&amp;wait=false&amp;rtl=false&amp;keyMode=live&amp;apiKey=pk_live_VGLb6bpmAkF8dxZzEYrAiY2l&amp;origin=https%3A%2F%2Fwww.verbling.com&amp;referrer=https%3A%2F%2Fwww.verbling.com%2Fsettings%2Fprofile%2Fpayment&amp;controllerId=__privateStripeController0021"
                                                            title="Secure CVC input frame"
                                                            style="border: none !important; margin: 0px !important; padding: 0px !important; width: 1px !important; min-width: 100% !important; overflow: hidden !important; display: block !important; user-select: none !important; transform: translateZ(0px) !important; height: 21.6px;"></iframe><input
                                                            class="__PrivateStripeElement-input" aria-hidden="true"
                                                            aria-label=" " autocomplete="false" maxlength="1"
                                                            style="border: none !important; display: block !important; position: absolute !important; height: 1px !important; top: 0px !important; left: 0px !important; padding: 0px !important; margin: 0px !important; width: 100% !important; opacity: 0 !important; background: transparent !important; pointer-events: none !important; font-size: 16px !important;">
                                                    </div>
                                                </div>
                                            </span></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="row">
                                        <div class="CCInputBox--cards col-xl-12 text-center">
                                              <img src="{{ asset('/images/mastercard.png') }}" alt="mastercard">
                        <img src="{{ asset('/images/visa.png') }}" alt="visa">
                        <img src="{{ asset('/images/american-express.png') }}" alt="american-express">
                                              
                                        </div>
                                        <div class="col-xl-12 text-center"><span><i class="fa fa-lock"></i> <span>Secure
                                                    transaction</span></span></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button disabled="" type="button" class="btn btn-success">Save</button></div>
                </div>              
            </div>
        </div>
    </div>
@endsection
