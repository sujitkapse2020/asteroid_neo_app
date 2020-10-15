<?php

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

Route::get('/', function () {
    return redirect('show_chart_date');
});


# Route specify for chart controller
Route::get('show_chart_date', 'ChartController@showChartDate');
Route::post('get_chart_date', 'ChartController@getChartDate');


