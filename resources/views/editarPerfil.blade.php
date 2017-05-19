@extends('layout')
    @section('container')
    <div style="width:400px; margin: 0 auto;">
        <h2> Actualizar datos de perfil </h2>
        <form method="POST" action="/edicion" id="fmEditar" class="fmEditar" enctype="multipart/form-data">

            <div class="form-group"> <!-- Usuario -->
                <label for="pass" class="control-label">Contraseña actual</label>
                <input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña">
            </div>    

           <div class="form-group"> <!-- Password -->
                <label for="pass" class="control-label">Contraseña nueva</label>
                <input type="password" class="form-control" id="passN" name="passN" placeholder="Contraseña nueva">
            </div>

            <div class="form-group"> <!-- Password2 -->
                <label for="pass2" class="control-label">Repetir contraseña nueva</label>
                <input type="password" class="form-control" id="pass2N" name="pass2N" placeholder="Repetir contraseña nueva">
            </div>    

            <div class="form-group">
                <label for="foto">Elegir foto</label>
                <input type="file" class="form-control-file" name='foto' id='foto' </input>
                <input type="hidden" name="_token" value="{{csrf_token()}}">
            </div>

            <div class="form-group"> <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>              
        </form>
    <div>
    @endsection