<?php

namespace Database\Seeders;

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            '0' => [
                'name' => 'Admin',
                'slug' => 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            '1' => [
                'name' => 'Agent',
                'slug' => 'agent',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            '2' => [
                'name' => 'Merchant',
                'slug' => 'merchant',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
