<?php

use Illuminate\Database\Seeder;

class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tickets')->insert([
            'theater_id' => '1',
            'ticket_name' => '一般',
            'ticket_price' => '1800'
        ]);

        DB::table('tickets')->insert([
            'theater_id' => '1',
            'ticket_name' => '大学生',
            'ticket_price' => '1500'
        ]);

        DB::table('tickets')->insert([
            'theater_id' => '1',
            'ticket_name' => '高校生',
            'ticket_price' => '1000'
        ]);

        DB::table('tickets')->insert([
            'theater_id' => '1',
            'ticket_name' => '小中学生',
            'ticket_price' => '1000'
        ]);

        DB::table('tickets')->insert([
            'theater_id' => '1',
            'ticket_name' => '幼児（3才～）',
            'ticket_price' => '1000'
        ]);
    }
}
