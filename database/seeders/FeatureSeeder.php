<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Feature;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Feature::factory()->count(10)->create();

        // $feature = \App\Models\Feature::factory()->create([
        //     'name' => 'Feature Product',
        // ]);
    }
}
