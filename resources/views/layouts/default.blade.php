@extends('layouts.app')

@section('layout')
    @include('partials.nav')

    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>
@endsection
