<?php

namespace App\Http\Controllers;

use App\Models\Horoscope;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HoroscopeController extends Controller
{
    public function index()
    {
        return view('horoscope.index');
    }

    public function daily()
    {
        $horoscopes = Horoscope::where('type', 'daily')->whereDate('date', today())->get();
        if ($horoscopes->isEmpty()) {
            // Заглушка, если данных нет
            $horoscopes = collect($this->getDefaultHoroscopes('daily'));
        }
        return view('horoscope.daily', compact('horoscopes'));
    }

    public function weekly()
    {
        $horoscopes = Horoscope::where('type', 'weekly')
            ->whereDate('date', '>=', now()->startOfWeek())
            ->get();
        if ($horoscopes->isEmpty()) {
            $horoscopes = collect($this->getDefaultHoroscopes('weekly'));
        }
        return view('horoscope.weekly', compact('horoscopes'));
    }

    public function monthly()
    {
        $horoscopes = Horoscope::where('type', 'monthly')
            ->whereDate('date', '>=', now()->startOfMonth())
            ->get();
        if ($horoscopes->isEmpty()) {
            $horoscopes = collect($this->getDefaultHoroscopes('monthly'));
        }
        return view('horoscope.monthly', compact('horoscopes'));
    }

    public function calculatePersonal(Request $request)
    {
        $request->validate([
            'birthdate' => 'required|date',
        ]);

        $birthdate = Carbon::parse($request->input('birthdate'));
        $sign = $this->calculateZodiacSign($birthdate);
        $signKey = $this->getZodiacSignKey($sign);
        $horoscope = Horoscope::where('zodiac_sign', $signKey)
            ->where('type', 'daily')
            ->whereDate('date', today())
            ->first();

        if (!$horoscope) {
            $horoscope = (object) [
                'zodiac_sign' => $signKey,
                'prediction' => $this->getDefaultHoroscopes('daily')[$signKey]['prediction'],
                'type' => 'daily',
                'date' => today(),
            ];
        }

        return view('horoscope.personal', compact('sign', 'horoscope', 'birthdate'));
    }

    public function show($sign)
    {
        $signKey = strtolower($sign);
        $signName = $this->getZodiacSignName($signKey);
        $horoscope = Horoscope::where('zodiac_sign', $signKey)
            ->where('type', 'daily')
            ->whereDate('date', today())
            ->first();

        if (!$horoscope) {
            $defaultHoroscopes = $this->getDefaultHoroscopes('daily');
            if (!isset($defaultHoroscopes[$signKey])) {
                abort(404, 'Знак зодіаку не знайдено');
            }
            $horoscope = (object) [
                'zodiac_sign' => $signKey,
                'prediction' => $defaultHoroscopes[$signKey]['prediction'],
                'type' => 'daily',
                'date' => today(),
            ];
        }

        return view('horoscope.show', compact('signKey', 'signName', 'horoscope'));
    }

    private function calculateZodiacSign($birthdate)
    {
        $month = $birthdate->month;
        $day = $birthdate->day;

        if (($month == 3 && $day >= 21) || ($month == 4 && $day <= 19)) return 'Овен';
        if (($month == 4 && $day >= 20) || ($month == 5 && $day <= 20)) return 'Телець';
        if (($month == 5 && $day >= 21) || ($month == 6 && $day <= 20)) return 'Близнюки';
        if (($month == 6 && $day >= 21) || ($month == 7 && $day <= 22)) return 'Рак';
        if (($month == 7 && $day >= 23) || ($month == 8 && $day <= 22)) return 'Лев';
        if (($month == 8 && $day >= 23) || ($month == 9 && $day <= 22)) return 'Діва';
        if (($month == 9 && $day >= 23) || ($month == 10 && $day <= 22)) return 'Терези';
        if (($month == 10 && $day >= 23) || ($month == 11 && $day <= 21)) return 'Скорпіон';
        if (($month == 11 && $day >= 22) || ($month == 12 && $day <= 21)) return 'Стрілець';
        if (($month == 12 && $day >= 22) || ($month == 1 && $day <= 19)) return 'Козеріг';
        if (($month == 1 && $day >= 20) || ($month == 2 && $day <= 18)) return 'Водолій';
        if (($month == 2 && $day >= 19) || ($month == 3 && $day <= 20)) return 'Риби';

        return 'Невідомий';
    }

    private function getZodiacSignKey($signName)
    {
        $map = [
            'Овен' => 'aries',
            'Телець' => 'taurus',
            'Близнюки' => 'gemini',
            'Рак' => 'cancer',
            'Лев' => 'leo',
            'Діва' => 'virgo',
            'Терези' => 'libra',
            'Скорпіон' => 'scorpio',
            'Стрілець' => 'sagittarius',
            'Козеріг' => 'capricorn',
            'Водолій' => 'aquarius',
            'Риби' => 'pisces',
        ];

        return $map[$signName] ?? 'unknown';
    }

    private function getZodiacSignName($signKey)
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

    private function getDefaultHoroscopes($type)
    {
        $predictions = [
            'aries' => [
                'prediction' => 'Овен: Сьогодні твоя енергія на піку! Використай її для нових починань.',
                'type' => $type,
            ],
            'taurus' => [
                'prediction' => 'Телець: Стабільність приведе до успіху. Довіряй своїм інстинктам.',
                'type' => $type,
            ],
            'gemini' => [
                'prediction' => 'Близнюки: Нові знайомства відкриють двері до можливостей.',
                'type' => $type,
            ],
            'cancer' => [
                'prediction' => 'Рак: Слухай серце — воно підкаже правильний шлях.',
                'type' => $type,
            ],
            'leo' => [
                'prediction' => 'Лев: Твоя харизма притягує увагу. Сяй яскраво!',
                'type' => $type,
            ],
            'virgo' => [
                'prediction' => 'Діва: Дрібні деталі сьогодні важливі. Будь уважним.',
                'type' => $type,
            ],
            'libra' => [
                'prediction' => 'Терези: Гармонія в стосунках принесе радість.',
                'type' => $type,
            ],
            'scorpio' => [
                'prediction' => 'Скорпіон: Твоя інтуїція — твій найкращий провідник.',
                'type' => $type,
            ],
            'sagittarius' => [
                'prediction' => 'Стрілець: Пригоди чекають! Не бійся ризикувати.',
                'type' => $type,
            ],
            'capricorn' => [
                'prediction' => 'Козеріг: Наполегливість приведе до великих результатів.',
                'type' => $type,
            ],
            'aquarius' => [
                'prediction' => 'Водолій: Твої ідеї надихають інших. Ділись ними!',
                'type' => $type,
            ],
            'pisces' => [
                'prediction' => 'Риби: Творчість допоможе знайти відповіді на всі питання.',
                'type' => $type,
            ],
        ];

        return $predictions;
    }
}
