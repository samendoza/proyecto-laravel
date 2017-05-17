<?php 
namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model {
	 protected $table = 'usuarios';
	//
	public function iniciaSesion($usuario, $pass){
		$users = DB::table('usuarios')->select('usuario')->where('usuario','=',$usuario)->where('pass','=',$pass)->get();
		return $users;
	}

	

}
