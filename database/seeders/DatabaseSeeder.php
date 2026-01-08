<?php

namespace Database\Seeders;

use App\Models\IndustrialType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name'      => 'admin',
            'email'     => 'admin@gmail.com',
            'password'  => Hash::make('P@ssw0rd'),
            'status'    => 1
        ]);

        $industrialTypes = [
            'Automotives',
            'Cements & Fibre cements',
            'Chemicals',
            'Electronics',
            'Food & Beverage',
            'Gasses',
            'Glass & Ceramic industry',
            'Hotels & Buildings',
            'Mining industry',
            'Oil & Gas',
            'Palm oil mills',
            'Petrochemicals',
            'Pharmaceuticals',
            'Plating industry',
            'Power plant',
            'Pulp & Paper',
            'Steel',
            'Textiles',
            'Tire industry',
        ];

        foreach ($industrialTypes as $data) {
            IndustrialType::create(['name' => $data]);
        }
    }
}
