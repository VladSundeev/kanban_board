<?php

namespace Database\Seeders;

use App\Models\Column;
use Illuminate\Database\Seeder;

class ColumnsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Column::factory()->count(10)->create();
    }
}
