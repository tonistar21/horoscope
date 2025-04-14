<?php

namespace Database\Seeders;

use App\Models\Horoscope;
use Illuminate\Database\Seeder;

class HoroscopeSeeder extends Seeder
{
    public function run(): void
    {
        $signs = ['Овен', 'Телець', 'Близнюки', 'Рак', 'Лев', 'Діва', 'Терези', 'Скорпіон', 'Стрілець', 'Козеріг', 'Водолій', 'Риби'];
        foreach ($signs as $sign) {
            Horoscope::create([
                'zodiac_sign' => $sign,
                'type' => 'daily',
                'content' => "Сьогодні зірки радять {$sign} бути собою! Довіряй інтуїції та лови свій вайб. 🌟",
                'date' => today(),
            ]);
        }
    }
}
