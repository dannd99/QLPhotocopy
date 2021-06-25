<?php

use Illuminate\Database\Seeder;
use App\Models\Authen;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Authen::create([
        	"secret_key" 		=> "3745821",
        	"email" 			=> "danlv99nd@gmail.com",
        	"password" 			=> bcrypt('anhdannd99'),
        ]);
    }
}
