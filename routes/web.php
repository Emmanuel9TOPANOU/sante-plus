<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\Auth\ForcePasswordUpdateController;

// Admin Controllers
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminDoctorController;
use App\Http\Controllers\Admin\AdminRendezvousController;
use App\Http\Controllers\Admin\SpecialiteController;
use App\Http\Controllers\Admin\AdminSettingController;

// Patient Controllers
use App\Http\Controllers\Patient\DashboardController as PatientDashboard;
use App\Http\Controllers\Patient\RendezvousController as PatientRendezvous;
use App\Http\Controllers\Patient\MedicalRecordController as PatientMedicalRecord;
use App\Http\Controllers\Patient\PrescriptionController as PatientPrescriptionCtrl;
use App\Http\Controllers\Patient\MessageController as PatientMessageController;
use App\Http\Controllers\Patient\LabResultController as PatientLabResult;

// Doctor Controllers
use App\Http\Controllers\Doctor\DashboardController as DoctorDashboard;
use App\Http\Controllers\Doctor\ConsultationController;
use App\Http\Controllers\Doctor\PatientController as DoctorPatientController;
use App\Http\Controllers\Doctor\RendezvousController as DoctorRendezvousController;
use App\Http\Controllers\Doctor\PrescriptionController as DoctorPrescriptionCtrl;
use App\Http\Controllers\Doctor\MessageController as DoctorMessageController;
use App\Http\Controllers\Doctor\AvailabilityController;

/*
|--------------------------------------------------------------------------
| Web Routes - SANTÉ+ 2026
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/** ATTENTE DE VALIDATION */
Route::get('/attente-validation', function () {
    return view('attente-validation');
})->name('attente-validation')->middleware('auth');

/** ROUTES DE SÉCURITÉ */
Route::middleware(['auth'])->group(function () {
    Route::get('password/force-change', [ForcePasswordUpdateController::class, 'show'])->name('password.force_change');
    Route::post('password/force-change', [ForcePasswordUpdateController::class, 'store'])->name('password.force_update');
});

/** REDIRECTION APRÈS LOGIN */
Route::get('/dashboard', function () {
    $user = auth()->user();
    return match ($user->role) {
        'admin'   => redirect()->route('admin.dashboard'),
        'medecin' => redirect()->route('doctor.dashboard'),
        'patient' => redirect()->route('patient.dashboard'),
        default   => redirect('/'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

/* --- ESPACE ADMIN --- */
Route::middleware(['auth', 'verified', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::patch('/users/{user}/toggle', [AdminUserController::class, 'toggleStatus'])->name('users.toggle');
        Route::resource('users', AdminUserController::class);
        Route::patch('/medecins/{id}/validate', [AdminDoctorController::class, 'validateDoctor'])->name('medecins.validate');
        Route::resource('medecins', AdminDoctorController::class);
        Route::resource('specialites', SpecialiteController::class);
        Route::get('/rendezvous', [AdminRendezvousController::class, 'index'])->name('rendezvous.index');
        Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
        Route::patch('/settings/update', [AdminSettingController::class, 'update'])->name('settings.update');
});

/* --- ESPACE MÉDECIN --- */
Route::middleware(['auth', 'verified', 'role:medecin', 'check.medecin'])
    ->prefix('doctor')
    ->name('doctor.')
    ->group(function () {
        Route::get('/dashboard', [DoctorDashboard::class, 'index'])->name('dashboard');
        Route::post('/notes/store', [DoctorDashboard::class, 'storeNote'])->name('notes.store');

        Route::prefix('rendezvous')->name('rendezvous.')->group(function () {
            Route::get('/', [DoctorRendezvousController::class, 'index'])->name('index'); 
            Route::post('/{rendezvous}/confirmer', [DoctorRendezvousController::class, 'confirmerRDV'])->name('confirmer');
            Route::post('/{rendezvous}/annuler', [DoctorRendezvousController::class, 'annulerRDV'])->name('annuler');
            Route::post('/{id}/envoyer-mail', [DoctorRendezvousController::class, 'envoyerMail'])->name('envoyerMail');
        });

        Route::patch('/patients/{id}/validate', [DoctorPatientController::class, 'validateAccount'])->name('patients.validate');
        Route::resource('patients', DoctorPatientController::class);

        // Analyses pour le médecin
        Route::prefix('analyses')->name('analyses.')->group(function () {
            Route::get('/', [ConsultationController::class, 'indexAnalyses'])->name('index');
            Route::patch('/{id}/store-result', [ConsultationController::class, 'storeAnalyseResult'])->name('store_result');
            Route::get('/download/{id}', [ConsultationController::class, 'downloadAnalyse'])->name('download');
        });

        Route::get('/consultations/create/{rendezvous}', [ConsultationController::class, 'create'])->name('consultations.create');
        Route::resource('consultations', ConsultationController::class)->except(['create']);
        Route::get('/prescriptions/download/{id}', [DoctorPrescriptionCtrl::class, 'download'])->name('prescriptions.download');
        Route::resource('prescriptions', DoctorPrescriptionCtrl::class);
        Route::resource('availabilities', AvailabilityController::class);

        Route::prefix('messages')->name('messages.')->group(function () {
            Route::get('/', [DoctorMessageController::class, 'index'])->name('index');
            Route::get('/chat/{patient}', [DoctorMessageController::class, 'show'])->name('show');
            Route::post('/', [DoctorMessageController::class, 'store'])->name('store');
        });
});

/* --- ESPACE PATIENT --- */
Route::middleware(['auth', 'verified', 'role:patient'])
    ->prefix('patient')
    ->name('patient.')
    ->group(function () {
        Route::get('/dashboard', [PatientDashboard::class, 'index'])->name('dashboard');
        Route::resource('rendezvous', PatientRendezvous::class);

        Route::get('/mon-dossier', [PatientMedicalRecord::class, 'index'])->name('medical_record.index');
        
        // Ordonnances
        Route::prefix('ordonnances')->name('prescriptions.')->group(function () {
            Route::get('/', [PatientMedicalRecord::class, 'history'])->name('index'); 
            Route::get('/download/{id}', [PatientPrescriptionCtrl::class, 'download'])->name('download');
        });

        // Juste après le dashboard par exemple
Route::get('/historique', [PatientDashboard::class, 'history'])->name('history.index');

        // ANALYSES POUR LE PATIENT (C'est ici qu'on règle la 403)
        Route::prefix('analyses')->name('lab_results.')->group(function () {
            Route::get('/', [PatientLabResult::class, 'index'])->name('index');
            // Route corrigée pour le téléchargement patient
            Route::get('/download/{id}', [PatientLabResult::class, 'download'])->name('download');
        });

        Route::prefix('messages')->name('messages.')->group(function() {
            Route::get('/', [PatientMessageController::class, 'index'])->name('index');
            Route::get('/chat/{doctor}', [PatientMessageController::class, 'show'])->name('show');
            Route::post('/store', [PatientMessageController::class, 'store'])->name('store');
        });
});

/* --- PARAMÈTRES COMMUNS --- */
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/auth.php';