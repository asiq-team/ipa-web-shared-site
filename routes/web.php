<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WorkorderController;
use App\Http\Controllers\WorkorderDraftController;
use App\Http\Controllers\UploadFileController;

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


Route::middleware(['auth'])->group(function() {
   
    Route::resource('/', DashboardController::class)->only([
        'index'
    ]);

    Route::prefix('ipa/tower')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('tower.dashboard');
        Route::get('workorder', [WorkorderController::class, 'index'])->name('tower.wo.overview');
        Route::get('workorder/draft', [WorkorderDraftController::class, 'index'])->name('tower.wo.draft');
        Route::get('workorder/draft/edit/{id}', [WorkorderDraftController::class, 'edit'])->name('tower.wo.draft.edit');
        Route::get('workorder/draft/import', [WorkorderDraftController::class, 'import'])->name('tower.wo.draft.import');
        Route::post('workorder/draft/import', [UploadFileController::class, 'upload_file'])->name('tower.wo.draft.import.file');
        Route::post('workorder/draft/import/process', [WorkorderDraftController::class, 'process'])->name('tower.wo.draft.import.file.process');
    
        Route::get('workorder/plan', [WorkorderDraftController::class, 'plan'])->name('tower.wo.plan');

        Route::get('workorder/release', [WorkorderController::class, 'release'])->name('tower.wo.release');
        Route::get('workorder/release/{id}', [WorkorderController::class, 'releaseShow'])->name('tower.wo.release.show');
    });
});

require __DIR__.'/auth.php';
