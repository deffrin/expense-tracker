<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Food'
            ],
            [
                'name' => 'Transportation'
            ],
            [
                'name' => 'Fuel'
            ],
            [
                'name' => 'Entertainment'
            ],
            [
                'name' => 'Grocery'
            ],
            [
                'name' => 'Water'
            ],
            [
                'name' => 'Electricity'
            ],
            [
                'name' => 'Rent'
            ],
            [
                'name' => 'Hotel'
            ],
            [
                'name' => 'Internet'
            ],
            [
                'name' => 'Mobile Recharge'
            ],
            [
                'name' => 'Gas'
            ],
            [
                'name' => 'Healthcare'
            ],
            [
                'name' => 'Medicine'
            ],
            [
                'name' => 'Education'
            ],
            [
                'name' => 'Insurance'
            ],
            [
                'name' => 'Subscriptions'
            ],
            [
                'name' => 'Childcare'
            ],
            [
                'name' => 'Home Maintenance'
            ],
            [
                'name' => 'Mutual Fund'
            ],
        ]);
    }
}
