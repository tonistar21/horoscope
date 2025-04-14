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
                'aries' => ['name' => 'Овен', 'icon' => '♈'],
                'taurus' => ['name' => 'Телець', 'icon' => '♉'],
                'gemini' => ['name' => 'Близнюки', 'icon' => '♊'],
                'cancer' => ['name' => 'Рак', 'icon' => '♋'],
                'leo' => ['name' => 'Лев', 'icon' => '♌'],
                'virgo' => ['name' => 'Діва', 'icon' => '♍'],
                'libra' => ['name' => 'Терези', 'icon' => '♎'],
                'scorpio' => ['name' => 'Скорпіон', 'icon' => '♏'],
                'sagittarius' => ['name' => 'Стрілець', 'icon' => '♐'],
                'capricorn' => ['name' => 'Козеріг', 'icon' => '♑'],
                'aquarius' => ['name' => 'Водолій', 'icon' => '♒'],
                'pisces' => ['name' => 'Риби', 'icon' => '♓']
            ] as $sign => $data)
                <div class="zodiac-card">
                    <a href="{{ route('horoscope.show', $sign) }}">
                        {{ $data['icon'] }} {{ $data['name'] }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
