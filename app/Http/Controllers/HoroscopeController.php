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
        return view('horoscope.daily', compact('horoscopes'));
    }

    public function weekly()
    {
        $horoscopes = Horoscope::where('type', 'weekly')->whereDate('date', '>=', now()->startOfWeek())->get();
        return view('horoscope.weekly', compact('horoscopes'));
    }

    public function monthly()
    {
        $horoscopes = Horoscope::where('type', 'monthly')->whereDate('date', '>=', now()->startOfMonth())->get();
        return view('horoscope.monthly', compact('horoscopes'));
    }

    public function calculatePersonal(Request $request)
    {
        $request->validate([
            'birthdate' => 'required|date',
        ]);

        $birthdate = Carbon::parse($request->input('birthdate'));
        $sign = $this->calculateZodiacSign($birthdate);
        $horoscope = Horoscope::where('zodiac_sign', $sign)->where('type', 'daily')->whereDate('date', today())->first();

        return view('horoscope.personal', compact('sign', 'horoscope', 'birthdate'));
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
}
