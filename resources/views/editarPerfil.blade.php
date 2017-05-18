@extends('layout')
    @section('container')
        <h2> Actualizar datos de perfil </h2>
        <form method="POST" action="/edicion" id="fmEditar" class="fmEditar" enctype="multipart/form-data">
            <span> Contraseña actual </span><br>
            <input type="password" name="pass" placeholder="Contraseña actual" id="pass" required> </input>
            <br>

            <span> Contraseña nueva </span><br>
            <input type="password" name="passN" placeholder="Contraseña nueva" required> </input> <br>

            <span> Repetir contraseña nueva</span><br>
            <input type="password" name="pass2N" placeholder="Repetir contraseña nueva" required> </input><br> 
            
            Agregar una imagen: <input type="file" name="foto" id="foto"></input><br>
            <input type="hidden" name="_token" value="{{ csrf_token() }}"> </input>
            <br>
            
            <input type="submit" value="Guardar cambios"> </input>
        </form>
    @endsection