<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\libraries;

use Illuminate\Http\Request;
use App\Models\libraries_icon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class LibrariesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function workouts_views(){

          $libraries_views = libraries::with(['libraries_icons'])->get();
          $emptyArray = array();

         if ($libraries_views) {
             return response()->json(["ibraries_views"=>$libraries_views]);
         } else if (!$libraries_views) {
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
    public function WorkoutsStore(Request $request){

         $this->validate($request,[

           'schedule_name' => 'required',
           'description' => 'required',
           'repetitions' => 'required',
           'set' => 'required',
           'weight' => 'required',
           'images_url' =>'required',
       ]);
        try{
          DB::beginTransaction();

         $libraries = new libraries();
         $libraries->schedule_name=$request->schedule_name;
         $libraries->description=$request->description;
         $libraries->set=$request->set;
         $libraries->repetitions=$request->repetitions;
         $libraries->weight=$request->weight;
         $libraries->save();

         $images_url=$request->images_url;
         $ibrsries_id = DB::table('libraries')->orderBy('id', 'desc')->value('id');

         $attachImagesWithLibrary = collect($images_url)->each(function ($value) use($ibrsries_id) {
            $libraries_icons = new libraries_icon();
            $libraries_icons->libraries_id = $ibrsries_id;
            $libraries_icons->images_url = $value;
            $libraries_icons->save();
         });
         DB::commit();
         return response()->json(['status' => 1, 'data' => "Successfully Create"], 200);
         } catch (Exception $e) {
         DB::rollBack();
         return response()->json(['status' => 0,'data' => $e ], 403);


    }
}
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\libraries  $libraries
     * @return \Illuminate\Http\Response
     */
    public function show(libraries $libraries)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\libraries  $libraries
     * @return \Illuminate\Http\Response
     */
    public function edit(libraries $libraries)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\libraries  $libraries
     * @return \Illuminate\Http\Response
     */
    public function UpdateWorkout(Request $request,$id){

        try{

        DB::beginTransaction();
        $libraries = libraries::findorfail($id);
        $libraries->schedule_name=$request->schedule_name;
        $libraries->description=$request->description;
        $libraries->set=$request->set;
        $libraries->repetitions=$request->repetitions;
        $libraries->weight=$request->weight;
        $libraries->save();

        $images=$request->images;

             foreach( $images as $libraries_icon_update) {


             $images_urls=$libraries_icon_update['images_url'];

             $all_libraries_icon=libraries_icon::where('id',$libraries_icon_update['id'])->first();
             $all_libraries_icon->images_url=$images_urls;
             $all_libraries_icon->update();
       }
       DB::commit();
       return response()->json(['status' => 1, 'data' => "UpdateIbrarie updated "], 200);
       } catch (Exception $e) {
        DB::rollBack();
        return response()->json(['status' => 0,'data' => $e ], 403);
      }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\libraries  $libraries
     * @return \Illuminate\Http\Response
     */
    public function DeleteWorkout($id){

           try{
           DB::beginTransaction();
           $delete_libraries = libraries::findorfail($id);

           $libraries_id = libraries_icon::where('libraries_id',$id)->pluck('id');

            foreach($libraries_id as $libraries_date ){

           $libraries_ids = libraries_icon::findorfail($libraries_date);
            $libraries_ids->delete();

           }

            $delete_libraries->delete();
            DB::commit();
            return response()->json(['status' => 1,'data' => "Successfully Deleted"], 200);
          } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 0,'data' => $e ], 403);

        }

    }
}
