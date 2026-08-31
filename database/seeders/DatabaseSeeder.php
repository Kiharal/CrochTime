<?php

namespace Database\Seeders;


use App\Models\category;
use App\Models\Task;
use App\Models\Item;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\IOFactory;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
/* 
        User::factory()->create([
            'name' => 'Tester',
            'email' => 'test@example.com',

        ]);
        */
        //Seed Categories
        $rows = IOFactory::load(database_path('/seeders/Categories.xlsx'))
                        ->getActiveSheet()
                        ->toArray();

        

        $header = array_map('trim', array_shift($rows));
        $header = array_map('strtolower', $header);

        foreach($rows as $i => $row){
            //Skip the first row: headers(to avaoid any form of discrepancy)
            $data = array_combine($header, $row);
            category::create([
                'category' => $data['category'],
                'min_time' => $data['min'],
                'max_time' => $data['max'],
                'products' => $data['examples']
            ]);
        }

        //Load factories
        
        Item::factory(10)->create();

    }
}
