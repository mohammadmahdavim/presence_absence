<?php

namespace App\Exports;

use App\Models\Personnel;
use App\Models\Presence;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AllExport implements FromCollection, WithHeadings, WithMapping
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
            ->get();
        return $rows;
    }

    public function headings(): array
    {
        return [
            'کد',
            'نام',
            'وضعیت حضور',
            'کدملی',
            'موبایل',
            'نقش',
            'مسول',
            'غرفه',
            'بخش',
            'منطقه',
            'منبع پرداخت',
            'تعداد روز',
            'جمع ساعت',
            'امتیاز روز',
            'امتیاز ساعت',
            'امتیاز ',
        ];
    }

    public function map($preflight): array
    {
        return [

            $preflight->code,
            $preflight->name,
            ($preflight->is_full_time==1 ? 'تمام وقت':'پاره وقت' ),
            $preflight->national_code,
            $preflight->mobile,
            $preflight->role->name,
            ($preflight->manager='[]' ? $preflight->manager->name : $preflight->name),
            $preflight->loge->name,
            $preflight->section->name,
            $preflight->area->name,
            $preflight->payment->name,
            $preflight->presence_count,
            floor($preflight->presence_sum_sum/60) .':'. fmod($preflight->presence_sum_sum,60),
            $preflight->presence_count,
            round($preflight->presence_sum_sum/60),
            round($preflight->presence_sum_sum/60)+$preflight->presence_count,
        ];
    }
}
