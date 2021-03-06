<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\IssuesController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');


Route::group(['prefix' => '/'], function() {

    Route::get('/', [IssuesController::class, 'home'])
        ->name('home');

    Route::get('report-a-bug', [IssuesController::class, 'report_a_bug'])
        ->name('bug-report');

    Route::get('feature-request', [IssuesController::class, 'feature_request'])
        ->name('feature-request');

    Route::get('dashboard', [IssuesController::class, 'dashboard'])
        ->name('dashboard');

    Route::get('contribute', function(){
        return Inertia::render('Contribute/index');
    })->name('contribute');


    // legal
    Route::get('legal/privacy-policy', function(){
        return Inertia::render('Legal/privacy-policy');
    })->name('privacy-policy');

    Route::get('legal/terms-of-use', function(){
        return Inertia::render('Legal/terms-of-use');
    })->name('terms-of-use');
});

Route::group(['prefix' => 'issues'], function(){

    Route::get('/{id}', [IssuesController::class, 'display_issue'])
        ->name('display-issue');

    Route::get('/edit/{id}', [IssuesController::class, 'display_edit_issue'])
        ->middleware('auth')
        ->name('display-edit-issue');
});

Route::group(['prefix' => 'features'], function(){

    Route::get('/{id}', [IssuesController::class, 'display_feature'])
        ->name('display-feature');

    Route::get('/edit/{id}', [IssuesController::class, 'display_edit_feature'])
        ->middleware('auth')
        ->name('display-edit-feature');
});


