@extends('layouts.app')

@section('content')
<div class="content">
    <h1>resources</h1>

    <ul>
        @forelse ($resources as $resource)
            <li>
                {!! $resource->name !!}
            </li>
            @empty
                <li>No resourcess yet.</li>
        @endforelse
    </ul>

</div>
@endsection