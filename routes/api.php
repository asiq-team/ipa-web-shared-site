<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportHistoryController;
use App\Http\Controllers\WorkorderDraftController;
use App\Http\Controllers\ResourceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->group(function(){
    Route::prefix('ipa/tower')->group(function (){
        Route::post('workorder/draft/edit/{id}', [WorkorderDraftController::class, 'update'])->name('api.tower.wo.draft.edit');

        Route::get('draft/edit/{id}', [WorkorderDraftController::class, 'show'])->name('api.draft.edit');

        Route::get('resource/plantype', [ResourceController::class, 'plantype'])->name('api.data.plantype');
        Route::get('resource/tenant', [ResourceController::class, 'tenant'])->name('api.data.tenant');
        Route::get('resource/product', [ResourceController::class, 'product'])->name('api.data.product');
        Route::get('resource/form', [ResourceController::class, 'form'])->name('api.data.form');
        Route::get('resource/find/engineer', [ResourceController::class, 'findEngineer'])->name('api.data.find.engineer');
    });
});

Route::prefix('ipa/tower')->group(function () {
    Route::get('import/history', [ImportHistoryController::class, 'index'])->name('api.history.import');
    Route::post('workorder/draft', [WorkorderDraftController::class, 'provideData'])->name('api.wo.draft');
    Route::post('workorder/plan', [WorkorderDraftController::class, 'provideDataPlan'])->name('api.wo.plan');
    Route::post('workorder/release', [WorkorderDraftController::class, 'provideDataRelease'])->name('api.wo.release');
    
});
