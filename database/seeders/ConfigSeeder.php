<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Configuration;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Configuration::factory()->create([
            'name'          => 'MenuHeader',
            'information'   => json_encode((object) [ "color" => "green", "limit" => 4, "background" => "black" ])
        ]);

        Configuration::factory()->create([
            'name'          => 'Menu',
            'information'   => json_encode((object) [ "color" => "green", "limit" => 4, "background" => "black" ])
        ]);

        Configuration::factory()->create([
            'name'          => 'Submenu',
            'information'   => json_encode((object) [ "color" => "green", "limit" => 4, "background" => "black" ])
        ]);

        Configuration::factory()->create([
            'name'          => 'Logo',
            'information'   => json_encode((object) [ "url" => "" ])
        ]);

        Configuration::factory()->create([
            'name'          => 'Contact',
            'information'   => json_encode((object) [ "phone1" => "(02) 393-0980", "address" => "Av. Gral. Rumiñahui 1062, Quito" ])
        ]);
    }
}
