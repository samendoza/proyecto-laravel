@extends('layout')
    @section('container')
    <div>
            <h2> Contactos </h2>

            Buscar contacto : <input type="text" name="busqueda" id="busqueda" class="busqueda"> </input> <br> <br>
        
            Buscar por: <br>
            <input type="radio" class="rbCategoria" name="categoria" value="nombre" checked> Nombre<br>
            <input type="radio" class="rbCategoria" name="categoria" value="email"> Correo electrónico <br>
            <input type="radio" class="rbCategoria" name="categoria" value="cel"> Celular
            <center>
            <table id="respuesta" class = 'table table-bordered'>
                
            </table>
             <center>
    </div>
@endsection