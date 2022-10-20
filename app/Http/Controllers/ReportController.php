<?php

namespace App\Http\Controllers;

use App\Exports\AllExport;
use App\Exports\DetailExport;
use App\Exports\UsersExport;
use App\Models\Day;
use App\Models\Personnel;
use App\Models\Presence;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Morilog\Jalali\Jalalian;
use DateTime;

class ReportController extends Controller
{
    public function detail(Request $request)
    {
        $rows = Presence::with('personnel')
            ->with([
                'personnel.role' => function ($query) {
                    $query->select(['id', 'name']);
                },
                'personnel.manager' => function ($query) {
                    $query->select(['id', 'name']);
                },
                'personnel.section' => function ($query) {
                    $query->select(['id', 'name']);
                },
                'personnel.payment' => function ($query) {
                    $query->select(['id', 'name']);
                },
                'personnel.loge' => function ($query) {
                    $query->select(['id', 'name']);
                },
                'personnel.area' => function ($query) {
                    $query->select(['id', 'name']);
                },
                'personnel' => function ($query) {
                    $query->select('id', 'code', 'manager_id', 'name', 'national_code', 'mobile', 'section_id', 'manager_id', 'payment_source_id', 'loge_id', 'is_full_time', 'area_id', 'role_id');
                },
                'day' => function ($query) {
                    $query->select(['id', 'name']);
                },
            ])
            ->whereHas('personnel', function ($q) use ($request) {
                if ($request->get('name')) {
                    $q->where('name', 'like', '%' . $request->name . '%');
                }
                if ($request->get('code')) {
                    $q->where('code', $request->code);
                }
                if ($request->get('section')) {
                    $q->whereIn('section_id', $request->section);
                }
                if ($request->get('payment')) {
                    $q->whereIn('payment_source_id', $request->payment);
                }
                if ($request->get('loge')) {
                    $q->whereIn('loge_id', $request->loge);
                }
            })
            ->when($request->get('day'), function ($query) use ($request) {
                $query->whereIn('day_id', $request->day);
            })
            ->paginate(30);
        $menuActive = 'report-detail';

        return view('panel.report.detail', ['rows' => $rows, 'menuActive' => $menuActive]);
    }

    public function detailExport(Request $request)
    {
        $date = Jalalian::now()->format('Y-m-d');
        return Excel::download(new DetailExport($request), $date . '' . 'خروجی حضور غیاب در تاریخ.xlsx');
    }

    public function all(Request $request)
    {


        $rows = Personnel::
        with([
            'role' => function ($query) {
                $query->select(['id', 'name']);
            },
            'manager' => function ($query) {
                $query->select(['id', 'name']);
            },
            'section' => function ($query) {
                $query->select(['id', 'name']);
            },
            'payment' => function ($query) {
                $query->select(['id', 'name']);
            },
            'loge' => function ($query) {
                $query->select(['id', 'name']);
            },
            'area' => function ($query) {
                $query->select(['id', 'name']);
            },
        ])
            ->when($request->get('name'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->name . '%');
            })
            ->when($request->get('code'), function ($query) use ($request) {
                $query->where('code', $request->code);
            })
            ->when($request->get('section_id'), function ($query) use ($request) {
                $query->whereIn('section_id', $request->section);
            })
            ->when($request->get('payment'), function ($query) use ($request) {
                $query->whereIn('payment_source_id', $request->payment);
            })
            ->when($request->get('loge'), function ($query) use ($request) {
                $query->whereIn('loge_id', $request->loge);
            })
            ->has('presence')
            ->withCount('presence')
            ->withSum('presence', 'sum')
            ->paginate(30);
        $menuActive = 'report-all';

        return view('panel.report.all', ['rows' => $rows, 'menuActive' => $menuActive]);

    }

    public function allExport(Request $request)
    {
        $date = Jalalian::now()->format('Y-m-d');
        return Excel::download(new AllExport($request), $date . '' . 'خروجی  کل حضور غیاب در تاریخ.xlsx');
    }

    public function reportUsers(Request $request)
    {

        $date = Jalalian::now()->format('Y-m-d');
        return Excel::download(new UsersExport($request), $date . '' . 'خروجی  افراد در تاریخ.xlsx');
    }
}
