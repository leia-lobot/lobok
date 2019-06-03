@extends('layouts.app')

@section('content')
    <div class="flex flex-row h-screen">
        <!-- Left -->
        <div class="flex justify-center w-1/5 opacity-75 bg-red-900">
            <h1 class="text-gray-100 text-6xl pt-16">LOBOK</h1>
            
        </div>

        <!-- Right -->
        <div class="w-4/5 bg-black opacity-75">
            <div class="pt-40 flex justify-center">
                    <div class="flex flex-col">
                        <div class="flex justify-center">
                                <a href="#reserve-modal" class="text-white rounded bg-red-700 px-5 py-2 shadow-2xl hover:bg-red-800 mr-10">Boka nu</a>
                                <a href="#overview-modal" class="text-white rounded bg-red-700 px-5 py-2 shadow-2xl hover:bg-red-800">Översikt</a>
                        </div>
                    </div>
                    
                </div>
            
                @component('components.modal', ['name' => 'reserve-modal'])
                <form action="">
                        <input type="text" name="name" id="name" placeholder="Olle Johansson">
                        <select name="company" id="company">
                            <option value="leia">Leia Företagshotell</option>
                        </select>
                    <input type="date" name="start_date" id="start_date" value="{{ \Carbon\Carbon::now('Europe/Stockholm')->locale('sv')->format('Y-m-d') }}">
                        <input type="date" name="end_date" id="end_date" value="{{ \Carbon\Carbon::now('Europe/Stockholm')->locale('sv')->format('Y-m-d') }}">
                        <input type="time" name="start_time" id="start_time" value="{{ \Carbon\Carbon::now('Europe/Stockholm')->locale('sv')->set('minute',0)->format('H:i') }}">
                        <input type="time" name="end_time" id="end_time" value="{{ \Carbon\Carbon::now('Europe/Stockholm')->locale('sv')->set('minute',0)->format('H:i') }}">
                    </form>
                @endcomponent
                
                @component('components.modal', ['name' => 'overview-modal'])
                    <div id="calendar"></div>
                @endcomponent
        </div>
    </div>
    

@endsection