<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class BranchTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();
            foreach (range(1,100) as $index) {
                DB::table('branch_types')->insert([
                    'name' => $faker->name,
                    'slug' => $faker->lastname.'_'.$faker->word.'_'.$faker->year,
                ]);
            }
    }
}
