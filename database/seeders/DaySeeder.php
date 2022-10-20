<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = [
            '14010214',
            '14010215',
            '14010216',
            '14010217',
            '14010218',
            '14010219',
            '14010220',
            '14010221',
            '14010222',
            '14010223',
            '14010224',
            '14010225',
            '14010226',
            '14010227',
            '14010228',
            '14010229',
            '14010230',
            '14010231',
            '14010302',
            '14010303',
            '14010304',
        ];
        foreach ($days as $day) {
            if (!Day::where('name',$day)->first()){
                Day::create(['name' => $day]);

            }
        }
    }
}
