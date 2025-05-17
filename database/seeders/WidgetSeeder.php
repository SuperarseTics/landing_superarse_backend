<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Widget;

class WidgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Widget::factory()->create([
            'name'          => 'content-slider',
            'properties'    => json_encode((object) [
                "elementId"     => "newsSwiper",
                "isNewsSlider"  => true,
                "sliderHeader"  => "",
                "hasPagination" => false
            ])
        ]);

        Widget::factory()->create([
            'name'          => 'grid-columns',
            'properties'    => json_encode((object) [
                "isCounter" => false
            ])
        ]);

        Widget::factory()->create([
            'name'          => 'links-widget',
            'properties'    => json_encode((object) [])
        ]);

        Widget::factory()->create([
            'name'          => 'menu-widget',
            'properties'    => json_encode((object) [])
        ]);
        Widget::factory()->create([
            'name'          => 'multimedia',
            'properties'    => json_encode((object) [])
        ]);
        Widget::factory()->create([
            'name'          => 'searcher-widget',
            'properties'    => json_encode((object) [])
        ]);
        Widget::factory()->create([
            'name'          => 'shortcut-widget',
            'properties'    => json_encode((object) [])
        ]);
    }
}
