<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\SemesterController;
use App\Http\Controllers\Admin\MissionController;
use App\Http\Controllers\Admin\IdeasController;
use App\Http\Controllers\Admin\ComentController;
use App\Http\Controllers\ZipController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TermOfUseController;
use App\Listeners\SendEmailAfterClickButton;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes(['register' => false, 'reset' => false, 'logout' => false]);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', function () {return redirect()->route('home');});
Route::get('/privacy', [PrivacyController::class, 'index'])->name('privacy');
Route::get('/term', [TermOfUseController::class, 'index'])->name('term');
Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'contact'])->name('contact');
Route::get('/about',[AboutController::class, 'about'])->name('about');
Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [UserController::class, 'index'])->name('user.profile');
        Route::post('/', [UserController::class, 'uploadAvatar'])->name('user.uploadAvatar');
        //Route for showing changing password form
        Route::get('/password/change', [UserController::class, 'changePassword'])->name('user.password.change');
        //Route for changing password
        Route::get('/password/update', [UserController::class, 'updatePassword']);
        Route::post('/password/update', [UserController::class, 'updatePassword'])->name('user.password.update');
        //Route for modifying phone number
        Route::get('/phone/update', [UserController::class, 'changePhoneNumber']);
        Route::post('/phone/update', [UserController::class, 'changePhoneNumber'])->name('user.phone.update');
    });

    Route::group(['prefix' => 'ideas'], function () {
        Route::get('/', [IdeaController::class, 'index'])->name('ideas.index');
        //Route::get('test-email', [IdeaController::class, 'sendEmail']);
        Route::get('test-email', [SendEmailAfterClickButton::class, 'sendEmail']);
        Route::post('store', [IdeaController::class, 'store'])->name('ideas.store');
        Route::delete('/delete/{id}', [IdeaController::class, 'delete'])->name('ideas.delete');
        Route::get('/{id}', [IdeaController::class, 'details'])->name('ideas.details');
        Route::get('/edit/{id}', [IdeaController::class, 'edit'])->name('ideas.edit');
        Route::post('/edit/{id}', [IdeaController::class, 'update'])->name('ideas.update');
        Route::delete('/attachment/delete/{id}', [IdeaController::class, 'deleteAttachment'])->name('ideas.attachment.delete');
        Route::get('/search', [IdeaController::class, 'index']);

        Route::get('add-comment/{id}', [CommentController::class, 'addComment']);
        Route::post('add-comment/{id}', [CommentController::class, 'addComment'])->name('comments.add');
        Route::get('edit-comment/{id}', [CommentController::class, 'editComment']);
        Route::post('edit-comment/{id}', [CommentController::class, 'editComment'])->name('comments.edit');
        Route::delete('delete-comment/{id}', [CommentController::class, 'deleteComment'])->name('comments.delete');
    });

    Route::group(['prefix' => 'admin', 'middleware' => 'role:admin,manager,coordinator'], function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::group(['prefix' => 'account'], function () {
            Route::get('/', [AccountController::class, 'index'])->name('admin.account.index');
            // Route::get('/create', [AccountController::class, 'create'])->name('admin.account.create');
            Route::post('/create', [AccountController::class, 'create'])->name('admin.account.create');

            // Route::get('/sendEmail', [AccountController::class, 'sendEmail']);
            Route::get('/dt-row-data', [AccountController::class, 'getDtRowData']);
            Route::get('/department/{id}', [AccountController::class, 'listAccountByDepartment'])->name('admin.account.department.index');
            Route::get('/department/{id}/dt-row-data', [AccountController::class, 'getDtRowDataByDepartment']);
            Route::delete('/delete/{id}', [AccountController::class, 'delete'])->name('admin.account.delete');
            Route::get('/update/{id}', [AccountController::class, 'edit'])->name('admin.account.update');
            Route::post('/update/{id}', [AccountController::class, 'update'])->name('admin.account.store');
            Route::get('/ban/{id}/{status_code}',[AccountController::class,'banAccount'])->name('admin.account.ban');
        });

        //Department
        Route::group(['prefix' => 'department','middleware' => 'role:admin,manager,coordinator'], function () {
            Route::get('/', [DepartmentController::class, 'indexDepartment'])->name('admin.department.index');
            Route::get('/dt-row-data', [DepartmentController::class, 'getDtRowData']);
        });
        
        //Semester
        Route::group(['prefix' => 'semester'], function () {
            Route::get('/', [SemesterController::class, 'indexSemester'])->name('admin.semester.index');
            Route::get('/dt-row-data', [SemesterController::class, 'getDtRowData']);
            Route::post('/createSmt', [SemesterController::class, 'create'])->name('admin.semester.createSmt')->middleware('role:admin');
            Route::delete('/delete/{id}', [SemesterController::class, 'delete'])->name('admin.semester.delete')->middleware('role:admin');
            Route::get('/update/{id}', [SemesterController::class, 'edit'])->name('admin.semester.update')->middleware('role:admin');
            Route::post('/update/{id}', [SemesterController::class, 'update'])->name('admin.semester.store')->middleware('role:admin');
        });
        
        // Idea Admin
        Route::group(['prefix' => 'ideas', 'middleware' => 'role:admin,manager,coordinator'],function(){
            Route::get('/',[IdeasController::class,'index'])->name('admin.ideas.index');
            Route::get('/dt-row-data',[IdeasController::class,'getDtRowData']);
            Route::get('/listIdea/{id}',[IdeasController::class,'listIdeaByMission'])->name('admin.ideas.listIdea.index');
            Route::get('/listIdea/{id}/dt-row-data',[IdeasController::class,'getDtRowDataByMission']);
        });

        //Comment Admin
        Route::group(['prefix' => 'comments', 'middleware' => 'role:admin,manager'],function(){
            Route::get('/listComment/{id}',[ComentController::class,'listCommentByIdea'])->name('admin.comments.listComment.index');
            Route::get('/listComment/{id}/dt-row-data',[ComentController::class,'getDtRowDataByIdea']);
        });

        //Mission
        Route::get('/missions/', [MissionController::class, 'index'])->name('admin.missions.index');
        Route::get('/missions/dt-row-data', [MissionController::class, 'getDtRowData']);
        Route::post('/mission/create', [MissionController::class, 'create'])->name('admin.mission.create')->middleware('role:admin,coordinator');
        Route::get('/mission/update/{id}', [MissionController::class, 'edit'])->name('admin.mission.update')->middleware('role:admin,coordinator');
        Route::post('/mission/update/{id}', [MissionController::class, 'update'])->name('admin.mission.store')->middleware('role:admin,coordinator');
        Route::delete('/missions/delete/{id}', [MissionController::class, 'delete'])->name('admin.mission.delete')->middleware('role:admin,coordinator');

        
        // List mission by department|semester
        // Route::get('/missions/department/{id}', [MissionController::class, 'listMissionByDepartment'])->name('admin.missions.department.index');
        // Route::get('/missions/department/{id}/dt-row-data', [MissionController::class, 'getDtRowDataByDepartment']);
        Route::get('/missions/semester/{id}', [MissionController::class, 'listMissionBySemester'])->name('admin.missions.semester.index');
        Route::get('/missions/semester/{id}/dt-row-data', [MissionController::class, 'getDtRowDataBySemester']);
        
    });
    Route::get('/zip', [ZipController::class,'zipFile']);
   
});
