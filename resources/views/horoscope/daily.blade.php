@extends('layouts.app')

@section('content')
    <h1>Гороскоп на сьогодні</h1>
    <div class="grid grid-cols-2 sm:grid-cols-3 gap-6">
        @foreach($horoscopes as $horoscope)
            <div class="horoscope-card">
                <h2>{{ $horoscope->zodiac_sign }}</h2>
                <p>{{ $horoscope->content }}</p>
            </div>
        @endforeach
    </div>
@endsection
