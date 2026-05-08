<?php

use App\Http\Controllers\AuthFlowController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('panel');
    }

    return redirect()->route('login');
});

Route::get('/login/seguridad', [AuthFlowController::class, 'create'])->name('login.security');
Route::post('/login', [AuthFlowController::class, 'store'])->name('login.post');
Route::get('/login/verificacion-admin', [AuthFlowController::class, 'showAdminTwoFactorChallenge'])->name('login.admin.verify');
Route::post('/login/verificacion-admin', [AuthFlowController::class, 'verifyAdminTwoFactorChallenge'])->name('login.admin.verify.post');

Route::get('/prueba-s3', function () {
    abort_unless(app()->environment('local'), 404);

    $uploaded = Storage::disk('s3')->put('prueba.txt', 'Hola desde Laravel');

    abort_unless($uploaded, 500, 'No se pudo subir el archivo de prueba.');

    return 'Archivo subido correctamente';
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthFlowController::class, 'create'])->name('login');
});

Route::middleware(['auth', 'session.version'])->group(function () {
    Route::get('/panel', [AuthFlowController::class, 'dashboard'])->name('panel');
    Route::post('/panel/usuarios', [AuthFlowController::class, 'storeSystemUser'])->name('panel.usuarios.store');
    Route::post('/panel/usuarios/{user}', [AuthFlowController::class, 'updateSystemUser'])->name('panel.usuarios.update');
    Route::post('/panel/usuarios/{user}/password-code', [AuthFlowController::class, 'sendAdminPasswordCode'])->name('panel.usuarios.password.code');
    Route::post('/panel/usuarios/{user}/password-reset', [AuthFlowController::class, 'resetAdminPassword'])->name('panel.usuarios.password.reset');
    Route::delete('/panel/usuarios/{user}', [AuthFlowController::class, 'destroySystemUser'])->name('panel.usuarios.destroy');
    Route::post('/panel/cargas/usuarios', [AuthFlowController::class, 'storeCargaUsuario'])->name('panel.cargas.store');
    Route::post('/panel/cargas/usuarios/{usariosapp}', [AuthFlowController::class, 'updateCargaUsuario'])->name('panel.cargas.update');
    Route::delete('/panel/cargas/usuarios/{usariosapp}', [AuthFlowController::class, 'destroyCargaUsuario'])->name('panel.cargas.destroy');
    Route::post('/panel/agenda/citas', [AuthFlowController::class, 'storeAgendaAppointment'])->name('panel.agenda.store');
    Route::post('/panel/agenda/citas/{agendaAppointment}/estado', [AuthFlowController::class, 'toggleAgendaAppointmentStatus'])->name('panel.agenda.status');
    Route::post('/panel/reagendar/citas/{agendaAppointment}', [AuthFlowController::class, 'rescheduleAgendaAppointment'])->name('panel.reagendar.update');
    Route::delete('/panel/reagendar/citas/{agendaAppointment}', [AuthFlowController::class, 'destroyAgendaAppointment'])->name('panel.reagendar.destroy');
    Route::post('/panel/notificaciones/enviar', [AuthFlowController::class, 'sendTodayAgendaNotifications'])->name('panel.notificaciones.send');
    Route::post('/panel/facturacion/pdf', [AuthFlowController::class, 'downloadFacturaPdf'])->name('panel.facturacion.pdf');
    Route::get('/panel/facturacion/factura/{billingInvoice}/pdf', [AuthFlowController::class, 'downloadStoredFacturaPdf'])->name('panel.facturacion.download');
    Route::post('/panel/auditoria/corte-caja', [AuthFlowController::class, 'downloadCashCutPdf'])->name('panel.auditoria.corte');
    Route::post('/panel/auditoria/corte-fecha', [AuthFlowController::class, 'downloadDateCashCutPdf'])->name('panel.auditoria.corte.fecha');
    Route::post('/panel/recetas/usuarios/{usariosapp}', [AuthFlowController::class, 'updateRecetaUsuario'])->name('panel.recetas.update');
    Route::post('/panel/recetas/usuarios/{usariosapp}/rango', [AuthFlowController::class, 'updateRecetaRango'])->name('panel.recetas.rango');
    Route::post('/logout', [AuthFlowController::class, 'destroy'])->name('logout');
    Route::get('/logout', [AuthFlowController::class, 'destroy']);
});

Route::middleware(['auth', 'session.version', 'admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});
