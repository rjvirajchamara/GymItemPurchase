<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientWorkoutFeedback;

class ClientWorkoutFeedbackController extends Controller{

    public function Createfeedback(Request $request){

        try {

         $ClientWorkoutFeedback = new ClientWorkoutFeedback();
         $ClientWorkoutFeedback->feedback=$request->feedback;
         $ClientWorkoutFeedback->save();

         return response()->json(['status' => 1,'data' => "Successfully Save"], 201);
         } catch (\Throwable $th) {
         return response()->json(['status' => 0,'data' =>  $th], 403);
        }
       }

     public function viewfeedback(Request $request){

        $ClientWorkoutFeedback = ClientWorkoutFeedback::all('feedback');
        $emptyArray = array();

       if ($ClientWorkoutFeedback) {
           return response()->json(["ClientWorkoutFeedback"=>$ClientWorkoutFeedback]);
       } else if (!$ClientWorkoutFeedback) {
           return response()->json($emptyArray);
       }


     }

  }


