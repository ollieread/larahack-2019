@if ($alerts)
    <div class="alert--global">
        <div class="container">
            @foreach ($alerts as $type => $messages)
                @foreach ($messages as $message)
                    <div class="alert__message alert__message--{{ $type }}">
                        {!! $message !!}
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
@endif