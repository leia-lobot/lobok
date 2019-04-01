@section('content')


  <div class="container mx-auto h-full flex flex-1 justify-center items-center">
    <div class="w-full max-w-xs">

      <h1 class="font-sans font-hairline mb-6 text-center">Login Here</h1>
      <form method="POST" action="{{ route('login') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        <div class="mb-4">
          <label class="block text-grey-darker text-sm font-hairline mb-2" for="email">
            {{ __('E-Mail Address') }}
          </label>
          <input id="email" type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
          @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
        </div>
        <div class="mb-6">
          <label class="block text-grey-darker text-sm font-hairline mb-2" for="password">
            {{ __('Password') }}
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" type="password" placeholder="******************" required>
          @if ($errors->has('password'))
          <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('password') }}</strong>
          </span>
        @endif
        </div>
        <div class="flex items-center justify-between">
          <button class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded" type="submit">
            {{ __('Login') }}
          </button>
          @if (Route::has('password.request'))
            <a class="inline-block align-baseline font-bold text-sm text-blue hover:text-blue-darker" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif
          </a>
        </div>
      </form>
    </div>
  </div>
@endsection
