@extends('layouts.app')

@section('content')
<div class="container relative bg-gray-500">
    <div id="calendar">
        <a href="/reservations/create">Add</a>
        <table class="border border-gray-900">
            <tr class="border border-gray-900">
                <th class="border border-gray-900">Date</th>
                <th class="border border-gray-900">Time</th>
                <th class="border border-gray-900">Titel</th>
                <th class="border border-gray-900">Resource</th>
            </tr>
            
            @foreach( $reservations as $reservation) 
                
                <tr class="border border-gray-900">
                    
                    <td class="border border-gray-900">{{ \Carbon\Carbon::create($reservation->start_time)->format('Ymd') }}</td>
                    <td class="border border-gray-900">{{ \Carbon\Carbon::create($reservation->start_time)->format('Hi') }}</td>
                    <td class="border border-gray-900">{{ $reservation->title }}</td>
                    <td class="border border-gray-900">{{ $reservation->resource->name }}</td>
                </tr>
                
            @endforeach
        </table>

    </div>
</div>
@endsection