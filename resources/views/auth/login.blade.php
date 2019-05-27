@extends('layouts.app')

@section('content')
  <div class="bg-black w-screen h-screen opacity-75 fixed"></div>

  <div class="container mx-auto h-full flex flex-1 justify-center items-center relative">
    <div class="w-full max-w-xs">

      <h1 class="text-red-700 font-gobold mb-6 text-center mx-auto" style="font-size: 80px">LOBOK</h1>

      <form method="POST" action="{{ route('login') }}" class="bg-red-700 shadow-md px-8 pt-6 pb-8 mb-4">
        @csrf
        <div class="mb-4">
          <label class="block text-white text-sm font-hairline mb-2" for="email">
            {{ __('E-postadress') }}
          </label>
          <input id="email" type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-black {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
          @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
        </div>
        <div class="mb-6">
          <label class="block text-white text-sm font-hairline mb-2" for="password">
            {{ __('Lösenord') }}
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-black {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" type="password" placeholder="******************" required>
          @if ($errors->has('password'))
          <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('password') }}</strong>
          </span>
        @endif
        </div>
        <div class="flex items-center justify-between">
          <button class="bg-white hover:bg-red-600 text-red-700 hover:text-white font-bold py-2 px-4 rounded hover:shadow-md" type="submit">
            {{ __('Login') }}
          </button>
          @if (Route::has('password.request'))
            <a class="inline-block align-baseline font-bold text-sm text-white hover:text-gray-400" href="{{ route('password.request') }}">
                {{ __('Glömt lösenord?') }}
            </a>
        @endif
          </a>
        </div>
      </form>
    </div>
  </div>
@endsection
