<?php
Route::get('login', 'LoginController@create');
Route::post('login', 'LoginController@store')->middleware('throttle:60,5');


Route::group(['middleware' => ['login']], function () {
    Route::get('/', 'MusteriController@index');
    Route::post('/', 'MusteriController@store');

    Route::resource('siparis', 'SiparisController');

    Route::get('siparis_liste', 'SiparisListesiController@index');
    Route::delete('siparis_liste/{id}', 'SiparisListesiController@destroy');

    // Route::get('siparisler', 'SiparisListesiController@show');
 
    Route::get('stok_durum','StokDurumController@index');

    Route::get('rapor', 'StokRaporController@index');

    Route::delete('logout/{username}', 'LoginController@destroy');
/*
    Route::get('cari', 'CariController@index');
    Route::post('cari', 'CariController@store');

    Route::get('risk', 'RiskController@index');
    Route::post('risk', 'RiskController@store');

    Route::get('detay', 'BakiyeDetayController@index');
    Route::post('detay', 'BakiyeDetayController@store');

    Route::get('geciken', 'GecikenBakiyeController@index');
    Route::post('geciken', 'GecikenBakiyeController@store');

    Route::get('satis', 'SatisController@index');
    Route::post('satis', 'SatisController@store');

    Route::get('ceksenet', 'CekSenetController@index');
    Route::post('ceksenet', 'CekSenetController@store');

    Route::get('satis_analiz', 'SatisAnalizController@index');
    Route::post('satis_analiz', 'SatisAnalizController@store');

    Route::get('satis_analiz_miktar', 'SatisMiktarController@index');
    Route::post('satis_analiz_miktar', 'SatisMiktarController@store');

*/
});
