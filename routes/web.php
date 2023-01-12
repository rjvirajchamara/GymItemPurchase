<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemOderController;
use App\Http\Controllers\AdditionalServiceController;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/user-check','UserCheckController@userCheck');

    //user
   // $router->group(['middleware' => 'isuser'], function (){
    $router->group(['middleware' => 'isuser'], function () use ($router) {

    $router->get('/viewitem', 'ItemController@item_viwe');
    $router->post('/ItemSeach', 'ItemController@itemSeach');

    $router->get('/ViweAddAdditionlService','AdditionalServiceController@AdditionalServiceController_viwe');
    $router->post('/AdditionlServiceDeleteSeach/{id}', 'AdditionalServiceController@SeachService');

     // Cartservice api
     $router->post('/AddCart', 'CartController@AddCart');
     $router->get('/viweCart','CartController@ViweCart');
     $router->delete('/oneitemdelete/{id}','CartController@one_item_delete');

     $router->post('/daliyschedulecalulation','GymWorkOutsController@DaliyScheduleCalulation');
     $router->get('/clientviweprogress','GymWorkOutsController@ClientViweProgress');

     $router->get('/viewclientworkout', 'ClientWorkoutController@ViewClientWorkout');
     $router->get('/viewfeedback','ClientWorkoutFeedbackController@viewfeedback');

    // Additionalservice api
    $router->post('/AddAdditionalserviceCart', 'AdditionalServiceCarController@AddCart');
    $router->get('/viweAdditionalserviceCart','AdditionalServiceCarController@ViweCart');
    $router->delete('/DeleteAdditionalserviceCart/{id}','AdditionalServiceCarController@DeleteserviceCart');
    $router->post('/saveitemoder', 'ItemOderController@SaveItemOder');
    $router->post('/SaveAdditionalserviceOder', 'PurchaseAdditionalServiceController@SavePurchaseAdditionalService');

    });

    //admin

   // $router->group(['middleware' => 'isAdmin'], function (){
    $router->group(['middleware' => 'isAdmin'], function () use ($router) {

    $router->post('/itemstore', 'ItemController@item_store');
    $router->put('/ItemUpdate/{id}', 'ItemController@item_update');
    $router->delete('/ItemDelete/{id}', 'ItemController@itemDelete');
    //AdditionlService crud operations api
    $router->post('/AddAdditionlServiceStore', 'AdditionalServiceController@AdditionalServiceController_store');
    $router->put('/AddAdditionlServiceUpdate/{id}', 'AdditionalServiceController@AdditionalServiceController_update');
    $router->delete('/AddAdditionlServiceDelete/{id}', 'AdditionalServiceController@AdditionalServiceControllerDelete');

    //workout_data
    $router->post('/workoutscrate', 'LibrariesController@WorkoutsStore');
    $router->post('/updateworkout/{id}', 'LibrariesController@updateWorkout');
    $router->delete('/deleteworkout/{id}', 'LibrariesController@DeleteWorkout');


    $router->post('/Instruction_schedules', 'InstructionScheduleController@instruction_schedules');
    $router->get('/Instruction_schedules_viwe', 'InstructionScheduleController@Instruction_schedules_viwe');
    $router->delete('/Instruction_schedules_delete/{id}', 'InstructionScheduleController@Instruction_schedules_delete');
    $router->post('/createschedules', 'WorkOutscheduleController@CreateSchedule');

    $router->post('/admincreateschedule', 'AdminSheduleWorkOutController@AdminCreateSchedule');
    $router->post('/createfeedback', 'ClientWorkoutFeedbackController@Createfeedback');

    $router->get('/viweoderdetails', 'OrderManagementController@ViweOderDetails');










});

    $router->group(['middleware' => 'isTrainer'], function () use ($router) {
        $router->get('/workouts', 'LibrariesController@workouts_views');
        $router->get('/viwetrainercreateschedule', 'WorkOutscheduleController@viewTrainerCreateSchedule');
        $router->post('/trainercreateschedule', 'WorkOutscheduleController@TrainerCreateSchedule');
        $router->post('/gettrainercreateschedule', 'WorkOutscheduleController@TrainerCreateSchedule');
        $router->post('/createclientworkout', 'ClientWorkoutController@CreateClientWorkout');
        $router->get('/viweadmincreateschedule', 'AdminSheduleWorkOutController@ViweAdminCreateSchedule');


});

});
