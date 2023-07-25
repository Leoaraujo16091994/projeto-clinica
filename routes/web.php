<?php


Route::get('/', function () {
  $guard = null;
  if (Auth::guard($guard)->check()) {
    return redirect('/pacienteDoDia');
}
  return view('auth.login');
});

//Route::post('/autocomplete/fetch', 'ChegadaController@fetch')->name('autocomplete.fetch');
//Route::post('/autocomp/fetch', 'ChamadaController@fetch')->name('autocomp.fetch');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
 
    Route::get('/register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
    Route::post('/register', ['uses' => 'Auth\RegisterController@register']);
    
    Route::resource('/paciente','PacienteController');
   
    //pacienteDoDiaController
    Route::resource('/pacienteDoDia','PacienteDoDiaController');
    Route::post('/pacienteExtra','PacienteDoDiaController@storePacienteExtra');
    Route::get('/todosPacientes','PacienteDoDiaController@todosPacientes')->name('autocompletePacientes.fetch');
    Route::put('/chamarNovamente/{id}','PacienteDoDiaController@chamarNovamente');
    Route::put('/chamarAcompanhante/{id}','PacienteDoDiaController@chamarAcompanhante');

     //PainelController
    Route::resource('/painel','PainelController');
   

  });   
