<?php

use Illuminate\Support\Facades\Route;

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
    return view('HOME');
});
Route::get('/doctors', function () {
    return view('sections.doctors');
});

Route::get('/laboratory', function () {
    return view('sections.LABAROTRY');
});

Route::get('/employees', function () {
    return view('sections.EMPLOYEE');
});

Route::get('/patients', function () {
    return view('sections.PATIENT');
});

Route::get('/pharmacy', function () {
    return view('sections.pharmacy');
});

Route::get('/reports', function () {
    return view('sections.report');
});





use App\Http\Controllers\fileController;


Route::post('/send-file', [FileController::class, 'sendFile'])->name('doctors.receiveFile');
Route::get('/doctor-section', [FileController::class, 'showFiles'])->name('doctors.showFiles');




use App\Http\Controllers\DoctorController;

Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');








use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

// Route to get employees data
Route::get('/get-employees', function () {
    $filePath = public_path('employees.json');
    if (File::exists($filePath)) {
        return response()->json(json_decode(File::get($filePath)));
    }
    return response()->json([]);
});







