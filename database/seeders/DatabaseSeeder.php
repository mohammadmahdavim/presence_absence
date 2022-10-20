<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DaySeeder::class);
        User::create([
            'name' => 'مسعود صیدی',
            'national_code' => '4850172059',
            'mobile' => '09168708471',
            'password' => bcrypt(4850172059),
        ]);
        User::create([
            'name' => 'نوروزی',
            'national_code' => '9124056900',
            'mobile' => '09124056900',
            'password' => bcrypt(9124056900),
        ]);
    }
}
