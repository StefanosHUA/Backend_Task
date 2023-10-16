<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Get All Companies
Route::get('/companies', 'App\Http\Controllers\CompanyController@GetFilteredData');


//Get Company By CompanyId
Route::get('/companies/{company_id}', 'App\Http\Controllers\CompanyController@GetCompanyById');


//Post Company (requires input of all company fields)
Route::post('/companies', 'App\Http\Controllers\CompanyController@CreateEntry');


//Update Chosen Company Fields
Route::put('/companies/{company_id}', 'App\Http\Controllers\CompanyController@updateCompanyInfo');


//Delete Company By CompanyId
Route::delete('/companies/{company_id}', 'App\Http\Controllers\CompanyController@destroy');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
