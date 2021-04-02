<div class="container">
    <div class="card ">
        <div class="card-header">Payments Record</div>
      <div class="card-body px-3">
          @if (count($payments))
            @foreach ($payments as $payment)
                @if (Auth::user()->role == 'user' || Auth::user()->role == 'admin')
                    <p class="py-2">You Paid {{$payment->amount}} for Lesson with {{$payment->teacher->user->name}} {{$payment->teacher->user->lastname}}</p>
                @else
                    <p class="py-2">{{$payment->amount}} was paid to you by {{$payment->user->name}}</p>
                @endif
                <hr>
            @endforeach
          @else
            @include('includes.notfound')
          @endif
      </div>
    </div>
</div>
