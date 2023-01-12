<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\GymWorkOuts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AdminSheduleWorkOut;
use App\Models\TrainrtScheduleWorkOut;

class AdminSheduleWorkOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ViweAdminCreateSchedule(){

    $ViweAdminCreateSchedule = GymWorkOuts::with('admin_schedule_work_outs')
    ->where('trainer_id',0)->get();

    $emptyArray = array();

    if ($ViweAdminCreateSchedule ) {
        return response()->json(["data"=>$ViweAdminCreateSchedule ]);
    } else if (!$ViweAdminCreateSchedule ) {
        return response()->json($emptyArray);
    }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

        public function AdminCreateSchedule(Request $request){

            try {

                DB::beginTransaction();

                $gymworkouts = new GymWorkOuts();
                $gymworkouts->trainer_id = 0;
                $gymworkouts->schedule_name = $request->schedule_name;
                $gymworkouts->schedule_discription = $request->schedule_discription;
                $gymworkouts->save();

                $work_out_id = GymWorkOuts::where('trainer_id',0)
                ->orderBy('id','desc')->value('id');
                $libraries_id=$request->libraries_id;

                foreach ($libraries_id as  $libraries_ids) {

                $trainrtscheduleworkouts = new TrainrtScheduleWorkOut();
                $trainrtscheduleworkouts->trainrt_id= 0;
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
     * @param  \App\Models\AdminSheduleWorkOut  $adminSheduleWorkOut
     * @return \Illuminate\Http\Response
     */
    public function show(AdminSheduleWorkOut $adminSheduleWorkOut)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdminSheduleWorkOut  $adminSheduleWorkOut
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminSheduleWorkOut $adminSheduleWorkOut)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdminSheduleWorkOut  $adminSheduleWorkOut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminSheduleWorkOut $adminSheduleWorkOut)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminSheduleWorkOut  $adminSheduleWorkOut
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminSheduleWorkOut $adminSheduleWorkOut)
    {
        //
    }
}
