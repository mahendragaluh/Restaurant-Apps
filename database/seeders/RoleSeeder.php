<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->insert([
            ["name" => "Admin"],
            ["name" => "Waiter"],
            ["name" => "Kasir"],
            ["name" => "Owner"],
            ["name" => "Pelanggan"],
        ]);
    }
}
