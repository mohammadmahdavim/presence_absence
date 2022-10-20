<?php

namespace App\Exports;

use App\Models\Presence;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DetailExport implements FromCollection, WithHeadings, WithMapping
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

        $rows = Presence::with('personnel')
            ->with([
                'personnel.role' => function ($query) {
                    $query->select(['id', 'name']);
                },
                'personnel.section' => function ($query) {
                    $query->select(['id', 'name']);
                },
                'personnel.manager' => function ($query) {
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
                    $query->select('id', 'code','manager_id', 'name', 'national_code', 'mobile', 'section_id', 'manager_id', 'payment_source_id', 'loge_id', 'is_full_time', 'area_id', 'role_id');
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
            })->get();
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
            'روز',
            'ورود',
            'خروج',
        ];
    }

    public function map($preflight): array
    {
        return [

            $preflight->personnel->code,
            $preflight->personnel->name,
            ($preflight->personnel->is_full_time==1 ? 'تمام وقت':'پاره وقت' ),
            $preflight->personnel->national_code,
            $preflight->personnel->mobile,
            $preflight->personnel->role->name,
            ($preflight->personnel->manager ? $preflight->personnel->manager->name :$preflight->personnel->name),
            $preflight->personnel->loge->name,
            $preflight->personnel->section->name,
            $preflight->personnel->area->name,
            $preflight->personnel->payment->name,
            $preflight->day->name,
            $preflight->enter,
            $preflight->exit,
        ];
    }


}
