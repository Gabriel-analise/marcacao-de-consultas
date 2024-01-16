<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\ConsultationController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/registerPatients', [PatientController::class, 'create'])->name('patients.register');
    Route::post('/registerPatients', [PatientController::class, 'store'])->name('patients.store');

    Route::get('/registerDoctors', [DoctorController::class, 'indexAndCreate'])->name('doctors.indexAndCreate');
    Route::post('/registerDoctors', [DoctorController::class, 'store'])->name('doctors.store');

    Route::get('/registerSpecialtys', [SpecialtyController::class, 'create'])->name('specialtys.register');
    Route::post('/registerSpecialtys', [SpecialtyController::class, 'store'])->name('specialtys.store');


    Route::get('/registerConsultations', [ConsultationController::class, 'indexAndCreate'])->name('consultations.indexAndCreate');
    Route::post('/registerConsultations', [ConsultationController::class, 'store'])->name('consultations.store');


});




require __DIR__.'/auth.php';