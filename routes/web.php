<?php

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

Route::get('/', function () {
    return view('welcome');
});

/* Route::get('/tinker', function () {
    return view('tinker');
}); */

Route::get('/tinker', [App\Http\Controllers\BotManController::class, 'tinker'])->name('tinker');

/* Route::post('/botman', function() {
    app('botman')->listen();
});  */

Route::match(['get', 'post'],'/botman', [App\Http\Controllers\BotManController::class,'handle']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/******** Inicio Rutas Manejo de Cuestionarios *********/ 

Route::get('/cuestionarios', [App\Http\Controllers\CuestionarioController::class, 'index']);
Route::get('/cuestionarios/create', [App\Http\Controllers\CuestionarioController::class, 'create']);
Route::post('/cuestionarios', [App\Http\Controllers\CuestionarioController::class, 'store']);
Route::get('/cuestionarios/{cuestionario}', [App\Http\Controllers\CuestionarioController::class, 'show']);
Route::get('/cuestionarios/{cuestionario}/edit', [App\Http\Controllers\CuestionarioController::class, 'edit']);
Route::patch('/cuestionarios/{cuestionario}', [App\Http\Controllers\CuestionarioController::class, 'update']);
Route::delete('/cuestionarios/{cuestionario}', [App\Http\Controllers\CuestionarioController::class, 'destroy']);

/******** Fin Rutas Manejo de Cuestionarios *********/ 


/******** Inicio Rutas Manejo de Preguntas *********/ 

Route::get('/cuestionarios/{cuestionario}/preguntas/create', [App\Http\Controllers\PreguntaController::class, 'create']);
Route::post('/cuestionarios/{cuestionario}/preguntas', [App\Http\Controllers\PreguntaController::class, 'store']);
Route::get('/cuestionarios/preguntas/{pregunta}/edit', [App\Http\Controllers\PreguntaController::class, 'edit']);
Route::patch('/cuestionarios/preguntas/{pregunta}', [App\Http\Controllers\PreguntaController::class, 'update']);
Route::delete('/cuestionarios/preguntas/{pregunta}', [App\Http\Controllers\PreguntaController::class, 'destroy']);

/******** Fin Rutas Manejo de respuestas *********/ 


/******** Inicio Rutas Manejo de respuestas *********/ 

Route::get('/cuestionarios/preguntas/{pregunta}/respuestas/create', [App\Http\Controllers\RespuestaController::class, 'create']);
Route::post('/cuestionarios/preguntas/{pregunta}/respuestas', [App\Http\Controllers\RespuestaController::class, 'store']);
Route::delete('/cuestionarios/{cuestionario}/respuestas/{respuesta}', [App\Http\Controllers\RespuestaController::class, 'destroy']);

/******** Fin Rutas Manejo de respuestas *********/ 


Route::get('/cuestionarios/{cuestionario}/conclusiones', [App\Http\Controllers\ConclusionesController::class, 'show']);
Route::get('/cuestionarios/{cuestionario}/conclusiones/create', [App\Http\Controllers\ConclusionesController::class, 'create']);
Route::post('/cuestionarios/{cuestionario}/conclusiones', [App\Http\Controllers\ConclusionesController::class, 'store']);
Route::get('/cuestionarios/{cuestionario}/conclusiones/{conclusion}/edit', [App\Http\Controllers\ConclusionesController::class, 'edit']);
Route::patch('/cuestionarios/{cuestionario}/conclusiones/{conclusion}', [App\Http\Controllers\ConclusionesController::class, 'update']);
Route::delete('/cuestionarios/{cuestionario}/conclusiones/{conclusion}', [App\Http\Controllers\ConclusionesController::class, 'destroy']);



