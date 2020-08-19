<?php

namespace App\Http\Controllers;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Model\{Feedbacks,Pundit,Schedule,Skills,Staff};
class ApiController extends Controller
{
	function index(){

    	return Response::json(array("msg" => "Welcome to Rest API"));
    }

    function createScheduleInterview(Request $request){
    	
    	
    	
    	if($request->isMethod('post')){
    		$data=['pundit_id'=>$request->pundit_id,
	               'interviewer_id'=>$request->interviewer_id,
	                'scheduled_by'=>$request->scheduled_by,
	                'scheduled_date_time'=>$request->scheduled_date_time,
	                'interview_title'=>$request->interview_title,
	                'status'=>$request->status];
    		$validator = \Validator::make($data, [
	                "pundit_id"          => 'required|exists:pundit,id',
	                "interviewer_id"     => 'required|exists:staff,id',
	                "scheduled_by"       => 'required|exists:staff,id', 
	                "scheduled_date_time"=> 'required|date|date_format:Y-m-d H:i:s', 
	                "interview_title"    => 'required', 
	                "status"        => [
                                       		'required',
                                        	Rule::in(Config('constants.interviewStatus'))
                                       ]
	            ]);
    		if ($validator->fails()){
    			
    			$errors = $validator->getMessageBag()->toArray();
    			return Response::json(array("msg" => "validation failed","errors"=>$errors), 201);
	    	}else{
	    		$schedule = new Schedule();
	    			$schedule->pundit_id=$request->pundit_id;
	                $schedule->interviewer_id=$request->interviewer_id;
	                $schedule->scheduled_by=$request->scheduled_by;
	                $schedule->scheduled_date_time=$request->scheduled_date_time;
	                $schedule->interview_title=$request->interview_title;
	                $schedule->status=$request->status;
	                if($schedule->save()){
	                	return Response::json(array("msg" => "Record created successfully"), 200);
	                }else{
	                	return Response::json(array("msg" => "Some error occured"), 201);
	                }
	    		
	    	}
    	}
    }

    function getSchedule(Request $request,$id=null){
    	
    	$schedule=Schedule::find($id);
    	if(is_null($schedule)){
    		return Response::json(array("msg" => "Some error occured"), 201);
    	}else{
    		return Response::json(array("msg" => "Record created successfully","data"=>$schedule), 200);
    	}
    }

    function createFeedback(Request $request){
    	if($request->isMethod('post')){

    		$skillIds=$request->skillIds;
    		$ratings=$request->ratings;
    		$scheduleId=$request->schedule_id;
    		$schedule=Schedule::find($scheduleId);
    		if(is_null($schedule)){
	    		return Response::json(array("msg" => "Some error occured"), 201);
	    	}
    		try {
	            DB::beginTransaction();
	    		if(is_array($skillIds)){
	    			foreach ($skillIds as $key => $eachSkillId) {
		    			$data=['status'=>$request->status,
			               		'schedule_id'=>$request->schedule_id,
			                	'skill_id'=>$eachSkillId,
			                	'rating'=>$ratings[$key]
			                ];
			    		$validator = \Validator::make($data, [
				                "schedule_id" => 'required|exists:schedule,id',
				                "skill_id"     => 'required|exists:skills,id',
				                "rating"       => 'required'
				            ]);
			    		if ($validator->fails()){
			    			DB::rollBack();
			    			$errors = $validator->getMessageBag()->toArray();
			    			return Response::json(array("msg" => "validation failed","errors"=>$errors), 201);
			    			exit();
				    	}else{
				    		$feedback = new Feedbacks();
			    			$feedback->schedule_id=$request->schedule_id;
			                $feedback->skill_id=$eachSkillId;
			                $feedback->rating=$ratings[$key];
			                $feedback->save();
				    	}
			    	}
	    			if(in_array($request->status, Config('constants.interviewStatus'))){
	    				$schedule->status=$request->status;
	    				$schedule->save();
	    				DB::commit();
	    				return Response::json(array("msg" => "Record created successfully"), 200);
	    			}else{
	    				DB::rollBack();
            			return Response::json(array("msg" => "Some error occured"), 201);
	    			}
	    			
	    		}
	    	} catch (\Exception $e) {
	    		
            	DB::rollBack();
            	return Response::json(array("msg" => "Some error occured"), 201);
        	}

    		
    	}
    }

    

}
