<?php

use Illuminate\Database\Seeder;

class PunditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10; $i++) { 
        	DB::table('pundit')->insert([
	            'name' => $this->createName(),
	            'experiance'=>rand(0,15),
	            'primary_skills'=>$this->skillName(),
	            'secondary_skills'=>$this->skillName(),
	            'contact_num'=>$this->contactNumber(),
	            "email"=>$this->firstName()."@gmail.com"
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

    function skillName(){
    	$index=rand(0,7);

    	$names=["php","java","mysql","jquery","oops","angular","react","D3js"];
    	return $names[$index];
    }

    function contactNumber(){
    	$contactNum="";
    	for ($i=1; $i <=10 ; $i++) { 
    		$contactNum.=rand(1,9);

    	}
    	return $contactNum;
    }

    
}
