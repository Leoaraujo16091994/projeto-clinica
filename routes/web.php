<?php



Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get ('/paginainicial','PacientesController@inicio');
    
    //PacientesController
    Route::resource('/pacientes','PacientesController');
    Route::match (['get', 'post'],'/consultarpaciente','PacientesController@consultar');
    Route::get ('/resultadopaciente','PacientesController@resultadoconsulta');



    Route::match (['get', 'post'],'/editarpaciente','PacientesController@editar');



    
    
    //ChegadaController
    Route::resource ('/chegada','ChegadaController');
    
    
    //ChamadaController
    Route::resource('/chamarpainel','ChamadaController');
    Route::get('/painel','ChamadaController@exibirpainel');
    Route::get('/paineltelacheia','ChamadaController@paineltelacheia');
    Route::get('/home', 'HomeController@index')->name('home');
    


//RelatorioController
   Route::get('/relatoriospronto', 'RelatoriosController@relatorio');
   Route::resource('/relatorios','RelatoriosController');

});