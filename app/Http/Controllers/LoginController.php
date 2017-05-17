<?php namespace App\Http\Controllers;

use App\Usuario;
use App\Http\Requests;
use App\Http\Controllers\Controller;

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
		
		$user = Usuario::find($request->usuario);
		if($user != null)
			$user = $user->where('pass', '=',$request->pass)->get();

		
		if(count((array)$user)>0){
			return "1";
		}

		else
			return "2";
			

		//return $user;
		//return "inicie sesion";
	}

}
