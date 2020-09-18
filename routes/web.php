<?php

// Route::get('/', function () {
// 	return view('welcome');
// })->name('welcome');

Auth::routes(['register' => false]);
Route::prefix('register')->group(function(){
	Route::get('/', 'Auth\RegisterController@showRegistrationForm')->name('register');
	Route::get('form/{user}', 'Auth\RegisterController@createForm')->name('register.create');
	Route::post('store', 'Auth\RegisterController@storeForm')->name('register.store');
});

Route::get('/', 'HomeController@welcome')->name('welcome');
Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('lab')->group(function(){
	Route::get('/', 'LabController@index')->name('lab.index');
	Route::get('show/{id}', 'labController@show')->name('lab.show');
	Route::get('datatable', 'LabController@datatable')->name('lab.dt');
});
Route::prefix('tool')->group(function(){
	Route::get('/', 'ToolController@index')->name('tool.index');
	Route::get('show/{id}', 'ToolController@show')->name('tool.show');
	Route::get('datatableadmin', 'ToolController@datatableAdmin')->name('tool.dt.admin');
	Route::get('datatableshow', 'ToolController@datatableShow')->name('tool.dt.show');
	Route::get('datatableschedule', 'ToolController@datatableSchedule')->name('tool.dt.schedule');
});
Route::prefix('price')->group(function(){
	Route::get('/', 'PriceController@index')->name('price.index');
	Route::get('datatable', 'PriceController@datatable')->name('price.dt');
});

Route::prefix('admin')->group(function(){
	Route::prefix('activities')->group(function(){
	});
	Route::prefix('payment')->group(function(){
		// Informasi Tagihan (Invoice) dan Upload Bukti Transfer
		Route::get('bill', 'PaymentController@bill')->name('payment.bill');
		// Informasi Terima Pembayaran (Receipt)
		Route::get('receipt', 'PaymentController@receipt')->name('payment.receipt');
		// Udah ada receipt masuk ke history
		Route::get('history', 'PaymentController@history')->name('payment.history');
		Route::get('databill', 'PaymentController@databill')->name('payment.databill');
	});
});

Route::middleware('auth')->group(function(){
	Route::prefix('lab')->group(function(){
		Route::get('create', 'LabController@create')->name('lab.create');
		Route::post('store', 'LabController@store')->name('lab.store');
		Route::get('edit/{id}', 'LabController@edit')->name('lab.edit');
		Route::put('update/{id}', 'LabController@update')->name('lab.update');
		Route::delete('delete/{id}', 'LabController@delete')->name('lab.delete');
	});
	Route::prefix('tool')->group(function(){
		Route::get('create', 'ToolController@create')->name('tool.create');
		Route::post('store', 'ToolController@store')->name('tool.store');
		Route::get('edit/{id}', 'ToolController@edit')->name('tool.edit');
		Route::put('update/{id}', 'ToolController@update')->name('tool.update');
		Route::delete('delete/{id}', 'ToolController@delete')->name('tool.delete');
	});
	Route::prefix('price')->group(function(){
		Route::get('create', 'PriceController@create')->name('price.create');
		Route::post('store', 'PriceController@store')->name('price.store');
		Route::get('edit/{id}', 'PriceController@edit')->name('price.edit');
		Route::put('update/{id}', 'PriceController@update')->name('price.update');
		Route::delete('delete/{id}', 'PriceController@delete')->name('price.delete');
	});

	Route::prefix('status')->group(function(){
		Route::get('/', 'StatusController@index')->name('status.index');
		Route::get('create', 'StatusController@create')->name('status.create');
		Route::post('store', 'StatusController@store')->name('status.store');
		Route::get('edit/{id}', 'StatusController@edit')->name('status.edit');
		Route::put('update/{id}', 'StatusController@update')->name('status.update');
		Route::delete('delete/{id}', 'StatusController@delete')->name('status.delete');
		Route::get('datatable', 'StatusController@datatable')->name('status.dt');
	});
	Route::prefix('period')->group(function(){
		Route::get('/', 'PeriodController@index')->name('period.index');
		Route::get('create', 'PeriodController@create')->name('period.create');
		Route::post('store', 'PeriodController@store')->name('period.store');
		Route::get('edit/{id}', 'PeriodController@edit')->name('period.edit');
		Route::put('update/{id}', 'PeriodController@update')->name('period.update');
		Route::delete('delete/{id}', 'PeriodController@delete')->name('period.delete');
		Route::get('datatable', 'PeriodController@datatable')->name('period.dt');
	});
	Route::prefix('time')->group(function(){
		Route::get('/', 'TimeController@index')->name('time.index');
		Route::get('create', 'TimeController@create')->name('time.create');
		Route::post('store', 'TimeController@store')->name('time.store');
		Route::get('edit/{id}', 'TimeController@edit')->name('time.edit');
		Route::put('update/{id}', 'TimeController@update')->name('time.update');
		Route::delete('delete/{id}', 'TimeController@delete')->name('time.delete');
		Route::get('datatable', 'TimeController@datatable')->name('time.dt');
	});
	Route::prefix('payment')->group(function(){
		// Cara Pembayaran
		Route::get('information', 'PaymentController@index')->name('payment.info');
		// Informasi Tagihan (Invoice) dan Upload Bukti Transfer
		Route::get('bill', 'PaymentController@bill')->name('payment.bill');
		// Informasi Terima Pembayaran (Receipt)
		Route::get('receipt', 'PaymentController@receipt')->name('payment.receipt');
		// Udah ada receipt masuk ke history
		Route::get('history', 'PaymentController@history')->name('payment.history');
		Route::get('databill', 'PaymentController@databill')->name('payment.databill');
	});
	Route::prefix('student')->group(function(){
		Route::get('/', 'StudentController@index')->name('student.index');
		Route::get('show/{id}', 'StudentController@show')->name('student.show');
		Route::get('delete/{id}', 'StudentController@delete')->name('student.delete');
		Route::get('datatable', 'StudentController@datatable')->name('student.dt');
		Route::get('status', 'StudentController@status')->name('student.status');
		// Route::get('receipt', 'StatusController@index')->name('payment.receipt');
		// Route::get('history', 'StatusController@index')->name('payment.history');
	});

	Route::prefix('schedule')->group(function(){
		Route::get('/', 'ScheduleController@index')->name('schedule.index');
		Route::get('dataschedule', 'ScheduleController@dataschedule')->name('schedule.ds');
		Route::get('{id}', 'ScheduleController@data')->name('schedule.data');
		Route::get('{id}/show', 'ScheduleController@show')->name('schedule.show');
	});
	Route::prefix('activities')->group(function(){
		Route::prefix('register')->group(function(){
			// Cara Registrasi
			Route::get('/', 'ActivitiesController@index')->name('activities.index');
			// Pilih Alat yang ingin digunakan
			Route::get('form', 'ActivitiesController@showform')->name('activities.showform');
			Route::get('dataform', 'ActivitiesController@dataform')->name('activities.dataform');
			// Isi formulir
			Route::get('form/{id}', 'ActivitiesController@create')->name('activities.create');
			Route::post('store', 'ActivitiesController@store')->name('activities.store');
		});
		Route::get('edit/{id}', 'ActivitiesController@edit')->name('activities.edit');
		Route::put('update/{id}', 'ActivitiesController@update')->name('activities.update');
		Route::delete('delete/{id}', 'ActivitiesController@delete')->name('activities.delete');
		Route::get('confirm/{id}', 'ActivitiesController@confirm')->name('activities.confirm');
		Route::get('reject/{id}', 'ActivitiesController@reject')->name('activities.reject');
		Route::prefix('status')->group(function(){
			// Booking Request 1,2
			Route::get('booking', 'ActivitiesController@booking')->name('status.booking');
			Route::get('booking/datatable', 'ActivitiesController@datatableBooking')->name('status.booking.dt');
			// Approved by Lecturer 3
			Route::get('lecturer', 'ActivitiesController@lecturer')->name('status.lecturer');
			Route::get('lecturer/datatable', 'ActivitiesController@datatableLecturer')->name('status.lecturer.dt');
			// Confirmation Schedule 4
			Route::get('confirmation', 'ActivitiesController@confirmation')->name('status.confirmation');
			Route::get('confirmation/datatable', 'ActivitiesController@datatableConfirmation')->name('status.confirmation.dt');
			// Reschedule Offered List 5
			Route::get('reschedule', 'ActivitiesController@reschedule')->name('status.reschedule');
			Route::get('reschedule/datatable', 'ActivitiesController@datatableReschedule')->name('status.reschedule.dt');
			// Approved Schedule 6
			Route::get('approved', 'ActivitiesController@approved')->name('status.approved');
			Route::get('approved/datatable', 'ActivitiesController@datatableApproved')->name('status.approved.dt');
			// Rejected List 7,8
			Route::get('rejected', 'ActivitiesController@rejected')->name('status.rejected');
			Route::get('rejected/datatable', 'ActivitiesController@datatableRejected')->name('status.rejected.dt');
			// Canceled List 9
			Route::get('canceled', 'ActivitiesController@canceled')->name('status.canceled');
			Route::get('canceled/datatable', 'ActivitiesController@datatableCanceled')->name('status.canceled.dt');
			Route::prefix('admin')->group(function(){
				Route::get('booking', 'ActivitiesController@adminBooking')->name('admin.booking');
				Route::get('approved', 'ActivitiesController@adminApproved')->name('admin.approved');
				Route::get('rejected', 'ActivitiesController@adminRejected')->name('admin.rejected');
			});
		});
	});
	Route::prefix('verification')->group(function(){
		Route::prefix('request')->group(function(){
			Route::get('{token}', 'VerificationController@verify')->name('verify');
			Route::get('{token}/confirm', 'VerificationController@confirm')->name('verify.confirm');
			Route::get('{token}/reject', 'VerificationController@reject')->name('verify.reject');
		});
		Route::get('success', 'VerificationController@success')->name('verify.success');
	});
});



Route::get('settings', function () {
	return view('settings');
})->name('settings');

Route::get('contact', function () {
	return view('contact');
})->name('contact');