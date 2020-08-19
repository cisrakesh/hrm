<?php

use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10; $i++) { 
        	DB::table('staff')->insert([
	            'name' => $this->createName(),
	        ]);
        }
    }

    function createName(){
    	
    	$firstName=$this->firstName();
    	$lastName=$this->lastName();
    	return $firstName ." ".$lastName;
    }

    function firstName(){
    	$index=rand(0,9);

    	$names=['rakesh',"rajesh","umesh","vinod","amit","amitabh","abhishek","abhinav","nilesh","milind","sushant","anupam"];
    	return $names[$index];
    }

    function lastName(){
    	$index=rand(0,9);

    	$names=["khanna","chpora","shukla","mishra","dua","jain","singh","bishnoi","kushwaha","shrama","thakur","rajput"];
    	return $names[$index];
    }

}
