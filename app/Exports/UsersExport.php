<?php

namespace App\Exports;

use App\Models\Day;
use App\Models\Forecast;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Morilog\Jalali\Jalalian;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    protected $request;

    function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $request = $this->request;
        $now = Jalalian::now()->format('Ymd');
        $today = Day::where('name', $now)->first();
        if ($request->type == 'presents') {
            $todayPersonnel = $today ? $today->presences()->where('enter', '!=', '')->whereNull('exit')->orWhere('exit', '')->with('personnel','day')->get() : '';
        } else {
            $todayPersonnel = $today ? $today->presences()->where('enter', '!=', '')->with('personnel','day')->get() : '';
        }
        if ($request->type == 'absent') {
            $presents = $today->presences()->where('enter', '!=', '')->get();
            $todayPersonnel = Forecast::where('day_id', $today->id)->whereNotIn('personnel_id', $presents->pluck('personnel_id'))->get();

        }
        return $todayPersonnel;

    }

    public function headings(): array
    {
        return [
            'کد',
            'نام',
            'تاریخ',
            'وضعیت حضور',
            'ورود',
            'خروج',
            'کد ملی',
            'موبایل',
        ];
    }

    public function map($preflight): array
    {

        if ($preflight->enter == null) {
            $type = 'غایب';
        } else {
            if ($preflight->exit == '') {
                $type = 'حاضر';
            } else {
                $type = 'خروج زده';
            }
        }
        return [
            $preflight->personnel->code,
            $preflight->personnel->name,
            $preflight->day->name,
            $type,
            $preflight->enter,
            $preflight->exit,
            $preflight->personnel->national_code,
            $preflight->personnel->mobile,
        ];
    }


}
