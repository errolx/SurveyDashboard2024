<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		DB::table('departments')->insert(
			[
				'id'          => 1,
				'dept'    		=> 'Admin',
				'deptname'    		=> 'Admin',
				'created_at'  => Carbon::now(),
				'updated_at'  => Carbon::now(),
			]
		);
    }
}
