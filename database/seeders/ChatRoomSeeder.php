<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ChatRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms[] = [
            'name' => 'Channel Default'
        ];

        $rooms[] = [
            'name' => 'Channel One'
        ];


        DB::table('chat_rooms')->insert( $rooms );
    }
}
