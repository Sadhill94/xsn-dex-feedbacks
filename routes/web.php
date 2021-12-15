<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\IssueController;
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

Route::get('/', [IssueController::class, 'public_active'])->name('/');

Route::get('/report-a-bug', function () {
    return Inertia::render('report-a-bug/index');
});

