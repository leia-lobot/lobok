@extends('layouts.app')

@section('content')
<div class="content">
    <h1>Companies</h1>

    <ul>
        @forelse ($companies as $company)
            <li>
                <a href="{{$company->path()}}">{!! $company->name !!}</a>
            </li>
            @empty
                <li>No companies yet.</li>
        @endforelse
    </ul>

</div>
@endsection