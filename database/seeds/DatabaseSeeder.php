<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $roles = Config::get('default.roles');
        // foreach ($roles as $key => $role) {
        //     Role::create($role);
        // }
        // $permissions = Config::get('default.permissions');
        // foreach ($permissions as $key => $permission) {
        //     Permission::create($permission);
        // }
        // $users = Config::get('default.users');
        // foreach ($users as $key => $user) {
        //     $u = User::create($user);
        // }

        // $faker = Faker::create();
        // foreach (range(1,10) as $index) {
        //     DB::table('users')->insert([
        //         'name' => $faker->name,
        //         'email' => $faker->email,
        //         'mobile' => $faker->numberBetween(1,10000000),
        //         'password' => bcrypt('secret'),
        //         'slug' => $faker->name."_".$faker->word,
        //         'referrer_id' => "1",
        //         'referrer_type' => $faker->asciify('********************'),
        //         'is_email_valid' => "1",
        //     ]);
        //}

        $value = 100;

        // $date = date_create();
        // $faker = Faker::create();
        // foreach (range(1, $value) as $index) {
        //     DB::table('company_types')->insert([
        //         'name' => $faker->name,
        //         'slug' => $faker->lastname . '_' . $faker->word . '_' . $faker->year,
        //         'updated_at' => date_format($date, 'Y-m-d H:i:s'),
        //         'created_at' => date_format($date, 'Y-m-d H:i:s'),
        //     ]);
        // }

        // $faker = Faker::create();
        // foreach (range(1, $value) as $index) {
        //     DB::table('companies')->insert([
        //         'name' => $faker->name,
        //         'slug' => $faker->lastname . '_' . $faker->word . '_' . $faker->year.'_'.$faker->numberBetween(1,100),
        //         'company_type_id'=>$faker->numberBetween(1,$value),
        //         'about' =>$faker->paragraph($nbSentences=3,$variableNbSentences=true),
        //         'meta' =>json_encode(['key' => $faker->word]),
        //         ]);
        // }


        // $faker = Faker::create();
        // foreach (range(1, $value) as $index) {
        //     DB::table('currencies')->insert([
        //         'name' => $faker->name,
        //         'short_code'=>strtoupper($faker->lexify('*****')),
        //         'sign'=>$faker->lexify('***'),
        //     ]);
        // }

        // $faker = Faker::create();
        // foreach (range(1, $value) as $index) {
        //     DB::table('countries')->insert([
        //         'name' => $faker->name,
        //         'short_code'=>strtoupper($faker->word),
        //         'currency_id'=>$faker->numberBetween(1,$value),
        //         'flag'=>$faker->word
        //     ]);
        // }

        // // $faker = Faker::create();
        // // foreach (range(1, $value) as $index) {
        // //     DB::table('states')->insert([
        // //         'country_id' => $faker->numberBetween(1,$value),
        // //         'name' => $faker->name,
        // //         'short_code'=>strtoupper($faker->lexify('*****')),
        // //     ]);
        // // }

        // $faker = Faker::create();
        // foreach (range(1, $value) as $index) {
        //     DB::table('cities')->insert([
        //         'name' => $faker->name,
        //         'state_id'=>$faker->numberBetween(1,$value),
        //         'short_code'=>strtoupper($faker->lexify('*****')),
        //     ]);
        // }


        // $faker = Faker::create();
        // foreach (range(1, $value) as $index) {
        //     DB::table('units')->insert([
        //         'company_id' => $faker->numberBetween(1,$value),
        //         'sub_unit_value' => $faker->numberBetween(1,5),
        //         'name' => $faker->name,
        //         'slug' => $faker->lastname . '_' . $faker->word . '_' . $faker->year,
        //         'short_code'=>strtoupper($faker->asciify('***')),
        //     ]);
        // }

        // $faker = Faker::create();
        // foreach (range(1, $value) as $index) {
        //     DB::table('variations')->insert([
        //         'company_id' => $faker->numberBetween(1,$value),
        //         'sub_variation_id' => $faker->numberBetween(1,$value),
        //         'title' => $faker->sentence,
        //         'description' => $faker->paragraph($nbSentences=3,$variableNbSentences=true),
        //         'is_multi_selected' => $faker->numberBetween(0,2),
        //         'is_default_selected' => $faker->numberBetween(0,2),
        //         'meta' => json_encode(['key' => $faker->word]),
        //         'slug' => $faker->lastname . '_' . $faker->word . '_' . $faker->year,
        //     ]);


        //     $faker = Faker::create();
        //     foreach (range(1, $value) as $index) {
        //         DB::table('dietary_preferences')->insert([
        //             'name' => $faker->name,
        //             'slug' => $faker->lastname . '_' . $faker->word . '_' . $faker->year,
        //             'description' => $faker->paragraph,
        //             'deleted_at' => date_format($date, 'Y-m-d H:i:s'),
        //             ]);
        //     }
    

        // $faker = Faker::create();
        // foreach (range(1, $value) as $index) {
        //     DB::table('branches')->insert([
        //         'name' => $faker->name,
        //         'slug' => $faker->lastname . '_' . $faker->word . '_' . $faker->year,
        //         'branch_type_id' => $faker->numberBetween(1,$value),
        //         'email'=> $faker->email,
        //         'mobile'=>$faker->numberBetween(1,10000000),
        //         'country_id'=>$faker->numberBetween(1,$value),
        //         'company_id'=>$faker->numberBetween(1,$value),
        //         'state_id'=>$faker->numberBetween(1,$value),
        //         'city_id'=>$faker->numberBetween(1,$value),
        //         'about'=>$faker->paragraph($nbSentences=3,$variableNbSentences=true),
        //         'pan_number'=> strtoupper($faker->word).$faker->year,
        //         'website'=>"https://www.".$faker->domainName.".com",
        //         'postal_code'=>$faker->numberBetween(100000,999999),
        //         'meta' => json_encode(['key' => $faker->word])
        //         ]);
        // }

        // $faker = Faker::create();
        // foreach (range(1, $value) as $index) {
        //     DB::table('categories')->insert([
        //         'name' => $faker->name,
        //         'slug' => $faker->lastname . '_' . $faker->word . '_' . $faker->year,
        //         'parent_id'=>$faker->numberBetween(1,$value),
        //         'company_id'=>$faker->numberBetween(1,$value)
        //         ]);
        // }

        // $faker = Faker::create();
        // foreach (range(1, $value) as $index) {
        //     DB::table('products')->insert([
        //         'slug' => $faker->lastname . '_' . $faker->word . '_' . $faker->year,
        //         'category_id' => $faker->numberBetween(1,$value),
        //         'dietary_preference_id' => $faker->numberBetween(1,$value),
        //         'title' => $faker->sentence,
        //         'description' => $faker->paragraph($nbSentences=3,$variableNbSentences=true),
        //         'hsn_code' => $faker->numberBetween(111111,9999999),
        //         'meta' => json_encode(['key' => $faker->word]),
        //     ]);
        // }

        // $faker = Faker::create();
        // foreach (range(1, $value) as $index) {
        //     DB::table('product_units')->insert([
        //         'product_id' =>$faker->numberBetween(1,$value),
        //         'unit_id' =>$faker->numberBetween(1,$value),
        //         'is_default_selected' => $faker->numberBetween(0,2),
        //         'is_base_unit' => $faker->numberBetween(0,2),
        //         'meta' => json_encode(['key' => $faker->word]),
        //         ]);
        // }

        $faker = Faker::create();
        foreach (range(1, $value) as $index) {
            DB::table('product_has_addons')->insert([
                'sale_price' =>$faker->numerify('####.##'),
                'product_id' =>$faker->numberBetween(1,$value),
                'is_in_stock' => $faker->numberBetween(0,2),
                'meta' =>json_encode(['key' => $faker->word]),
                ]);
        }


        $faker = Faker::create();
        foreach (range(1, $value) as $index) {
            DB::table('menus')->insert([
                'name' => $faker->name,
                'slug' => $faker->lastname . '_' . $faker->word . '_' . $faker->year,
                'branch_id'=>4,
                'is_active'=> $faker->numberBetween(0,2)
            ]);
        }

        $faker = Faker::create();
        foreach (range(1, $value) as $index) {
            DB::table('menu_has_products')->insert([
                'menu_id' => 24,
                'product_id' =>$faker->numberBetween(1,$value),
                'sale_price' =>$faker->numerify('####.##'),
                'is_in_stock' => $faker->numberBetween(0,2),
                'meta' =>json_encode(['key' => $faker->word]),
                ]);
        }


        $faker = Faker::create();
        foreach (range(1, $value) as $index) {
            DB::table('counters')->insert([
                'name' => $faker->name,
                'slug' => $faker->lastname . '_' . $faker->word . '_' . $faker->year,
                'branch_id'=>4,
                'menu_id'=>24,
                'about' =>$faker->paragraph($nbSentences=3,$variableNbSentences=true),
            ]);
        }


        $faker = Faker::create();
        foreach (range(1, $value) as $index) {
            DB::table('selections')->insert([
                'title' => $faker->sentence,
                'menu_has_product_id' => 13,
                'variation_id' => 20,
                'description' => $faker->paragraph($nbSentences=3,$variableNbSentences=true),
                'have_relations' => $faker->numberBetween(0,2),
                'is_weight_verianted' => $faker->numberBetween(0,2),
                'is_default_selected' => $faker->numberBetween(0,2),
                'slug' => $faker->lastname . '_' . $faker->word . '_' . $faker->year,
                'meta' => json_encode(['key' => $faker->word]),
            ]);
        }



        // $faker = Faker::create();
        // foreach (range(1, $value) as $index) {
        //     DB::table('model_has_permissions')->insert([
        //         'name' => $faker->name,
        //         'slug' => $faker->lastname . '_' . $faker->word . '_' . $faker->year,
        //     ]);
        // }

        // $faker = Faker::create();
        // foreach (range(1, $value) as $index) {
        //     DB::table('model_has_roles')->insert([
        //         'name' => $faker->name,
        //         'slug' => $faker->lastname . '_' . $faker->word . '_' . $faker->year,
        //     ]);
        // }

        // $faker = Faker::create();
        // foreach (range(1, $value) as $index) {
        //     DB::table('password_resets')->insert([
        //         'name' => $faker->name,
        //         'slug' => $faker->lastname . '_' . $faker->word . '_' . $faker->year,
        //     ]);
        // }

        // $faker = Faker::create();
        // foreach (range(1, $value) as $index) {
        //     DB::table('permissions')->insert([
        //         'name' => $faker->name,
        //         'slug' => $faker->lastname . '_' . $faker->word . '_' . $faker->year,
        //     ]);
        // }


        // $faker = Faker::create();
        // foreach (range(1, $value) as $index) {
        //     DB::table('role_has_permissions')->insert([
        //         'name' => $faker->name,
        //         'slug' => $faker->lastname . '_' . $faker->word . '_' . $faker->year,
        //     ]);
        // }

        // $faker = Faker::create();
        // foreach (range(1, $value) as $index) {
        //     DB::table('roles')->insert([
        //         'name' => $faker->name,
        //         'slug' => $faker->lastname . '_' . $faker->word . '_' . $faker->year,
        //     ]);
        // }


        // $faker = Faker::create();
        // foreach (range(1, $value) as $index) {
        //     DB::table('social_authentications')->insert([
        //         'name' => $faker->name,
        //         'slug' => $faker->lastname . '_' . $faker->word . '_' . $faker->year,
        //     ]);
        // }
        
    }
}
