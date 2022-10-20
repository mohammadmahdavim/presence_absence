<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Personnel;
use App\Models\Presence;
use App\Services\DifferenceTimeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Morilog\Jalali\Jalalian;

class QrController extends Controller
{

    public $differenceTimeService;

    public function __construct(DifferenceTimeService $differenceTimeService)
    {
        $this->differenceTimeService = $differenceTimeService;
    }

    public function users()
    {
        $users = Personnel::take(3)->get();

        return view('panel.qr', ['users' => $users]);
    }

    public function scan()
    {
        return view('panel.scan');
    }

    public function scanCheck($code)
    {
        $today = Jalalian::now()->format('Ymd');
        $dayId = Day::where('name', $today)->pluck('id')->first();
        $user = Personnel::where('code', $code)->first();
        $check = Presence::where('personnel_id', $user->id)->where('day_id', $dayId)->first();
        $timeNow = Jalalian::now()->format('H:i');

        if (!$check) {
            $check = Presence::create([
                'personnel_id' => $user->id,
                'day_id' => $dayId,
                'enter' => $timeNow
            ]);

//            return Response::json('enter');
            return ['type' => 'enter', 'name' => $user->name, 'time' => $timeNow];
        } elseif ($check and ($check['exit'] == null || $check['exit'] == '')) {
            $timeAdded = Jalalian::forge($check['enter'])->addMinutes(20)->format('H:i');

            if ($timeNow < $timeAdded) {
                return ['type' => 'enter-exit', 'name' => $user->name, 'time' => $timeNow];
//                return Response::json('enter-exit');
            } else {
                $check->update(['exit' => $timeNow]);
                $this->differenceTimeService->sum($check->id);

//                return Response::json('exit');
                return ['type' => 'exit', 'name' => $user->name, 'time' => $timeNow];
            }

        } elseif ($check and $check['exit'] != null) {
//            return Response::json('duplicate');
            return ['type' => 'duplicate', 'name' => $user->name, 'time' => $timeNow];
        }

    }
}
