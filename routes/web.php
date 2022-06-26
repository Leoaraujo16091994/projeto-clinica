<?php



Route::get('/', function () {
    return view('auth.login');
});

//Route::post('/autocomplete/fetch', 'ChegadaController@fetch')->name('autocomplete.fetch');
//Route::post('/autocomp/fetch', 'ChamadaController@fetch')->name('autocomp.fetch');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    
    Route::get('/register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
    Route::post('/register', ['uses' => 'Auth\RegisterController@register']);
    
    Route::resource('/paciente','PacienteController');
   
    //PrincipalController
    Route::resource('/principal','PrincipalController');
    Route::post('/pacienteExtra','PrincipalController@storePacienteExtra');
    Route::get('/todosPacientes','PrincipalController@todosPacientes')->name('autocompletePacientes.fetch');
    Route::put('/chamarNovamente/{id}','PrincipalController@chamarNovamente');

     //PainelController
    Route::resource('/painel','PainelController');
   


  /*  Route::get ('/paginainicial','PacientesController@inicio');
    
    //PacientesController
    Route::get ('/resultadopaciente','PacientesController@resultadoconsulta');
    Route::get('/deletar','ChamadaController@deletar');

    //ChegadaController
    Route::resource ('/chegada','ChegadaController');
    Route::post('/chegada/fetch', 'ChegadaController@fetch')->name('autocomplete.fetch');
    
    //ChamadaController
    Route::resource('/chamarpainel','ChamadaController');
   // Route::get('/painel','ChamadaController@exibirpainel');
    //Route::get('/paineltelacheia','ChamadaController@paineltelacheia');
    Route::get('/home', 'HomeController@index')->name('home');
    


//RelatorioController
   Route::get('/relatoriospronto', 'RelatoriosController@relatorio');
   Route::resource('/relatorios','RelatoriosController');

*/





   
   

});