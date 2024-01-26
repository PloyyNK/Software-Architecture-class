<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('userform', function() {
    return view('userform');
});


Route::post('userform', function () {
    $rules = [
        'email' => 'required|email|different:username',
        'username' => 'required|min:6',
        'password' => 'required|same:password_confirm',
    ];

    $validation = Validator::make(request()->all(), $rules);

    if ($validation->fails()) {
        return Redirect::to('userform')->withErrors($validation)->withInput();
    }

    return Redirect::route('userresults')->withInput();
})->name('userform.submit');


Route::get('userresults', function () {
    return 'Your username is ' . request()->old('username') . '<br>Your favorite color is: ' . request()->old('color');
})->name('userresults');


Route::get('fileform', function() {
    return view('fileform');
});


Route::post('fileform', function () {
    $rules = array(
        'myfile' => 'mimes:doc, docx, pdf, txt|max:1000'
    );

    $validation = Validator::make(request()->all(), $rules);

    if ($validation->fails())
        {
    return Redirect::to('fileform')->withErrors($validation)
        ->withInput();
        }
        else
        {
            $file = Input::file('myfile');
            if ($file->move('files', $file
                ->getClientOriginalName()))
            {
                return "Success";
            }
        else {
                return "Error";
            }
    }
});


Route::get('myform', function(){
    return view('myform');
});

Route::post('myform', ['before' => 'csrf', function () {
    $rules = [
        'email' => 'required|email|min:6',
        'username' => 'required|min:6',
        'password' => 'required',
    ];

    $messages = [
        'min' => 'Way too short! The :attribute must be at least :min characters in length.',
        'username.required' => 'We really, really need a Username.',
    ];

    $validation = validator(request()->all(), $rules, $messages);

    if ($validation->fails()) {
        return Redirect::to('myform')->withErrors($validation)->withInput();
    }

    return Redirect::to('myresults')->withInput();
}]);

Route::get('myresults', function() {
    return dd(old());
});