<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\GymWorkOuts;
use Illuminate\Http\Request;
use App\Models\WorkOutschedule;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;
use App\Models\TrainrtScheduleWorkOut;

class WorkOutscheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewTrainerCreateSchedule(Request $request){
        $trainer_id=$request->trainer_id;
        $TrainerCreateSchedule = GymWorkOuts::with('trainrt_schedule')
        ->where('trainer_id',$trainer_id)->get();

        $emptyArray = array();

        if ($TrainerCreateSchedule ) {
            return response()->json(["TrainerCreateSchedule"=>$TrainerCreateSchedule ]);
        } else if (!$TrainerCreateSchedule ) {
            return response()->json($emptyArray);
        }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function TrainerCreateSchedule(Request $request){

        try {

            $trainer_id = $request->trainer_id;
            DB::beginTransaction();

            $gymworkouts = new GymWorkOuts();
            $gymworkouts->trainer_id = $trainer_id;
            $gymworkouts->schedule_name = $request->schedule_name;
            $gymworkouts->schedule_discription = $request->schedule_discription;
            $gymworkouts->save();

            $work_out_id = GymWorkOuts::where('trainer_id',$trainer_id)
            ->orderBy('id','desc')->value('id');
            $libraries_id=$request->libraries_id;

            foreach ($libraries_id as  $libraries_ids) {

            $trainrtscheduleworkouts = new TrainrtScheduleWorkOut();
            $trainrtscheduleworkouts->trainrt_id= $trainer_id;
            $trainrtscheduleworkouts->work_out_id=$work_out_id;
            $trainrtscheduleworkouts->libraries_id=$libraries_ids;
            $trainrtscheduleworkouts->save();
            }
            DB::commit();
            return response()->json(['status' => 1,'data' => "Successfully Saved"], 201);

            }catch (Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 0,'data' => $e ], 403);

        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkOutschedule  $workOutschedule
     * @return \Illuminate\Http\Response
     */
    public function viewTrainerCreateScheduleWorkOut(WorkOutschedule $workOutschedule){


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkOutschedule  $workOutschedule
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkOutschedule $workOutschedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WorkOutschedule  $workOutschedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkOutschedule $workOutschedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkOutschedule  $workOutschedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkOutschedule $workOutschedule)
    {
        //
    }
}
