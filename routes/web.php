<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolDetailsController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\FacultySubjectController;
use App\Http\Controllers\FacultyAttendanceController;
use App\Http\Controllers\StudentAttendanceController;
use App\Http\Controllers\ParameterMasterController;
use App\Http\Controllers\Admin\ProfileController;

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserControllers;
use App\Http\Controllers\Admin\Module\ModuleController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(Auth::check()){
        redirect()->route('home');
    }else{
        return view('auth.login');
    }
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware'=>'auth'], function()  
{  
    Route::post('/AppendAdminDash', [App\Http\Controllers\HomeController::class, 'AppendAdminDash'])->name('AppendAdminDash');


    
    Route::resource('/details',SchoolDetailsController::class);
    Route::resource('/faculty',FacultyController::class);

    Route::post('/FacultyDelete',[FacultyController::class,'FacultyDelete']);



    Route::resource('/student',StudentController::class);
    Route::post('/studentDelete',[StudentController::class,'StudentDelete']);
    Route::resource('/schedule',ScheduleController::class);
    Route::resource('/facultySubject',FacultySubjectController::class);
    Route::resource('/facultyAttendance',FacultyAttendanceController::class);
    Route::resource('/studentAttendance',StudentAttendanceController::class);


    Route::post('/getfilteredStudent',[App\Http\Controllers\StudentController::class,'getfilteredStudent'])->name('getfilteredStudent');


    /////-----Today-----/////

        Route::resource('parameter', ParameterMasterController::class);
        Route::post('newparameter', [ParameterMasterController::class,'newparameter'])->name('newparameter');
        Route::post('getDepenedentFilters', [ParameterMasterController::class,'getDepenedentFilters'])->name('getDepenedentFilters');

        Route::post('GetLocationWieseCourse', [ParameterMasterController::class,'GetLocationWieseCourse'])->name('GetLocationWieseCourse');
        
        Route::post('GetCourseWiseBatch', [ParameterMasterController::class,'GetCourseWiseBatch'])->name('GetCourseWiseBatch');


        Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
        Route::resource('/role','App\Http\Controllers\Admin\RoleController');
        Route::post('role_destroy', [RoleController::class, 'destroy']);
        Route::post('/statusRole', 'App\Http\Controllers\Admin\RoleController@Status')->name('role.status');


        Route::resource('/user','App\Http\Controllers\Admin\UserControllers');
        Route::post('user_destroy', [UserControllers::class, 'destroy']);
        Route::post('/statusUser', 'App\Http\Controllers\Admin\UserControllers@Status')->name('User.status');
    
        Route::resource('profile','App\Http\Controllers\Admin\ProfileController');

        Route::get('/Module/create/',[App\Http\Controllers\Admin\Module\ModuleController::class, 'Create'])->name('Module.new.creates');
        Route::post('/Module/Store/',[App\Http\Controllers\Admin\Module\ModuleController::class, 'store'])->name('Module.store');
        Route::get('/Module/{id}',[App\Http\Controllers\Admin\Module\ModuleController::class, 'index'])->name('Module.permission');
        Route::post('/Module/permission/',[App\Http\Controllers\Admin\Module\ModuleController::class, 'GivePermission'])->name('Module.GivePermission');
        Route::post('GetsubjectCode', [FacultySubjectController::class,'GetsubjectCode'])->name('GetsubjectCode');

        //Get 
        Route::post('getSubjectWiseFacultyinShedule', [ScheduleController::class,'GetSubjectWiseFacultyinShedule'])->name('getSubjectWiseFacultyinShedule');
        Route::post('getCourseWiseBatch', [ScheduleController::class,'GetCourseWiseBatch'])->name('getCourseWiseBatch');

        Route::get('PrintScheduler/{id}', [ScheduleController::class,'PrintScheduler'])->name('schedule.print');
        Route::post('DeleteScheduler', [ScheduleController::class,'destroy']);

        



            // By Krunal 30-30-2023
            Route::get('/get_countries', 'App\Http\Controllers\SchoolDetailsController@get_countries')->name('school.get_countries');
            Route::post('/get_state', 'App\Http\Controllers\SchoolDetailsController@get_state')->name('school.get_state');
            Route::post('/get_city', 'App\Http\Controllers\SchoolDetailsController@get_city')->name('school.get_city');
        
            // Reports Controller
                Route::resource('studentList',App\Http\Controllers\Reports\StudentListReportController::class);
                Route::post('/studentList/getStudentData', [App\Http\Controllers\Reports\StudentListReportController::class,'getStudentData'])->name('studentList.getStudentData');
                
                Route::resource('facultyList',App\Http\Controllers\Reports\FacltyListReportController::class);
                Route::post('/facultyList/getFacultyData', [App\Http\Controllers\Reports\FacltyListReportController::class,'getFacultyData'])->name('facultyList.getFacultyData');


                Route::resource('facultyWorkingHours',App\Http\Controllers\Reports\FacltyWorkingHoursReportController::class);
                Route::post('/facultyWorkingHours/getFacultyWorkingHours', [App\Http\Controllers\Reports\FacltyWorkingHoursReportController::class,'getFacultyWorkingHours'])->name('facultyWorkingHours.getFacultyWorkingHours');

                Route::get('Monthly',[App\Http\Controllers\Reports\FacultyMonthlyReportController::class,'index'])->name('monthly.index');
                Route::post('/GetMonthlyFacultyWiseReport', [App\Http\Controllers\Reports\FacultyMonthlyReportController::class,'GetMonthlyFacultyWiseReport'])->name('GetMonthlyFacultyWiseReport');

});


                Route::resource('facultyWorkingHours',App\Http\Controllers\Reports\FacltyWorkingHoursReportController::class);
                Route::post('/facultyWorkingHours/getFacultyWorkingHours', [App\Http\Controllers\Reports\FacltyWorkingHoursReportController::class,'getFacultyWorkingHours'])->name('facultyWorkingHours.getFacultyWorkingHours');


