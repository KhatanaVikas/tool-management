<?php

use Illuminate\Database\Seeder;

class ToolGroupTableSeeder extends DatabaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tool_groups')->insert([
            'name' => 'Measuring Tools',
        ]);
        DB::table('tool_groups')->insert([
            'name' => 'Power Tools',
        ]);
        DB::table('tool_groups')->insert([
            'name' => 'Cutting Tools',
        ]);
        DB::table('tool_groups')->insert([
            'name' => 'Air Presure Tools',
        ]);
    }
}
