@extends('layouts.app')

@section('content')
<div class="content">
    <h1>resource</h1>
    <p>{!! $resource->name !!}</p>

    <ul>
        @forelse ($extras as $extra)
            <li>
                {!! $extra->name !!}
            </li>
            @empty
                <li>No extras yet.</li>
        @endforelse
    </ul>

</div>
@endsection