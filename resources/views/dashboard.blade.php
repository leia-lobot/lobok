@extends('layouts.app')

@section('content')
    <div class="flex flex-row h-screen">
        <!-- Left -->
        <div class="flex justify-center w-1/5 opacity-75 bg-red-900">
            <h1 class="text-gray-100 text-6xl pt-16">LOBOK</h1>
            
        </div>

        <!-- Right -->
        <div class="w-4/5">
            <div class="absolute w-4/5 h-screen"></div>
            <div class="pt-40 flex justify-center relative">
                    <div class="flex flex-col">
                        <div class="flex justify-center">
                                <a href="#reserve-modal" class="text-white rounded bg-red-700 px-5 py-2 shadow-2xl hover:bg-red-800 mr-10">Boka nu</a>
                                <a href="#overview-modal" class="text-white rounded bg-red-700 px-5 py-2 shadow-2xl hover:bg-red-800">Översikt</a>
                        </div>
                    </div>
                    
                </div>
            
               @include('components.reserve')
                
                @component('components.modal', ['name' => 'overview-modal', 'style' => 'bg-white'])
                    <div id="calendar"></div>
                @endcomponent
        </div>
    </div>
@endsection