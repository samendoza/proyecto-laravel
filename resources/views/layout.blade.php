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
    <!--Slick grid-->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="slick/slick.grid.css" type="text/css"/>
    <link rel="stylesheet" href="slick/css/smoothness/jquery-ui-1.8.16.custom.css" type="text/css"/>
    <link rel="stylesheet" href="css/example.css" type="text/css"/>
    <!--<link rel="stylesheet" href="examples.css" type="text/css"/>-->

    <script src="slick/lib/jquery.event.drag-2.2.js"></script>
    <script src="slick/slick.core.js"></script>
    <script src="slick/slick.grid.js"></script>


    <!-- fin slick grid -->



    <title> Agenda electronica </title>

     <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    
    <script src="js/contacto.js"></script>
    <script src="js/perfil.js"></script>
    <script>
        $(document).ready(function(){
            
           

            $("#cerrarSesion").click(function(){
                alert("Salir sesion");
                $(location).attr('href',"/logout");
            });

            $("#editarPerfil").click(function(){
                //$(location).attr('href',"editar.php");
                $("#content").empty();
                $("#content").load("editarPerfil.html");
            });

            $("#mostrarContent").click(function(){
                $("#content").empty();
                $("#content").load("cont.html");
            });

            $("#agregarCont").click(function(){
                $("#content").empty();
                $("#content").load("addContac.html");
            });

            $("#fmEditar").submit(editarPerfil);
            /*************************************************************************************/


            $(document).on("keyup",".busqueda", busqueda);
            $(document).on("click", ".rbCategoria", busqueda);
            $(document).on("submit", ".fmAddCont", agregar);
            $(document).on('click', '.borrar', function (event) {
                event.preventDefault();
                $(this).closest('tr').fadeOut();
            });

            var posting = $.get( "/imagen", {});
            posting.done(function( data ) {
                $("#imgPerfil").attr("src", data);
            });

        });
    </script>
  </head>

  <body>
    <?php
      session_start();
      if(!isset($_SESSION['login']))
        header('Location : /');
    ?>
    <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Agenda electrónica</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li ><a href="/home">Home</a></li><!--class="active" -->
            <li><a href="/busqueda">Buscar contactos</a></li>
            <li><a href="/adicion">Agregar contactos</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">

          

           <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Perfil<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="/edicion">Editar perfil </a></li>
                <li role="separator" class="divider"></li>
                <li><a href="/logout">Cerrar sesión</a></li>
              </ul>
            </li>
           <li class="dropdown"> <a href="#"><img id="imgPerfil" style="height: 30px; width: 30px"></img></a> </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


    <div class="container">
       
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">

        @yield('container')
  
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>
