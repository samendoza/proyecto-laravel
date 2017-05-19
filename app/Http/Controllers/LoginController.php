<?php namespace App\Http\Controllers;

use App\Usuario;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;
use DB;

class LoginController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function inicio(Request $request){
		//$res =   Usuario::inicioSesion($request->usuario, $request->pass);
		//$users = DB::table('usuarios')->select('usuario')->where('usuario','=','saul')->where('pass','=','123')->get();
		//echo $request->usuario;
		
		//$users = Usuario::find($request->usuario)->where('pass', '=',$request->pass)->get();
		$user = DB::table('usuarios')->select('*')->where('id', '=', $request->usuario)->where('pass','=',md5($request->pass))->get();
		/*if($user != null)
			$user = $user->where('pass', '=',$request->pass)->get();*/

		
		if(count((array)$user)>0){
			session_start();
			$_SESSION['login'] = true;
			session(['usuario' => $request->usuario]); //usando el helper
			session(['img' => $user[0]->fotoUsuario]); //usando el helper
			//Auth::loginUsingId($request->usuario);
			return "1";
		}

		else
			return "2";
			

		//return $user;
		//return "inicie sesion";
	}

	public function registrar(Request $request){

		$destinationPath = 'img/fotosUsuario/';
		$file = $request->file('foto');
		$nuevaDireccion = $destinationPath.$request->usuario.".".$file->getClientOriginalExtension();

		if($request->pass == $request->pass2){
        	DB::table('usuarios')->insert(
				[
					'id'	 => $request->usuario,
					'pass' 	     => md5($request->pass),
					'fotoUsuario'=> $nuevaDireccion
				]
			);
            $file->move($destinationPath,$request->usuario.".".$file->getClientOriginalExtension());
			
			return "1";
        }
        else
			return "3";
	}

	public function verificar(Request $request){
		//echo $request->usuario;
		$user = Usuario::find($request->usuario);
		if(count((array)$user)>0){
			return "1";
		}

		else
			return "2";

    }

	public function editar(Request $request){
		//DB::enableQueryLog();


		$file = $request->file('foto');
		$destinationPath = 'img/fotosUsuario/';

		$usuario = session('usuario'); //usando el helper
		$nombre = $usuario = session('usuario');
			
		$user = DB::table('usuarios')->select('*')
						->where('id', '=', $usuario)
						->where('pass','=',md5($request->pass))
						->get();
		//dd(DB::getQueryLog());
		if(count((array)$user)>0){
			$rutaImg="";
			foreach($user as $usuario)
				$rutaImg = $usuario->fotoUsuario;
			if($request->passN == $request->pass2N){
				DB::table('usuarios')
					->where('id', $usuario->id )
					->update(['pass' => md5($request->passN)]);
				$file->move($destinationPath,$rutaImg);
				//dd(DB::getQueryLog());
				return "1";
			}
			else 
				return "3";
		}
		else
			return "4";
		//}
	}


}