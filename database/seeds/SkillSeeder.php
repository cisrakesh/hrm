<?php

use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
    	$names=["php","java","mysql","jquery","oops","angular","react","D3js"];
        for ($i=0; $i < sizeof($names); $i++) { 
        	DB::table('skills')->insert([
	            'title' =>$names[$i],
	        ]);
        }
    }

    

    

    
}
