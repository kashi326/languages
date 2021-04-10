@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-12 col-md-8 px-4">
        <div id="meet"></div>
    </div>
    <div class="col-12 col-md-4 px-4">
        <div class="uk-section pt-0">
            <div class="uk-container-fluid uk-width-expand">
                <div class="uk-card uk-card-default uk-border-rounded ">
                    <div class="uk-card-body uk-padding-small" uk-overflow-auto="selContainer: .uk-height-medium; selContent: .js-wrapper" id="chatBox" style="height: 420px;">
                        <!-- messages comes here -->
                    </div>

                    <div class="uk-card-footer uk-padding-remove">
                        <div class="uk-grid-small uk-flex-middle" uk-grid>
                            <div class="uk-width-auto">
                                <a href="#" class="uk-icon-link uk-margin-small-left" uk-icon="icon: happy"></a>
                            </div>
                            <div class="uk-width-expand">
                                <div class="uk-padding-small uk-padding-remove-horizontal">
                                    <textarea class="uk-textarea uk-padding-remove uk-border-remove" rows="1" placeholder="Type here" id="MessageInput"></textarea>
                                </div>
                            </div>
                            <div class="uk-width-auto">
                                <ul class="uk-iconnav uk-margin-small-right">
                                    <span id="send">send</span>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script src="{{asset('js/meet_api.js')}}"></script> -->
<script src='https://meet.jit.si/external_api.js'></script>
<script>
    // const domain = 'languages.kashifahmad.com/meeting';
    const domain = 'meet.jit.si';
    const options = {
        roomName: '<?php echo $id; ?>',
        width: "100%",
        height: 500,
        parentNode: document.querySelector('#meet')
    };
    const api = new JitsiMeetExternalAPI(domain, options);
    $(function() {
        var userid = '<?php echo $userid; ?>';
        var session_id = '<?php echo $id; ?>';

        function getMessage() {
            $.ajax({
                url: `/messages?session_id=${session_id}`,
                success: function(result) {
                    var messages = result.messages;
                    messages && $("#chatBox").html("") && messages.map(msg => {
                        var html = "";
                        if (userid == msg.user_id) {
                            html = `
                            <div class="me uk-grid-small uk-flex-bottom uk-flex-right uk-text-right" uk-grid>
                            <div class="uk-width-auto">
                            <div class="uk-card uk-card-body uk-card-small uk-card-primary uk-border-rounded">
                            <p class="uk-margin-remove">${msg.message}</p>
                            </div>
                            </div>
                            <div class="uk-width-auto">
                            <img class="uk-border-circle" width="32" height="32" src="https://getuikit.com/docs/images/avatar.jpg">
                            </div>
                            </div>`
                        } else {
                            html = ` <div class="guest uk-grid-small uk-flex-bottom uk-flex-left" uk-grid>
                            <div class="uk-width-auto">
                            <img class="uk-border-circle" width="32" height="32" src="https://getuikit.com/docs/images/avatar.jpg">
                            </div>
                            <div class="uk-width-auto">
                            <div class="uk-card uk-card-body uk-card-small uk-card-default uk-border-rounded">
                            <p class="uk-margin-remove">${msg.message}</p>
                            </div>
                            </div>
                            </div>`
                        }
                        $("#chatBox").append(html);
                    })
                }
            });
        }
        getMessage()
        setInterval(() => {
            getMessage()
        }, 5000);
        $("#send").click((e) => {
            var message = $("#MessageInput").val();
            $("#MessageInput").val("");
            if (message === "") return;
            html = `
                        <div class="me uk-grid-small uk-flex-bottom uk-flex-right uk-text-right" uk-grid>
                            <div class="uk-width-auto">
                                <div class="uk-card uk-card-body uk-card-small uk-card-primary uk-border-rounded">
                                    <p class="uk-margin-remove">${message}</p>
                                </div>
                            </div>
                            <div class="uk-width-auto">
                                <img class="uk-border-circle" width="32" height="32" src="https://getuikit.com/docs/images/avatar.jpg">
                            </div>
                        </div>`
            $("#chatBox").append(html);
            $("#chatBox").animate({
                scrollTop: $(document).height()
            }, 1000)
            $.ajax({
                url: "{{route('messages.store')}}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: userid,
                    session_id: session_id,
                    message: message
                },
                success: function(response) {
                    console.log("hello");

                },
                error: function(error) {
                    console.log("error");
                }
            })
        })
    })
</script>
@endsection
