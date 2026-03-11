<?php

namespace Database\Seeders;

use App\Models\Cases;
use App\Models\Category;
use App\Models\Level;
use App\Models\Setting;
use App\Models\WithdrawSystem;
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
        if(!Setting::query()->first()) {
            Setting::query()->create([
                'description' => 'Описание',
                'keywords' => 'Словечки'
            ]);
        }
    }
}
