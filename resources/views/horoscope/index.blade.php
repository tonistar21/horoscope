@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-4">Гороскоп</h1>
    <ul>
        <li><a href="{{ route('horoscope.daily') }}" class="text-pastelBlue hover:underline">На сьогодні</a></li>
        <li><a href="{{ route('horoscope.weekly') }}" class="text-pastelBlue hover:underline">На тиждень</a></li>
        <li><a href="{{ route('horoscope.monthly') }}" class="text-pastelBlue hover:underline">На місяць</a></li>
    </ul>
@endsection
