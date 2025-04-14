@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>Твій персональний гороскоп</h1>
        <p class="text-xl mb-4">Твій знак зодіаку: <strong>{{ $sign }}</strong></p>
        @if($horoscope)
            <div class="horoscope-card">
                <p>{{ $horoscope->content }}</p>
            </div>
        @else
            <p>Гороскоп для {{ $sign }} на сьогодні ще не готовий. Спробуй пізніше! 😊</p>
        @endif
        <a href="{{ route('home') }}" class="mt-4 inline-block bg-pastelPurple text-white p-2 rounded hover:bg-pastelPink">Спробувати ще раз</a>
    </div>
@endsection
