@extends('layout')
@section('container')
<div>
   "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
</div>
@endsection


<!--<html>
    <head>
        <meta charset="UTF-8">
        <title> Página de prueba </title>
        <meta name="description" content="Página de prueba para uso de jquery y php">
        <meta name="keywords" content="HTML5, PHP, Jquery">
        <meta name="_token" content="{{ csrf_token() }}">
        <Link rel="stylesheet href="default.css"
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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

                /*************************************************************************************/


                $(document).on("keyup",".busqueda", busqueda);
                $(document).on("click", ".rbCategoria", busqueda);
                $(document).on("submit", ".fmAddCont", agregar);
                $(document).on("submit", ".fmEditar", editarPerfil);
                $(document).on('click', '.borrar', function (event) {
                    event.preventDefault();
                    $(this).closest('tr').fadeOut();
                });

                //$(document).on("click", "#agregar", busqueda);

                //$("#busqueda").keyup(busqueda);
                //$(".rbCategoria").click(busqueda);
               /* $("#agregar").click(function(){
                    showMessage("");
                    $("#fmAgregar").show();
                });*/
               // $(".fmAddCont").submit(agregar);
            });
        </script>
    </head>
    <body>
        <?php
           // session_start(); 
           // if(!isset($_SESSION['logged_in']))
            //    header("Location: index.php");  
        ?>

        <div>
            <header>
                <h1> Bienvenido(a) {{session('usuario')}}</h1> 
            <?php
                    //echo "<img src='".$_SESSION['foto']."' style='height: 100px; width:100px;'></img>";
                ?>  
                <h2> Agenda electrónica </h2> 
            </header>
            <nav>
                <ul>
                    <li> Contactos <ul>
                        <li id="mostrarContent"> Buscar contactos </li>
                        <li id="agregarCont"> Agregar contactos </li>
                    </ul></li>
                    <li id="editarPerfil"> Editar perfil </li>
                    <li id="cerrarSesion"> Cerrar sesión </li>
                    <li> Otras cosas </li>
                </ul>
            </nav>
            <main>
                <section>
                    <p> Contenido </p>
                    <div id="content">

                    </div>
                </section>
                <aside>
                    Alguna información extra
                </aside>
            </main>
            <footer>
                Elaborado por: Saul Mendoza
            </footer>
        </div>
    </body>
</html>-->