@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Особистий гороскоп для {{ $sign }} 🌟</h1>
        <div class="horoscope-card">
            <p>Дата народження: {{ $birthdate->format('d.m.Y') }}</p>
            <p>Знак зодіаку: {{ $sign }}</p>
            <p>{{ $horoscope->prediction }}</p> <!-- Исправлено -->
        </div>
        <a href="{{ route('home') }}" class="back-link">Повернутися на головну</a>
    </div>
@endsection
