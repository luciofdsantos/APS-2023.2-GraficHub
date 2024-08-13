@extends('loginsingin')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('auth/login.css') }}" >
@endpush

@section('content')

    @if (session()->has('success'))
        {{ session()->get('sucess') }}
    @endif

    @if (auth()->check())
        Usuario logado, {{ auth()->user()->name }} <a href="{{ route('auth.logout') }}"> Logout </a>
    @else

        @error('error')
        <span>{{ $message }}</span>
        @enderror
        <div class="main">
            <form action="{{ route('auth.login') }}" method="post">
                <a href ="{{ route('home')}}" > <img class="logo-img"  alt="logo" src="/logo.png" /> </a>
                <p class="title"> Login </p>
                @csrf
                <input type="text" name="email">
                @error('email')
                <span>
               {{ $message }}
           </span>
                @enderror
                <input type="password" name="password">
                @error('password')
                <span>
              {{ $message }}
          </span>
                @enderror
                <button type="submit">Login</button>
                <p class="message">Não possui uma conta? <a href="{{ route('home') }}"> Cadastre-se</a></p>

            </form>
        </div>

    @endif
@endsection
