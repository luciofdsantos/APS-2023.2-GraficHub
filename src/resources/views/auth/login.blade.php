@extends('master')

@section('content')

    <a href="{{ route('home') }}"> Login </a>

    <h2> Login </h2>

    @if (session()->has('success'))
        {{ session()->get('sucess') }}
    @endif

    @if (auth()->check())
        Usuario logado, {{ auth()->user()->name }} <a href="{{ route('auth.logout') }}"> Logout </a>
    @else

    @error('error')
        <span>{{ $message }}</span>
    @enderror

    <form action="{{ route('auth.login') }}" method="post">
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
    </form>

    @endif
@endsection
