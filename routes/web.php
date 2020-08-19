<?php

Route::get('/', function () {
	return view('welcome');
});

Route::get('/coba', function () {
	// return view('auth.register');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/home', function () {
// 	return view('home.client');
// });

Route::prefix('admin')->middleware(['auth','auth.admin'])->group(function(){
// Route::prefix('admin')->group(function(){
	// Route::get('/', 'LabController@admin')->name('lab.admin');
	Route::prefix('activities')->group(function(){
		Route::get('status', 'ScheduleController@astatus')->name('schedule.status');
		Route::get('edit/{id}', 'ScheduleController@edit')->name('schedule.edit');
		Route::put('update/{id}', 'ScheduleController@update')->name('schedule.update');
	});
	Route::prefix('lab')->group(function(){
		Route::get('/', 'LabController@admin')->name('lab.admin');
		Route::get('create', 'LabController@create')->name('lab.create');
		Route::post('store', 'LabController@store')->name('lab.store');
		Route::get('edit/{id}', 'LabController@edit')->name('lab.edit');
		Route::put('update/{id}', 'LabController@update')->name('lab.update');
		Route::delete('delete/{id}', 'LabController@delete')->name('lab.delete');
	});
	Route::prefix('tool')->group(function(){
		Route::get('/', 'ToolController@admin')->name('tool.admin');
		Route::get('show/{id}', 'ToolController@show')->name('tool.show');
		Route::get('create', 'ToolController@create')->name('tool.create');
		Route::post('store', 'ToolController@store')->name('tool.store');
		Route::get('edit/{id}', 'ToolController@edit')->name('tool.edit');
		Route::put('update/{id}', 'ToolController@update')->name('tool.update');
		Route::delete('delete/{id}', 'ToolController@delete')->name('tool.delete');
	});
	Route::prefix('status')->group(function(){
		Route::get('/', 'StatusController@admin')->name('status.admin');
		Route::get('create', 'StatusController@create')->name('status.create');
		Route::post('store', 'StatusController@store')->name('status.store');
		Route::get('edit/{id}', 'StatusController@edit')->name('status.edit');
		Route::put('update/{id}', 'StatusController@update')->name('status.update');
		Route::delete('delete/{id}', 'StatusController@delete')->name('status.delete');
	});
	Route::prefix('time')->group(function(){
		Route::get('/', 'TimeController@admin')->name('time.admin');
		Route::get('create', 'TimeController@create')->name('time.create');
		Route::post('store', 'TimeController@store')->name('time.store');
		Route::get('edit/{id}', 'TimeController@edit')->name('time.edit');
		Route::put('update/{id}', 'TimeController@update')->name('time.update');
		Route::delete('delete/{id}', 'TimeController@delete')->name('time.delete');
	});
	Route::prefix('period')->group(function(){
		Route::get('/', 'PeriodController@admin')->name('period.admin');
		Route::get('create', 'PeriodController@create')->name('period.create');
		Route::post('store', 'PeriodController@store')->name('period.store');
		Route::get('edit/{id}', 'PeriodController@edit')->name('period.edit');
		Route::put('update/{id}', 'PeriodController@update')->name('period.update');
		Route::delete('delete/{id}', 'PeriodController@delete')->name('period.delete');
	});
	Route::prefix('service')->group(function(){
		Route::get('create', 'ServiceController@create')->name('service.create');
		Route::post('store', 'ServiceController@store')->name('service.store');
		Route::get('edit/{id}', 'ServiceController@edit')->name('service.edit');
		Route::put('update/{id}', 'ServiceController@update')->name('service.update');
		Route::delete('delete/{id}', 'ServiceController@delete')->name('service.delete');
	});
	Route::prefix('price')->group(function(){
		Route::get('/', 'ServiceController@admin')->name('service.admin');
		Route::get('create', 'PriceController@create')->name('price.create');
		Route::post('store', 'PriceController@store')->name('price.store');
		Route::get('edit/{id}', 'PriceController@edit')->name('price.edit');
		Route::put('update/{id}', 'PriceController@update')->name('price.update');
		Route::delete('delete/{id}', 'PriceController@delete')->name('price.delete');
	});
});

Route::prefix('lab')->group(function(){
	Route::get('/', 'LabController@index')->name('lab.index');
	Route::get('datatable', 'LabController@datatable')->name('lab.dt');
});
Route::prefix('tool')->group(function(){
	Route::get('/', 'ToolController@index')->name('tool.index');
	Route::get('datatable', 'ToolController@datatable')->name('tool.dt');
	Route::get('detail', 'ToolController@detail')->name('tool.detail');
});
Route::prefix('status')->group(function(){
	Route::get('/', 'StatusController@index')->name('status.index');
	Route::get('datatable', 'StatusController@datatable')->name('status.dt');
});
Route::prefix('period')->group(function(){
	Route::get('/', 'PeriodController@index')->name('period.index');
	Route::get('datatable', 'PeriodController@datatable')->name('period.dt');
});
Route::prefix('time')->group(function(){
	Route::get('/', 'TimeController@index')->name('time.index');
	Route::get('datatable', 'TimeController@datatable')->name('time.dt');
});
Route::prefix('service')->group(function(){
	Route::get('/', 'ServiceController@index')->name('service.index');
	Route::get('datatable', 'ServiceController@datatable')->name('service.dt');
});
Route::prefix('price')->group(function(){
	Route::get('/', 'ServiceController@index')->name('service.index');
	Route::get('datatable', 'PriceController@datatable')->name('price.dt');
});
Route::prefix('schedule')->group(function(){
	Route::get('/', 'ScheduleController@index')->name('schedule.index');
	Route::get('dataschedule', 'ScheduleController@dataschedule')->name('schedule.ds');
	Route::get('{id}/show', 'ScheduleController@show')->name('schedule.show');
	Route::get('{id}', 'ScheduleController@data')->name('schedule.data');
});
Route::prefix('activities')->group(function(){
	Route::prefix('registration')->group(function(){
		Route::get('/', 'ScheduleController@registration')->name('schedule.registration');
		Route::get('tool', 'ScheduleController@tool')->name('schedule.tool');
		Route::get('form/{id}', 'ScheduleController@create')->name('schedule.create');
		Route::post('store', 'ScheduleController@store')->name('schedule.store');
		Route::put('delete/{id}', 'ScheduleController@delete')->name('schedule.delete');
	});
	Route::prefix('status')->group(function(){
		Route::get('/', 'ScheduleController@status')->name('schedule.status');
		Route::get('all', 'ScheduleController@all')->name('all');
		Route::get('booking', 'ScheduleController@booking')->name('booking');
		Route::get('approved', 'ScheduleController@approved')->name('approved');
		Route::get('rejected', 'ScheduleController@rejected')->name('rejected');
		Route::get('cancel', 'ScheduleController@cancel')->name('cancel');
	});
});

Route::get('settings', function () {
	return view('settings');
});

Route::get('contact', function () {
	return view('contact');
});