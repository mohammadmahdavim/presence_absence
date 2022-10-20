<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Forecast;
use App\Models\Personnel;
use App\Models\Presence;
use App\Services\DifferenceTimeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Milon\Barcode\DNS2D;
use Morilog\Jalali\Jalalian;


class AttendanceController extends Controller
{

    public $differenceTimeService;

    public function __construct(DifferenceTimeService $differenceTimeService)
    {
        $this->differenceTimeService = $differenceTimeService;
    }

    public function index(Request $request)
    {

        $user = Presence::where('id', 9)->first();
//        $user->delete();
        $personnel = Personnel::pluck('name', 'id');
        $days = Day::pluck('name', 'id');

        $now = Jalalian::now()->format('Ymd');
        $today = Day::where('name', $now)->first();
        $today_id = $today->id ?? '';

        if ($request->type == 'presents') {
            $todayPersonnel = $today ? $today->presences()->where('enter', '!=', '')->whereNull('exit')->orWhere('exit', '')->with('personnel')->orderBy('enter')->get() : '';
            $type = 'presents';
        } else {
            $todayPersonnel = $today ? $today->presences()->where('enter', '!=', '')->with('personnel')->orderBy('enter')->get() : '';
            $type = 'today';
        }
        $absents = Forecast::where('day_id', $today_id)->whereNotIn('personnel_id', $todayPersonnel->pluck('personnel_id'))->get();
        $menuActive = 'dashboard';
        return view('index', compact('personnel', 'days', 'today_id', 'todayPersonnel', 'type', 'menuActive', 'absents'));
    }

    public function store(Request $request)
    {
        if ($request->enter > $request->exit && $request->exit != "") {
            return 'error';
        }

        $check = Presence::where('personnel_id', $request->personnel_id)->where('day_id', $request->day_id)->first();
        if ($check) {
            $check->update($request->all());
        } else {
            $check = Presence::create($request->all());
        }
        $this->differenceTimeService->sum($check->id);
        return 'success';
    }

    public function inquiry(Request $request)
    {
        return Presence::where('personnel_id', $request->personnel_id)->where('day_id', $request->day_id)->select('enter', 'exit')->first() ?? '';
    }

    public function editPresence(Presence $presence, Request $request)
    {
        return view('panel.presence.edit-modal', compact('presence'))->render();
    }

    public function delete($id)
    {
        $user = Presence::where('id', $id)->first();
        $user->delete();
        return back();
    }

}
