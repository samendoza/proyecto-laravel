@extends('layout')
    @section('container')
    
    <div id="fmAgregar"  style="width:400px; margin: 0 auto;"> 
    <h2> Agregar contactos </h2>
        <form enctype="multipart/form-data" method="Post" action="contactos/agregar" class="fmAddCont">
            
            <div class="form-group"> <!-- Nombre -->
                <label for="nombre" class="control-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
            </div>  

            <div class="form-group"> <!-- Email -->
                <label for="email" class="control-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" required>
            </div>  

            <div class="form-group"> <!-- Tel fijo -->
                <label for="tel" class="control-label">Teléfono fijo</label>
                <input type="text" class="form-control" id="tel" name="tel" placeholder="Teléfono fijo" required>
            </div>  
        
            <div class="form-group"> <!-- Celular -->
                <label for="cel" class="control-label">Celular</label>
                <input type="text" class="form-control" id="cel" name="cel" placeholder="Celular" required>
            </div>  

            <div class="form-group"> <!-- Dirección -->
                <label for="dir" class="control-label">Dirección</label>
                <input type="text" class="form-control" id="dir" name="dir" placeholder="Dirección" required>
            </div>  
            
            <div class="form-group">
                <label for="foto">Elegir foto</label>
                <input type="file" class="form-control-file" name='foto' id='foto' </input>
            </div>

            <div class="form-group"> <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Agregar contacto</button>
            </div>   
        </form>
        <div class="messages"> </div>
    </div>
    
@endsection

<!--Nombre: <input type="text" name="nombre" required> </input><br>
 E-mail: <input type="text" name="email" required> </input><br>
  Tel. fijo: <input type="text" name="tel" required> </input><br>
  Celular: <input type="text" name="cel" required> </input><br>
   Dirección <input type="text" name="dir" required> </input><br>
     Agregar una imagen: <input type="file" name="foto" id="foto"></input><br>
            <input type="submit" value="Agregar contacto" required> </input>-->