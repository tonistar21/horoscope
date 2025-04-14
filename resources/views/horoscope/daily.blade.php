@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Щоденні гороскопи 🌟</h1>
        <div class="grid-cols-3">
            @foreach($horoscopes as $horoscope)
                <div class="horoscope-card">
                    <h2>{{ getZodiacSignName($horoscope->zodiac_sign) }}</h2>
                    <p>{{ $horoscope->prediction }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@php
    function getZodiacSignName($signKey)
    {
        $map = [
            'aries' => 'Овен',
            'taurus' => 'Телець',
            'gemini' => 'Близнюки',
            'cancer' => 'Рак',
            'leo' => 'Лев',
            'virgo' => 'Діва',
            'libra' => 'Терези',
            'scorpio' => 'Скорпіон',
            'sagittarius' => 'Стрілець',
            'capricorn' => 'Козеріг',
            'aquarius' => 'Водолій',
            'pisces' => 'Риби',
        ];

        return $map[$signKey] ?? 'Невідомий';
    }
@endphp
