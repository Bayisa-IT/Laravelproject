<?php

use App\Http\Livewire\Customer\CutomerDashboardComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\AdminServiceCategoryComponent;
use App\Http\Livewire\Admin\AdminAddServiceCategoryComponent;
use App\Http\Livewire\Admin\AdminEditServiceCategoryComponent;
use App\Http\Livewire\Admin\AdminServicesByCategoryComponent;
use App\Http\Livewire\Admin\AdminServicesComponent;
use App\Http\Livewire\Admin\AdminAddServicesComponent;
use App\Http\Livewire\Admin\AdminEditServicesComponent;
use App\Http\Livewire\Admin\AdminSliderComponent;
use App\Http\Livewire\Admin\AdminAddSliderComponent;
use App\Http\Livewire\Admin\AdminEditSliderComponent;
use App\Http\Livewire\Admin\AdminContactComponent;
use App\Http\Livewire\Admin\AdminServiceProviderComponent;
use App\Http\Livewire\Sprovider\SproviderDashboardComponent;
use App\Http\Livewire\Sprovider\SproviderProfileComponent;
use App\Http\Livewire\Sprovider\EditSproviderProfileComponent;
use App\Http\Livewire\ServicesByCategoryComponent;
use App\Http\Livewire\ServiceCategoriesComponent;
use App\Http\Livewire\ChangeLocationComponent;
use App\Http\Livewire\ServiceDetailsComponent;
use App\Http\Livewire\ContactComponent;
use  App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\http\Livewire\HomeComponent;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', HomeComponent::class)->name('home');

Route::get('service-categories',ServiceCategoriesComponent::class)->name('home.service_categories');
Route::get('/{category_slug}/services',ServicesByCategoryComponent::class)->name('home.services-by-category');
Route::get('/service/{service_slug}',ServiceDetailsComponent::class)->name('home.service_details');

Route::get('/autocomplete',[SearchController::class,'autocomplete'])->name('autocomplete');
Route::post('/search',[SearchController::class,'searchService'])->name('searchService');

Route::get('/change-location', ChangeLocationComponent::class)->name('home.change_location');

Route::get('/contact-us',ContactComponent::class)->name('home.contact');


//customer
Route::middleware(['auth','verified'])->group(function(){
      Route::get('/cutomer/dashboard',CutomerDashboardComponent::class )->name('cutomer.dashboard');
});

//Service provider
Route::middleware(['auth','verified','authsprovider'])->group(function(){
    Route::get('/sprovider/dashboard',SproviderDashboardComponent::class )->name('sprovider.dashboard');
    Route::get('/sprovider/profile', SproviderProfileComponent::class)->name('sprovider.profile');
    Route::get('/sprovider/profile/edit',EditSproviderProfileComponent::class)->name('sprovider.edit_profile');

    
});

//Admin
Route::middleware(['auth','verified','authadmin'])->group(function(){
    Route::get('/admin/dashboard',AdminDashboardComponent::class )->name('admin.dashboard');
    Route::get('/admin/service-caegories', AdminServiceCategoryComponent::class)->name('admin.service_caegories');
    Route::get('/admin/service-caegories/add', AdminAddServiceCategoryComponent::class)->name('admin.add_service_caegory');
    Route::get('/admin/service-caegories/edit/{category_id}', AdminEditServiceCategoryComponent::class)->name('admin.edit_service_caegory');
    Route::get('/admin/all-services', AdminServicesComponent::class)->name('admin.all_services');
    Route::get('/admin/{category_slug}/services', AdminServicesByCategoryComponent::class)->name('admin.services_by_category');
    Route::get('/admin/service/add',AdminAddServicesComponent::class)->name('admin.add_service');
    Route::get('/admin/service/edit/{service_slug}', AdminEditServicesComponent::class)->name('admin.edit_service');
    Route::get('/admin/slider',AdminSliderComponent::class)->name('admin.slider');
    Route::get('/admin/slide/add',AdminAddSliderComponent::class)->name('admin.add_slide');
    Route::get('/admin/slide/edit/{slide_id}',AdminEditSliderComponent::class)->name('admin.edit_slide');
    Route::get('/admin/contacts',AdminContactComponent::class)->name('admin.contacts');

    Route::get('/admin/service-providers',AdminServiceProviderComponent::class)->name('admin.service_providers');
   
});


