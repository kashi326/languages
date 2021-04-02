<div class="toast" role="alert" aria-live="assertive" id="success" data-animation="true" data-delay="3000" style="background-color:{{$color}};z-index:999999">
    <div class="toast-body text-center">
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close" style="float:right;">
            <span aria-hidden="true">&times;</span>
        </button>
        {{$message}} <img src="{{asset('icons/tick.svg')}}" alt="">
    </div>
</div>
