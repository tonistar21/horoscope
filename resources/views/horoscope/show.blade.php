@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Гороскоп для {{ $signName }} 🌟</h1>
        <div class="horoscope-card">
            <p>{{ $horoscope->prediction }}</p>
        </div>
        <a href="{{ route('home') }}" class="back-link">Повернутися на головну</a>
    </div>
@endsection
