@extends('layouts.app')

@section('content')
<div class="content">
    <h1>reservations</h1>

    <ul>
        @forelse ($reservations as $reservation)
            <li>
                {!! $reservation->title !!} : {!! $reservation->start_time !!} - {!! $reservation->end_time !!}
            </li>
            @empty
                <li>No reservations yet.</li>
        @endforelse
    </ul>

</div>
@endsection