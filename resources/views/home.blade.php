@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Дізнайся, що зірки готують для тебе! 🌟</h1>
        <form action="{{ route('horoscope.calculate') }}" method="POST">
            @csrf
            <label for="birthdate">Твоя дата народження:</label>
            <input type="date" name="birthdate" id="birthdate" required>
            <button type="submit">Дізнатися гороскоп</button>
        </form>

        <div class="grid-cols-3">
            @foreach([
                'Овен' => '♈', 'Телець' => '♉', 'Близнюки' => '♊', 'Рак' => '♋',
                'Лев' => '♌', 'Діва' => '♍', 'Терези' => '♎', 'Скорпіон' => '♏',
                'Стрілець' => '♐', 'Козеріг' => '♑', 'Водолій' => '♒', 'Риби' => '♓'
            ] as $sign => $icon)
                <div class="zodiac-card">
                    <a href="{{ route('horoscope.daily') }}">{{ $icon }} {{ $sign }}</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
