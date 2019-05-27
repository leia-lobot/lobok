@extends('layouts.app')

@section('content')
<div class="bg-black w-screen h-screen opacity-75 fixed"></div>

<div class="container mx-auto h-full flex flex-1 justify-center items-center relative">
  <div class="w-full max-w-xs">

    <h1 class="text-red-700 font-gobold lg:mb-6 text-center mx-auto" style="font-size: 80px">LOBOK</h1>

    <form method="POST" action="{{ route('reservations.store') }}" class="bg-red-700 shadow-md px-8 pt-6 pb-8 mb-4">
        @csrf

        <!-- NAME -->
        <div class="mb-4">
            <label class="block text-white text-sm font-hairline mb-2" for="name">
                {{ __('För- och efternamn') }}
            </label>
            <input id="name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-black {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="" placeholder="Rikard Johansson" required autofocus>
            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <!-- COMPANY -->
        <div class="mb-4">
            <label class="block text-white text-sm font-hairline mb-2" for="company">
                {{ __('Företag') }}
            </label>
            <input id="company" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-black {{ $errors->has('company') ? ' is-invalid' : '' }}" name="company" value="" placeholder="Leia Företagshotell" required autofocus>
            @if ($errors->has('company'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('company') }}</strong>
                </span>
            @endif
        </div>

      <div class="flex items-center justify-between">
        <button class="bg-white hover:bg-red-600 text-red-700 hover:text-white font-bold py-2 px-4 rounded hover:shadow-md" type="submit">
            {{ __('Skapa') }}
        </button>
        </a>
      </div>
    </form>
  </div>
</div>
@endsection