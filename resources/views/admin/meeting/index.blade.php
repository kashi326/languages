@extends("layouts.admin")
@section('content')
<div class="container">
    <div class="card my-5" id="main-card">
        <div class="card-body">
            <h3>Messages History</h3>
            <hr />
            <div class="uk-section pt-0">
                <div class="uk-container-fluid uk-width-expand">
                    <div class="uk-card uk-card-default uk-border-rounded ">
                        <div class="uk-card-body uk-padding-small" uk-overflow-auto="selContainer: .uk-height-medium; selContent: .js-wrapper" id="chatBox" style="height: 420px;">
                            <!-- messages comes here -->
                            @foreach($messages as $msg)
                            @if($users[0]->user_id && $msg->user_id == $users[0]->user_id)
                            <div class="guest uk-grid-small uk-flex-bottom uk-flex-left" uk-grid>
                                <div class="uk-width-auto">
                                    <img class="uk-border-circle" width="32" height="32" src="https://getuikit.com/docs/images/avatar.jpg">
                                </div>
                                <div class="uk-width-auto">
                                    <div class="uk-card uk-card-body uk-card-small uk-card-default uk-border-rounded">
                                        <p class="uk-margin-remove">{{$msg->message}}</p>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="me uk-grid-small uk-flex-bottom uk-flex-right uk-text-right" uk-grid>
                                <div class="uk-width-auto">
                                    <div class="uk-card uk-card-body uk-card-small uk-card-primary uk-border-rounded">
                                        <p class="uk-margin-remove">{{$msg->message}}</p>
                                    </div>
                                </div>
                                <div class="uk-width-auto">
                                    <img class="uk-border-circle" width="32" height="32" src="https://getuikit.com/docs/images/avatar.jpg">
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
