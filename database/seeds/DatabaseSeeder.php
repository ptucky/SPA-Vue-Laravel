<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
            //$this->call(UsersTableSeeder::class);

			DB::table('users')->insert([
            [  
                'name' => 'Ptucky2',
                'email' => 'w.ptucky2@gmail.com',
                'password' => bcrypt('start*123')
            ],
            [  
                'name' => 'Ptucky3',
                'email' => 'w.ptucky3@gmail.com',
                'password' => bcrypt('start*123')
            ], 
            [  
                'name' => 'Ptucky4',
                'email' => 'w.ptucky4@gmail.com',
                'password' => bcrypt('start*123')
            ]		
      ]);			
		
    }
}
