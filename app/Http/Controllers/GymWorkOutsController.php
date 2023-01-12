<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\libraries;
use App\Models\GymWorkOuts;
use Illuminate\Http\Request;
use App\Models\ClientWorkout;
use App\Models\ClientDailyWorkoutDetlis;
use App\Models\Trainer;
use App\Models\TrainrtScheduleWorkOut;
use Illuminate\Support\Facades\DB;

class GymWorkOutsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function DaliyScheduleCalulation(Request $request){


        $this->validate($request,[
        'schedule_count' =>'required',

        ]);
        try {
        $day = Carbon::now()->toDateString();

        $userData = $request->get('userData');
        $user_id = $userData['user_id'];
        $schedule_count=$request->schedule_count;

        $work_outs_id=ClientWorkout::where('user_id',$user_id)->orderBy('id','DESC')
        ->value('work_outs_id');
        $trainrt_id=TrainrtScheduleWorkOut::where('work_out_id',$work_outs_id)->orderBy('id','DESC')
        ->value('trainrt_id');

       $client_workouts= DB::table('gym_work_outs')
      ->join('client_workouts', 'gym_work_outs.id', '=','client_workouts.work_outs_id')
      ->join('trainrt_schedule_work_outs', 'gym_work_outs.id', '=','trainrt_schedule_work_outs.work_out_id')
      ->select('gym_work_outs.schedule_name','gym_work_outs.schedule_discription','client_workouts.day',
       DB::raw("count(trainrt_schedule_work_outs.libraries_id) as count",))
      ->where('user_id', $user_id)
     // ->where('trainrt_id',$trainrt_id)
      ->groupBy('gym_work_outs.id')
      ->groupBy('client_workouts.id')
      ->orderBy('client_workouts.id','DESC')
      ->get();

        $Progress=$schedule_count/$client_workouts[0]->count*100;

        $schedule_count = $request->schedule_count;
        $ClientDailyWorkoutDetlis = new  ClientDailyWorkoutDetlis();
        $ClientDailyWorkoutDetlis->user_id=$user_id;
        $ClientDailyWorkoutDetlis->schedule_count=$schedule_count;
        $ClientDailyWorkoutDetlis->day=$day;
        $ClientDailyWorkoutDetlis->feedback=$request->feedback;
        $ClientDailyWorkoutDetlis->progress= $Progress;
        $ClientDailyWorkoutDetlis->work_outs_id = $work_outs_id;
        $ClientDailyWorkoutDetlis->trainrt_id= $trainrt_id;
        $ClientDailyWorkoutDetlis->save();

        return response()->json(['status' => 1,'data' => "Successfully Save"], 201);
        } catch (\Throwable $th) {
        return response()->json(['status' => 0,'data' =>  $th], 403);
        }
             }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GymWorkOuts  $gymWorkOuts
     * @return \Illuminate\Http\Response
     */

    public function ClientViweProgress(Request $request){

        $userData = $request->get('userData');
        $user_id = $userData['user_id'];
        $day = Carbon::now()->toDateString();
        $client_workout=ClientWorkout::with(['Workout','process.getrainer_name'])
       ->where('user_id', $user_id)->get();
        //dd($client_workout);



       $emptyArray = array();

        if ($client_workout) {
            return response()->json(["data"=>$client_workout]);
        } else if (!$client_workout) {
            return response()->json($emptyArray);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GymWorkOuts  $gymWorkOuts
     * @return \Illuminate\Http\Response
     */
    public function edit(GymWorkOuts $gymWorkOuts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GymWorkOuts  $gymWorkOuts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GymWorkOuts $gymWorkOuts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GymWorkOuts  $gymWorkOuts
     * @return \Illuminate\Http\Response
     */
    public function destroy(GymWorkOuts $gymWorkOuts)
    {
        //
    }
}
