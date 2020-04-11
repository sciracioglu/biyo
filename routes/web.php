<?php
Route::get('login', 'LoginController@create');
Route::post('login', 'LoginController@store')->middleware('throttle:60,5');

Route::group(['middleware' => ['login']], function () {
    Route::get('/', 'MusteriController@index');
    Route::post('/', 'MusteriController@store');
    Route::resource('siparis', 'SiparisController');
    Route::get('siparis_liste', 'SiparisListesiController@index');
    Route::get('siparis_liste/{evraksn}', 'SiparisListesiController@show');
    Route::delete('siparis_liste/{id}', 'SiparisListesiController@destroy');
    Route::get('depo_durum', 'DepoDurumController@index');
    Route::get('satis_rapor', 'SatisRaporController@index');
    Route::get('satis_rapor_ay', 'SatisRaporController@aylar');
    Route::get('satis_rapor_musteri', 'SatisRaporController@musteriler');
    Route::get('satis_rapor_detay', 'SatisRaporController@hesaplar');
    Route::get('kapatma', 'KapatmaController@index');
    // Route::get('siparisler', 'SiparisListesiController@show');
    Route::get('stok_durum', 'StokDurumController@index');
    Route::get('rapor', 'StokRaporController@index');
    Route::delete('logout/{username}', 'LoginController@destroy');
});
