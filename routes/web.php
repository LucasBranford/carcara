<?php

use App\Models\Entidade;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Client\Response as ClientResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::get('/', 'App\Http\Controllers\HomeControlador@index')->name('index');
// Tarefas
Route::prefix('/tarefas')->group(function () {
    Route::post('/criar', 'App\Http\Controllers\HomeControlador@store')->name('tarefas.store')->middleware(['auth', 'permission:tarefas-update']);
    Route::put('/update/{id}', 'App\Http\Controllers\HomeControlador@update')->name('tarefas.update')->middleware(['auth', 'permission:tarefas-update']);
    Route::delete('/apagar/{id}', 'App\Http\Controllers\HomeControlador@destroy')->name('tarefas.delete')->middleware(['auth', 'permission:tarefas-delete']);
});

Route::prefix('/eventos')->group(function () {
     Route::get('/show', 'App\Http\Controllers\HomeControlador@showEventos')->name("eventos.show")->middleware(['auth','permission:eventos-create']);
    Route::post('/store', 'App\Http\Controllers\HomeControlador@storeEventos')->name('eventos.store')->middleware(['auth','permission:eventos-create']);
    Route::put('/update', 'App\Http\Controllers\HomeControlador@updateEventos')->name('eventos.update')->middleware(['auth', 'permission:eventos-update']);
    Route::post('/delete', 'App\Http\Controllers\HomeControlador@deleteEventos')->name('eventos.delete')->middleware(['auth', 'permission:eventos-delete']);
});

Route::get('/home', [App\Http\Controllers\HomeControlador::class, 'index'])->name('home');

//Entidade
Route::prefix('/entidades')->group(function () {

    Route::get('/', 'App\Http\Controllers\EntidadeControlador@index')->name('entidades');
    //Editar
    Route::get('/editar/{id}', 'App\Http\Controllers\EntidadeControlador@edit')->name('entidades.editar')->middleware(['auth', 'permission:entidades-update']);
    //Update
    Route::PUT('/update/{id}', 'App\Http\Controllers\EntidadeControlador@update')->name('entidades.update')->middleware(['auth', 'permission:entidades-update']);
    //Criar
    Route::get('/criar', 'App\Http\Controllers\EntidadeControlador@create')->name('entidades.criar')->middleware(['auth', 'permission:entidades-create']);
    Route::post('/store', 'App\Http\Controllers\EntidadeControlador@store')->name('entidades.store')->middleware(['auth', 'permission:entidades-create']);
});


//Documentos
Route::prefix('/documentos')->group(function () {
    Route::get('/', 'App\Http\Controllers\DocumentoControlador@index')->name('documentos')->middleware('auth');

    // Route::put('/criar', 'App\Http\Controllers\DocumentoControlador@store')->name('documentos.criar')->middleware(['permission:oficios-create']);

    Route::PUT('/adicionar/{id}', 'App\Http\Controllers\DocumentoControlador@update')->name('documentos.add')->middleware(['auth', 'permission:oficios-update']);
    Route::put('/editar/{id}', 'App\Http\Controllers\DocumentoControlador@edit')->name('documentos.edit')->middleware(['auth', 'permission:oficios-update']);

    Route::get('/meus', 'App\Http\Controllers\DocumentoControlador@meus')->name('documentos.meus')->middleware('auth');
});

//Ofícios
Route::prefix('/oficio')->group(function () {
    Route::GET('/criar', 'App\Http\Controllers\OficioControlador@create')->name('oficio.criar')->middleware(['auth', 'permission:oficios-create']);
    Route::POST('/store', 'App\Http\Controllers\OficioControlador@store')->name('oficio.store')->middleware(['auth', 'permission:oficios-create']);
    Route::GET('/imprimir/{id}', 'App\Http\Controllers\OficioControlador@imprimir')->name('oficio.imprimir');
    Route::GET('/assinar/{id}', 'App\Http\Controllers\OficioControlador@assinar')->name('oficio.assinar')->middleware(['auth', 'permission:oficios-create']);
    Route::get('/editar/{id}', 'App\Http\Controllers\OficioControlador@edit')->name('oficio.editar')->middleware(['auth', 'permission:oficios-update']);
    Route::PUT('/update/{id}', 'App\Http\Controllers\OficioControlador@update')->name('oficio.update')->middleware(['auth', 'permission:oficios-update']);

    Route::GET('/verificar', 'App\Http\Controllers\OficioControlador@verificar')->name('oficio.verificar');
    Route::get('/verificando', 'App\Http\Controllers\OficioControlador@verificando')->name('oficio.verificando');
});


//Atas
Route::prefix('/ata')->group(function () {
    Route::GET('/criar', 'App\Http\Controllers\AtaControlador@create')->name('ata.criar')->middleware(['auth', 'permission:atas-create']);
    Route::POST('/store', 'App\Http\Controllers\AtaControlador@store')->name('ata.store')->middleware(['auth', 'permission:atas-create']);
    Route::GET('/imprimir/{id}', 'App\Http\Controllers\AtaControlador@imprimir')->name('ata.imprimir');
    Route::GET('/assinar/{id}', 'App\Http\Controllers\AtaControlador@assinar')->name('ata.assinar')->middleware(['auth', 'permission:atas-create']);
    Route::get('/editar/{id}', 'App\Http\Controllers\AtaControlador@edit')->name('ata.editar')->middleware(['auth', 'permission:atas-update']);
    Route::PUT('/update/{id}', 'App\Http\Controllers\AtaControlador@update')->name('ata.update')->middleware(['auth', 'permission:atas-create']);

    Route::GET('/verificar', 'App\Http\Controllers\AtaControlador@verificar')->name('ata.verificar');
    Route::get('/verificando', 'App\Http\Controllers\AtaControlador@verificando')->name('ata.verificando');
});

//Portarias
Route::prefix('/portaria')->group(function () {
    Route::GET('/criar', 'App\Http\Controllers\PortariaControlador@create')->name('portaria.criar')->middleware(['auth', 'permission:portarias-create']);
    Route::POST('/store', 'App\Http\Controllers\PortariaControlador@store')->name('portaria.store')->middleware(['auth', 'permission:portarias-create']);
    Route::GET('/imprimir/{id}', 'App\Http\Controllers\PortariaControlador@imprimir')->name('portaria.imprimir');
    Route::GET('/assinar/{id}', 'App\Http\Controllers\PortariaControlador@assinar')->name('portaria.assinar')->middleware(['auth', 'permission:portarias-create']);
    Route::get('/editar/{id}', 'App\Http\Controllers\PortariaControlador@edit')->name('portaria.editar')->middleware(['auth', 'permission:portarias-update']);
    Route::PUT('/update/{id}', 'App\Http\Controllers\PortariaControlador@update')->name('portaria.update')->middleware(['auth', 'permission:portarias-create']);

    Route::GET('/verificar', 'App\Http\Controllers\PortariaControlador@verificar')->name('portaria.verificar');
    Route::get('/verificando', 'App\Http\Controllers\PortariaControlador@verificando')->name('portaria.verificando');
});


//Usuários

Route::prefix('/usuarios')->group(function () {
    Route::get('/todos', 'App\Http\Controllers\UserControlador@editAll')->name('usuarios.editAll')->middleware(['auth','role:administrador']);
    Route::POST('/storeAll', 'App\Http\Controllers\UserControlador@storeEdit')->name('usuarios.storeEditAll')->middleware(['auth', 'role:administrador']);


    Route::get('/', 'App\Http\Controllers\UserControlador@index')->name('usuarios.index')->middleware('auth');
    // Route::get('/edit/{id}', 'App\Http\Controllers\UserControlador@edit')->name('usuarios.edit')->middleware('auth');
       Route::post('/update/{id}', 'App\Http\Controllers\UserControlador@update')->name('usuarios.update')->middleware('auth');


    //   Route::get('/perfil/{id}', 'App\Http\Controllers\UserControlador@edit')->name('usuarios.perfil')->middleware('auth');
});

//CKEditor 4 imagens
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

//Rotas de Gestão
Route::prefix('/gestao')->group(function () {
    Route::GET('/', 'App\Http\Controllers\GestaoControlador@index')->name('gestao.index')->middleware(['auth']);
    Route::get('/criar', 'App\Http\Controllers\GestaoControlador@create')->name('gestao.criar')->middleware(['auth', 'permission:gestoes-create']);
    Route::POST('/store', 'App\Http\Controllers\GestaoControlador@store')->name('gestao.store')->middleware(['auth', 'permission:gestoes-create']);
    Route::GET('/editar/{id}', 'App\Http\Controllers\GestaoControlador@edit')->name('gestao.editar')->middleware(['auth', 'permission:gestoes-update']);
    Route::PUT('/update/{id}', 'App\Http\Controllers\GestaoControlador@update')->name('gestao.update')->middleware(['auth', 'permission:gestoes-update']);


    //   Route::get('/perfil/{id}', 'App\Http\Controllers\UserControlador@edit')->name('usuarios.perfil')->middleware('auth');
});

//Rotas de Patrimônio
Route::prefix('/patrimonio')->group(function () {
    Route::GET('/', 'App\Http\Controllers\PatrimonioControlador@index')->name('patrimonio.index')->middleware(['auth']);
    Route::GET('/inserir', 'App\Http\Controllers\PatrimonioControlador@create')->name('patrimonio.criar')->middleware(['auth', 'permission:patrimonio-create']);
    Route::POST('/store', 'App\Http\Controllers\PatrimonioControlador@store')->name('patrimonio.store')->middleware(['auth', 'permission:patrimonio-create']);
    Route::PUT('/update/{id}', 'App\Http\Controllers\PatrimonioControlador@update')->name('patrimonio.update')->middleware(['auth', 'permission:patrimonio-update']);

   Route::GET('/entidade', 'App\Http\Controllers\PatrimonioControlador@entidade')->name('patrimonio.entidade')->middleware(['auth','permission:patrimonio-create']);


    //Empréstimo
    Route::GET('/emprestimo', 'App\Http\Controllers\PatrimonioControlador@indexEmprestimo')->name('patrimonio.indexEmprestimo')->middleware(['auth']);
    Route::GET('/emprestimo/criar', 'App\Http\Controllers\PatrimonioControlador@criarEmprestimo')->name('patrimonio.criarEmprestimo')->middleware(['auth', 'permission:emprestimo-create']);
    Route::POST('/storeemprestimo', 'App\Http\Controllers\PatrimonioControlador@storeEmprestimo')->name('patrimonio.storeEmprestimo')->middleware(['auth', 'permission:emprestimo-create']);
    Route::PUT('/emprestimo/update/{id}', 'App\Http\Controllers\PatrimonioControlador@updateEmprestimo')->name('patrimonio.encerrarEmprestimo')->middleware(['auth', 'permission:emprestimo-create']);



    //   Route::get('/perfil/{id}', 'App\Http\Controllers\UserControlador@edit')->name('usuarios.perfil')->middleware('auth');
});
//Unidades
Route::prefix('/unidades')->group(function () {
    Route::get('/', 'App\Http\Controllers\UnidadeControlador@index')->name('unidades.index')->middleware('auth');
    // Route::get('/listar', 'App\Http\Controllers\UserControlador@listar')->name('usuarios.listar')->middleware('auth');
    // Route::get('/edit/{id}', 'App\Http\Controllers\UserControlador@edit')->name('usuarios.edit')->middleware('auth');
    Route::get('/criar', 'App\Http\Controllers\UnidadeControlador@create')->name('unidades.criar')->middleware(['auth', 'role:administrador']);

    Route::POST('/store', 'App\Http\Controllers\UnidadeControlador@store')->name('unidades.store')->middleware(['auth', 'role:administrador']);

    Route::post('/update/{id}', 'App\Http\Controllers\UnidadeControlador@update')->name('unidades.update')->middleware(['auth', 'role:administrador']);
    Route::GET('/excluir/{id}', 'App\Http\Controllers\UnidadeControlador@destroy')->name('unidades.excluir')->middleware(['auth', 'role:administrador']);


    //   Route::get('/perfil/{id}', 'App\Http\Controllers\UserControlador@edit')->name('usuarios.perfil')->middleware('auth');
});


//Diretoria de Assuntos Estudantis (diae)
Route::prefix('/diae')->group(function () {


    //Fardas

    Route::GET('/fardas/painel', 'App\Http\Controllers\DiaeControlador@index')->name('fardas.index')->middleware(['auth', 'permission:fardas-create']);
    Route::GET('/fardas/encomendar', 'App\Http\Controllers\DiaeControlador@encomendarfardas')->name('fardas.encomendar')->middleware(['auth']);
    Route::POST('/fardas/encomendar/store', 'App\Http\Controllers\DiaeControlador@storefardas')->name('fardas.store')->middleware(['auth']);
    Route::PUT('/fardas/vendas/store/{id}', 'App\Http\Controllers\DiaeControlador@store')->name('vendasfardas.store')->middleware(['auth', 'permission:fardas-create']);
});

//Finanças
Route::prefix('/financas')->group(function () {
    Route::get('/', 'App\Http\Controllers\FinancasControlador@index')->name('financas.index')->middleware('auth');
    Route::GET('/nova', 'App\Http\Controllers\FinancasControlador@create')->name('financas.criar')->middleware(['auth', 'permission:financas-create']);
    Route::post('/store', 'App\Http\Controllers\FinancasControlador@store')->name('financas.store')->middleware(['auth', 'permission:financas-create']);
    Route::get('/entidade', 'App\Http\Controllers\FinancasControlador@entidade')->name('financas.entidade')->middleware(['auth', 'permission:financas-read']);
    // Route::get('/balancete', 'App\Http\Controllers\FinancasControlador@balancete')->name('financas.entidade')->middleware(['auth', 'permission:financas-read']);

});
//Ouvidoria
Route::prefix('/ouvidoria')->group(function () {
    Route::get('/', 'App\Http\Controllers\OuvidoriaControlador@index')->name('ouvidoria.index')->middleware('auth');
    Route::GET('/nova', 'App\Http\Controllers\OuvidoriaControlador@create')->name('ouvidoria.criar')->middleware(['auth']);
    // Route::post('/store', 'App\Http\Controllers\FinancasControlador@store')->name('ouvidoria.store')->middleware(['auth', 'permission:ouvidoria-create']);
    // Route::get('/entidade', 'App\Http\Controllers\FinancasControlador@entidade')->name('ouvidoria.entidade')->middleware(['auth', 'permission:ouvidoria-read']);
    // // Route::get('/balancete', 'App\Http\Controllers\FinancasControlador@balancete')->name('ouvidoria.entidade')->middleware(['auth', 'permission:ouvidoria-read']);

});


//Votação
// Route::prefix('/votacao')->group(function () {
//     Route::get('/', 'App\Http\Controllers\VotacaoControlador@index')->name('votacao.index')
//         ->middleware(['auth', 'role:administrador']);
//     Route::get('/minhas', 'App\Http\Controllers\VotacaoControlador@minhasVotacoes')->name('votacao.minhas')->middleware(['auth', 'permission:votacao-create']);
//     Route::get('/votantes/{id}', 'App\Http\Controllers\VotacaoControlador@votantes')->name('votacao.listavotantes')->middleware(['auth', 'permission:votacao-create']);
//     Route::get('/validacao/{id}', 'App\Http\Controllers\VotacaoControlador@validacao')->name('votacao.validacao')->middleware(['auth', 'permission:votacao-update']);
//     Route::get('/votar', 'App\Http\Controllers\VotacaoControlador@votar')->name('votacao.votar')->middleware(['auth']);
//     Route::get('/criar', 'App\Http\Controllers\VotacaoControlador@create')->name('votacao.create')->middleware(['auth', 'permission:votacao-create']);
//     Route::get('/urna/{id}', 'App\Http\Controllers\VotacaoControlador@show')->name('votacao.urna')->middleware('auth');
//     Route::PUT('/delete/{id}', 'App\Http\Controllers\VotacaoControlador@destroy')->name('votacao.delete')->middleware(['auth', 'permission:votacao-delete']);
//     Route::PUT('/update/{id}', 'App\Http\Controllers\VotacaoControlador@update')->name('votacao.encerrar')->middleware(['auth', 'permission:votacao-update']);
//     Route::post('/store', 'App\Http\Controllers\VotacaoControlador@store')->name('votacao.store')->middleware(['auth']);
//     Route::post('/votar/voto', 'App\Http\Controllers\VotacaoControlador@storeVoto')->name('voto.store')->middleware(['auth']);
//     Route::post('/opcao', 'App\Http\Controllers\VotacaoControlador@storeOpcao')->name('opcao.store')->middleware(['auth']);
// });
