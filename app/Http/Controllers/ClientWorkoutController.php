<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ClientWorkout;
use App\Models\GymWorkOuts;
use Illuminate\Support\Facades\DB;
use App\Models\TrainrtScheduleWorkOut;

class ClientWorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ViewClientWorkout(Request $request){

        $userData = $request->get('userData');
        $user_id = $userData['user_id'];

        $work_out_id=$request->work_out_id;

        $client_workouts=ClientWorkout::with(['Workout','trainrt_schedule_work_outs.librarie.librarieurl'])
        ->where('user_id', $user_id)->where('work_outs_id',$work_out_id)->get();
         $emptyArray = array();

        if ($client_workouts) {
            return response()->json(["client_workouts"=> $client_workouts]);
        } else if (! $client_workouts) {
            return response()->json($emptyArray);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function CreateClientWorkout(Request $request){

            $this->validate($request,[
            'user_id' =>'required',
            'work_outs_id' =>'required',
            ]);

        try {

        $user_id=$request->user_id;
        $last_wor_out = ClientWorkout::where('user_id',$user_id)->value('id');

        if(!$last_wor_out==null){
        $last_wor_out = ClientWorkout::where('user_id',$user_id)
        ->orderBy('id', 'DESC')->first();
        $last_wor_out->active=0;
        $last_wor_out->update();

        }

        $work_out_data=GymWorkOuts::where('id',$request->work_outs_id)
        ->orderBy('id','DESC')
        ->first();
       // dd($work_out_data);
        $trainrt_id=$work_out_data->trainer_id;
        $schedule_discription=$work_out_data->schedule_discription;
        $schedule_name=$work_out_data->schedule_name;
        $active=1;

        $day = Carbon::now()->toDateString();

        $ClientWorkout = new ClientWorkout();
        $ClientWorkout->user_id=$user_id;
        $ClientWorkout->work_outs_id=$request->work_outs_id;
        $ClientWorkout->day=$day;
        $ClientWorkout->active=$active;
        $ClientWorkout->trainrt_id= $trainrt_id;
        $ClientWorkout->schedule_name=$schedule_name;
        $ClientWorkout->schedule_discription=$schedule_discription;
        $ClientWorkout->save();

    return response()->json(['status' => 1,'data' => "Successfully Save"], 201);
   } catch (\Throwable $th) {
   return response()->json(['status' => 0,'data' =>  $th], 403);
   }
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientWorkout  $clientWorkout
     * @return \Illuminate\Http\Response
     */
    public function show(ClientWorkout $clientWorkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClientWorkout  $clientWorkout
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientWorkout $clientWorkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClientWorkout  $clientWorkout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientWorkout $clientWorkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientWorkout  $clientWorkout
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientWorkout $clientWorkout)
    {
        //
    }
}
