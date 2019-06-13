@extends('layouts.app')

@section('content')
<div class="bg-black w-screen h-screen opacity-75 fixed">
    
</div>
<div class="relative pt-40 flex justify-center">
    <div class="flex flex-col">
        <h2 class="text-red-700 text-3xl font-gobold">VÄLKOMMEN TILL</h2>
        <h1 class="text-red-700 font-gobold -mt-10" style="font-size: 200px">LOBOK</h1>
        <div class="flex justify-center">
        <a href="{{ url('/home')}}" class="text-white rounded bg-red-700 px-5 py-2 shadow-2xl hover:bg-red-800">Boka nu</a>
        </div>
    </div>
    
</div>
@endsection
