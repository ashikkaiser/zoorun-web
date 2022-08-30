@if ($type === 'name')
    <ol style="margin: 0px; padding: 0px">

        @foreach ($packages as $package)
            <li style="font-weight: bold">{{ $package }}</li>
        @endforeach

    </ol>
@else
    <ul style="margin: 0px; padding: 0px; list-style: none;">

        @foreach ($rates as $rate)
            <li style="font-weight: bold">{{ floatval($rate) }}</li>
        @endforeach

    </ul>
@endif
