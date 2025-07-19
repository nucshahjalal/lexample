<?php

namespace Database\Seeders;

 use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlogTestModel;
use database\Factories\BlogTestFactory;

class DatabaseSeeder extends Seeder
{
   // protected $model = BlogTestModel::class;
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $this->call(UserSeeder::class);
        $this->call(PermissionTableSeeder::class);
       // BlogTestModel::factory(10)->create();
         //\App\Models\BlogTestModel::factory(10)->create();
        // \App\Models\User::factory(10)->create();
        // \App\Models\BlogTestModel::factory(10)->create();

//         \App\Models\BlogTestModel::factory()->create([
//             'title' => 'News Blog',
//             'note' => 'Blog Details',
//         ]);
    }
}
