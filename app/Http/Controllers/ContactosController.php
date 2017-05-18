<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;
use App\Contacto;
use DB;

class ContactosController extends Controller {

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

	public function busqueda(Request $req){
		DB::enableQueryLog();
		$busqueda="";
		$usuario = session('usuario'); //usando el helper
		$busqueda = $req -> busqueda;
		$contactos = null;
		switch($req->categoria){
			case "nombre":
				//$busqueda = $req -> busqueda;
				//$contactos = DB::table('contactos')->where('idUsuario', $usuario)->where()->get();
				$contactos = DB::table('contactos')
							->join('usuarios', 'usuarios.id', '=', 'contactos.idUsuario')
							->select('contactos.*')
							->where('contactos.idUsuario', '=', $usuario)
							->where('contactos.nombre', 'like', '%'.$busqueda.'%')
							->get();
				break;
			case "email":
				$contactos = DB::table('contactos')
							->join('usuarios', 'usuarios.id', '=', 'contactos.idUsuario')
							->select('contactos.*')
							->where('contactos.idUsuario', '=', $usuario)
							->where('contactos.email', 'like', '%'.$busqueda.'%')
							->get();
				break;
			case "cel":
				$contactos = DB::table('contactos')
							->join('usuarios', 'usuarios.id', '=', 'contactos.idUsuario')
							->select('contactos.*')
							->where('contactos.idUsuario', '=', $usuario)
							->where('contactos.cel', 'like', '%'.$busqueda.'%')
							->get();
				break;
		}
		


		//$contactos = DB::table('contactos')->where('idUsuario', $usuario)->get();
		//dd(DB::getQueryLog());
		/*$resp = "<table><tr><td>Nombre</td><td>Correo</td><td>Tel fijo</td><td>Celular</td><td>Dirección</td><td>Foto</td><td>Eliminar</td></tr>";

            foreach($contactos as $contacto){
                //while($row = mysqli_fetch_assoc($result)){
                    $resp .= "<tr>";
                    $resp .= "<td>".$contacto->nombre."</td>";
                    $resp .= "<td>".$contacto->email."</td>";
                    $resp .= "<td>".$contacto->tel."</td>";
                    $resp .= "<td>".$contacto->cel."</td>";
                    $resp .= "<td>".$contacto->direccion."</td>";
                    $resp .= "<td><img style = 'height: 100px; width: 100px' src='".$contacto->fotoContacto."'></img> </td>";
                    $resp .= "<td class='filaCont'><button onclick='eliminar(this)' value=".$contacto->idContacto." ><img  style = ' height: 20px; width: 20px; ' src='img/eliminar.png'></img></button></td>";
                    $resp .= "</tr>";
                //}
			}
                 $resp .= "</table>";
		
		return $resp;*/
		
		return $contactos;

	}

	public function eliminar(Request $req){
		DB::table('contactos')->where('idContacto', '=', $req->valor)->delete();
		return "";
	}

	public function agregar(Request $req){

		$destinationPath = 'img/fotosContacto/';
		$file = $req->file('foto');
		$nuevaDireccion = $destinationPath.$req->nombre."_".$req->tel."_".$file->getClientOriginalName();
		$usuario = session('usuario'); //usando el helper

		DB::table('contactos')->insert(
			[
				'idUsuario'   => $usuario,
				'nombre' 	  => $req->nombre,
				'tel' 	      => $req->tel,
				'cel' 	 	  => $req->cel,
				'direccion'   => $req->dir,
				'fotoContacto'=> $nuevaDireccion,
				'email'       => $req->email
			]
		);

		$file->move($destinationPath,$req->nombre."_".$req->tel."_".$file->getClientOriginalName());
		return "si";
		//Move Uploaded File
		
	}

}
