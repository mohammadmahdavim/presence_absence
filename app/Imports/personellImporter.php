<?php

namespace App\Imports;

use App\Models\Area;
use App\Models\Day;
use App\Models\Forecast;
use App\Models\Loge;
use App\Models\PaymentSource;
use App\Models\Personnel;
use App\Models\Role;
use App\Models\Section;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class personellImporter implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {

        $codes = Personnel::pluck('code')->toArray();
        foreach ($collection as $row) {
            if (!in_array($row['code'], $codes)) {
                $section = $this->section($row['section'] ? $row['section'] : 'blank');
                $role = $this->role($row['role'] ? $row['role'] : 'blank');
                $loge = $this->loge($row['loge'], $row['loge_manager']);
                $area = $this->area($row['area'] ? $row['area'] : 'blank');
                $paymant = $this->paymant($row['paymant'] ? $row['paymant'] : 'blank');
                $manager = $this->manager($row['manager'] ? $row['manager'] : 'blank');
                $id = Personnel::create([
                    'name' => $row['name'],
                    'mobile' => $row['mobile'],
                    'national_code' => $row['national_code'],
                    'code' => $row['code'],
                    'role_id' => $role->id,
                    'section_id' => $section->id,
                    'loge_id' => $loge->id,
                    'area_id' => $area->id,
                    'payment_source_id' => $paymant->id,
                    'manager_id' => $manager,
                ])->id;
                foreach ($row as $key => $r) {
                    if (substr($key, '0', '3') == 'day' and $r != null) {
                        $day = Day::where('name', substr($key, '4', '8'))->pluck('id')->first();
                        Forecast::create([
                            'personnel_id' => $id,
                            'day_id' => $day,
                        ]);
                    }
                }
            }
        }
    }


    public
    function section($name)
    {

        $row = Section::where('name', $name)->first();

        if (!$row) {
            $row = Section::create([
                'name' => $name,
            ]);

        }

        return $row;
    }

    public
    function role($name)
    {
        $row = Role::where('name', $name)->first();
        if (!$row) {
            $row = Role::create([
                'name' => $name,
            ]);

        }
        return $row;
    }

    public
    function loge($name, $manager)
    {
        $row = Loge::where('name', $name)->first();
        if (!$row) {
            $row = Loge::create([
                'name' => $name,
                'manager' => $manager,
            ]);

        }
        return $row;
    }

    public
    function area($name)
    {
        $row = Area::where('name', $name)->first();
        if (!$row) {
            $row = Area::create([
                'name' => $name,
            ]);

        }
        return $row;
    }

    public
    function paymant($name)
    {
        $row = PaymentSource::where('name', $name)->first();
        if (!$row) {
            $row = PaymentSource::create([
                'name' => $name,
            ]);

        }
        return $row;
    }

    public
    function manager($name)
    {
        $row = Personnel::where('name', 'like', '%' . $name . '%')->pluck('id')->first();
        if (!$row) {
            $row = null;
        }
        return $row;
    }

}
