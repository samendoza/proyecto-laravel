<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\Usuario;
//use DB;

Route::get('/', 'WelcomeController@index');

Route::post('login', 'LoginController@inicio');
Route::get('home', function(){
	return view('home');
});


Route::get('/contactos', 'ContactosController@busqueda');
Route::post('/contactos/eliminar', 'ContactosController@eliminar');


	//$usuarios = Usuario::all();
	/*foreach ($usuarios as $usuario) {
    	echo $usuario->pass;
	}*/

	//$users = DB::table('usuarios')->select('usuario')->where('usuario','=','saul')->where('pass','=','123')->get();
	//return $users;
	
	/*$users = DB::table('usuarios')
					->select('count(*)')
					->where([
    						['usuario', '=', $usuario],
    						['pass', '=', $pass]])
					->get();
		//return $users;
		//$resultado = Usuario::inicioSesion($request -> usuario , $request -> pass);
		return $users->usuario;*/

//});

//Route::post('login', 'LoginController@inicio');

/*Route::get('home', 'HomeController@index');*/



Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
