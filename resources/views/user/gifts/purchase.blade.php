@extends('layouts.app')
@section('content')
    <main id="app" class="full-width" role="main">
        <div class="FlexApp">
            <div class="container FlexContent margin-bottom-xl margin-top-xxl GiftBase">
                <div class="row">
                    <div class="offset-md-1 col-md-3 col-12 col-sm-12 mobile-hide tablet-hide">
                        <div class="row" style="padding: 0 0 20px 0;height:400px;">
                            <div class="zoom col-md-4">
                                <img src="{{ asset('/images/verb.png') }}" alt=""
                                    style="width:250px;height:300px;border-radius:20px">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8 col-12 col-sm-12">
                        <div class="panel panel-default">
                            <form action="/gifts" method="POST" enctype="multipart/form-data" >
                                @csrf
                                <div class="panel-body" style="background-color: white; padding:7%; border-radius:10px">
                                    <div class="paddding-xl">
                                        <h1 class="margin-bottom-xl">Gift Card</h1>
                                        <div>
                                            <div class="form-group--focuser form-group"><label>To</label>
                                                <input placeholder="Enter recipient’s email" class="form-control--focuser form-control" name="email" required></div>
                                            <div class="form-group--focuser form-group"><label>From</label>
                                                <input placeholder="Enter sender's name" class="form-control--focuser form-control" value="{{ Auth::user()->name }}"></div>
                                            <div class="form-group--focuser form-group"><label>Message</label>
                                                <textarea placeholder="Optional" class="TextareaAutosize form-control"  style="height: 114px;" name="message"></textarea></div>
                                            <div class="form-group">
                                                <div class="form-group--focuser form-group"><label>Amount</label>
                                                    <input placeholder="$" class="form-control--focuser form-control" name="amount" required></div>
                                            </div>
                                        </div>
                                        {{-- <input type="checkbox" id="myCheck" onclick="myFunction()">
                                        <label for="myCheck">Schedule Email</label> --}}
                                    </div><br />
                                    {{-- <div style="display: none" id="text">
                                        <div class="form-group--focuser form-group"><label>Recipient Email
                                                Address</label><input placeholder="Enter email"
                                                class="form-control--focuser form-control" value=""></div>
                                        <div class="form-group--focuser form-group"><label>Time</label>
                                            <div class="input"><input addonbefore="[object Object]"
                                                    initialvalue="Sun Nov 08 2020 00:00:00 GMT+0500 (Pakistan Standard Time)"
                                                    placement="bottom" type="text"
                                                    class="form-control--focuser form-control"
                                                    value="Sunday, November 8, 2020 12:00 AM">
                                            </div>
                                        </div>
                                    </div> --}}
                                    <button type="submit" class="btn  btn-primary" style="float: right">Continue to Checkout</button>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <script>
            function myFunction() {
                var checkBox = document.getElementById("myCheck");
                var text = document.getElementById("text");
                if (checkBox.checked == true) {
                    text.style.display = "block";
                } else {
                    text.style.display = "none";
                }
            }

        </script>
    @endsection
