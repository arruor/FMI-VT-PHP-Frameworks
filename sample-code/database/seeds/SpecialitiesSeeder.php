<?php

use Illuminate\Database\Seeder;

class SpecialitiesSeeder extends Seeder
{
    private $specialities = [
        ['name' => 'Софтуерно Инженерство', 'name_short' => 'СИ'],
        ['name' => 'Информатика', 'name_short' => 'И'],
        ['name' => 'Математика', 'name_short' => 'M'],
        ['name' => 'Компютърни науки', 'name_short' => 'КН'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->specialities as $spec) {
            DB::table('specialities')->insert([
                'name' => $spec['name'],
                'name_short' => $spec['name_short'],
            ]);
        }
    }
}
