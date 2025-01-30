<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RazorpayController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\MusicCategoryController;




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


//changed by praveenkumar
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});





Route::middleware('auth')->group(function () { Route::get('/dashboard', function () { return view('dashboard.index'); })->middleware('verified')->name('admin.dashboard');
});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// Admin edit view delete
Route::get('viewadmin',[AdminController::class,'show'])->name('view.admin');
Route::post('admin',[AdminController::class,'store'])->name('store.admin');
Route::get('/users/{id}', [AdminController::class, 'view'])->name('users.show');
Route::post('/users/edit', [AdminController::class, 'edit'])->name('users.edit');
Route::get('/users/delete/{id}', [AdminController::class, 'destroy'])->name('users.destroy');

Route::get('myprofile',[RazorpayController::class,'myProfile'])->name('my.profile');
Route::post('updateprofile',[RazorpayController::class,'updateProfile'])->name('profile.update');

 // Role routes start here-------------------
Route::prefix('role')->group(function () {
    Route::get('/role-index', [RoleController::class, 'role_index'])->name('admin.role.index');
    Route::post('/store-role', [RoleController::class, 'store_role'])->name('admin.role.store');
    Route::post('/update', [RoleController::class, 'update_role'])->name('admin.role.update');
    Route::post('/delete/{id}', [RoleController::class, 'delete'])->name('admin.role.delete');
});
 // Role routes end here-------------------


  // Modules routes start here-------------------
Route::prefix('module')->group(function () {
    Route::get('/module-index', [ModuleController::class, 'module_index'])->name('admin.module.index');
    Route::post('/store-module', [ModuleController::class, 'store_module'])->name('admin.module.store');
    Route::post('/update-module', [ModuleController::class, 'update_module'])->name('admin.module.update');
    Route::post('/delete-module/{id}', [ModuleController::class, 'delete_module'])->name('admin.module.delete');
    Route::post('/module-permission', [PermissionController::class, 'module_permission_store'])->name('admin.module.permission_add');
});
// Modules routes end here---------------------


// Modules Permission routes start here-------------------
Route::prefix('module_permission')->group(function () {
    Route::post('/module-permission', [PermissionController::class, 'module_permission_store'])->name('admin.module_permission.permission_add');
    Route::get('/permission-view', [PermissionController::class, 'module_permission_view'])->name('admin.module_permission_list');
    Route::post('/permission-switch', [PermissionController::class, 'module_permission_switch'])->name('admin.module_permission_switch');
    Route::get('/permission-role', [PermissionController::class, 'module_permission_role'])->name('admin.permission_role_list');
    Route::post('/permission-role-update', [PermissionController::class, 'module_permission_role_update'])->name('admin.permission_role_update');

});


// Music category start------------------------------------
Route::prefix('musicCategory')->group(function(){
 
    Route::get('/index',[MusicCategoryController::class,'view'])->name('category.view');
    Route::post('/store',[MusicCategoryController::class,'store'])->name('category.store');
    Route::put('categories/{id}', [MusicCategoryController::class, 'update'])->name('categories.update');
    Route::get('categories/{id}', [MusicCategoryController::class, 'destroy'])->name('categories.destroy');

});






// Music category end------------------------------------




