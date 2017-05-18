<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="description" content="Página de prueba para uso de jquery y php">
    <meta name="keywords" content="HTML5, PHP, Jquery">
    <meta name="_token" content="{{ csrf_token() }}">
    
    <link rel="icon" href="../../favicon.ico">

    <title> Agenda electronica </title>

     <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/contacto.js"></script>
    <script src="js/perfil.js"></script>
    <script>
        $(document).ready(function(){ //hasta que la pagina este completamente cargada

            $("#fmregistro").submit(function(event){ //al dar clic en enviar:
                event.preventDefault(); //previene que el formulario se procese como lo hace normalmente 
                var formData = new FormData($(".fmregistro")[0]);
                var token = $('meta[name="_token"]').attr('content');
                formData.append("_token",token);

                formData.append("peticion","agregar");

                var $form = $( this ), // crea una variable form que apunta al formulario
                                    
                url = $form.attr( "action" );
                
                    $.ajax({
                    url: url,  
                    type: 'POST',
                    // Form data
                    //datos del formulario
                    data: formData,
                    //necesario para subir archivos via ajax
                    cache: false,
                    contentType: false,
                    processData: false,
                    //mientras enviamos el archivo
                    beforeSend: function(){
                        message = $("<span class='before'>Subiendo la imagen, por favor espere...</span>");
                        //showMessage(message)        
                    },
                    //una vez finalizado correctamente
                    success: function(data){
                        alert(data);
                        if(data == "1"){
                            alert("Usuario registrado con exito");
                            var url = "index.php"; 
                            $(location).attr('href',url);
                        }
                        else if(data == "2")
                            alert("No podemos registrar su usuario");
                        else
                            alert("Las contraseñas no coinciden");
                            message = $("<span class='success'>La imagen ha subido correctamente.</span>");
                    },
                    //si ha ocurrido un error
                    error: function(){
                        message = $("<span class='error'>Ha ocurrido un error.</span>");
                    }
                });
            });

            $("#usuarioR").keyup(function(){
                $("#avisoUsuario").show();
                // alert($(this).val());
                var usuario = $(":input[name='usuario']").val();
                var token = $('meta[name="_token"]').attr('content');
                var posting = $.post( "/verificar", {usuario: usuario, _token:token});
                


                posting.done(function( data ) {
                    if(data == "1"){    

                        $("#avisoUsuario").show().text("El nombre de usuario está ocupado");
                        if($( "#avisoUsuario" ).hasClass( "alert alert-success"))
                            $("#avisoUsuario").removeClass( "alert alert-success" );
                        $("#avisoUsuario").addClass( "alert alert-danger" );
                        
                    }
                    else if(data == "2"){
                            $("#avisoUsuario").show().text("El nombre de usuario está disponible");
                            if($( "#avisoUsuario" ).hasClass( "alert alert-danger" ))
                                $("#avisoUsuario").removeClass( "alert alert-danger" );
                            $("#avisoUsuario").addClass( "alert alert-success" );
                    }
                });
            });

        });
        </script>
  </head>

  <body>

   


    <div class="container">
       <center>
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron" style="margin-top:50px; width:400px">

    <form method="POST" action="/registrar" id="fmregistro" class="fmregistro" enctype="multipart/form-data">

    <div class="form-group"> <!-- Usuario -->
        <label for="usuarioR" class="control-label">Nombre de usuario</label>
        <input type="text" class="form-control" id="usuarioR" name="usuario" placeholder="Usuario">
    </div>    
    <div id="avisoUsuario" style="display:none"></div>
    <div class="form-group"> <!-- Password -->
        <label for="pass" class="control-label">Contraseña</label>
        <input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña">
    </div>                    
                            
    <div class="form-group"> <!-- Password -->
        <label for="pass2" class="control-label">Repetir contraseña</label>
        <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Repetir contraseña">
    </div>    
    <input type="hidden" name="_token" value="{{csrf_token()}}">

    <div class="form-group">
        <label for="exampleInputFile">Elegir foto</label>
        <input type="file" class="form-control-file" name='foto' id='foto' </input>
    </div>

    <div class="form-group"> <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Registrarme</button>
    </div>     
    
</form>
        
      </div>
        </center>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>


<!--<html>
	<head>
		<meta charset="UTF-8">     
        <meta name="_token" content="{{ csrf_token() }}">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){ //hasta que la pagina este completamente cargada

                $("#fmregistro").submit(function(event){ //al dar clic en enviar:

                    event.preventDefault(); //previene que el formulario se procese como lo hace normalmente 
                    
                    var formData = new FormData($(".fmregistro")[0]);
                    var token = $('meta[name="_token"]').attr('content');
                    formData.append("_token",token);

                    formData.append("peticion","agregar");

                    var $form = $( this ), // crea una variable form que apunta al formulario
                                      
                    url = $form.attr( "action" );
                   

                     $.ajax({
                        url: url,  
                        type: 'POST',
                        // Form data
                        //datos del formulario
                        data: formData,
                        //necesario para subir archivos via ajax
                        cache: false,
                        contentType: false,
                        processData: false,
                        //mientras enviamos el archivo
                        beforeSend: function(){
                            message = $("<span class='before'>Subiendo la imagen, por favor espere...</span>");
                            //showMessage(message)        
                        },
                        //una vez finalizado correctamente
                        success: function(data){
                            alert(data);
                            if(data == "1"){
                                alert("Usuario registrado con exito");
                                var url = "index.php"; 
                                $(location).attr('href',url);
                            }
                            else if(data == "2")
                                alert("No podemos registrar su usuario");
                            else
                                alert("Las contraseñas no coinciden");
                                message = $("<span class='success'>La imagen ha subido correctamente.</span>");
                        },
                        //si ha ocurrido un error
                        error: function(){
                            message = $("<span class='error'>Ha ocurrido un error.</span>");
                        }
                    });
                });

                $("#usuarioR").keyup(function(){
                    $("#avisoUsuario").show();
                   // alert($(this).val());
                    var usuario = $(":input[name='usuario']").val();
                    var token = $('meta[name="_token"]').attr('content');
                    var posting = $.post( "/verificar", {usuario: usuario, _token:token});
                    
    

                    posting.done(function( data ) {
                        if(data == "1"){    
                            $("#avisoUsuario").show().css("color","red").text("El nombre de usuario está ocupado");
                            
                        }
                        else if(data == "2"){
                             $("#avisoUsuario").show().css("color","green").text("El nombre de usuario está disponible");
                        }
                    });
                });

            });


        </script>
	</head>
	<body>
		<h1> Registro </h1>
		<form method="POST" action="/registrar" id="fmregistro" class="fmregistro" enctype="multipart/form-data">
            <span> Nombre de usuario </span><br>
			<input type="text" name="usuario" placeholder="Usuario" id="usuarioR" required> </input>
            <span id="avisoUsuario" style="display:none"> </span>
            <br>

            <span> Contraseña </span><br>
			<input type="password" name="pass" placeholder="Contraseña" required> </input> <br>

            <span> Repetir contraseña </span><br>
			<input type="password" name="pass2" placeholder="Repetir contraseña" required> </input> 
            <span id="avisoPass" style="display:none"> </span><br>
             Agregar una imagen: <input type="file" name="foto" id="foto"></input><br>
            <br>

			<input type="submit" value="Guardar cambios"> </input>
		</form>
		
       


	</body>
</html>
-->