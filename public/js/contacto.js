/*************************************************************************************************************************
*Funciones formatter:Permiten cambiar el contenido de una celda, agregando nuevos elementos
*Parametros: value=> parametro que se recibe al momento de asignarle un valor al arreglo en el ciclo principal
/*************************************************************************************************************************/

function buttonFormatter(row,cell,value,columnDef,dataContext){  
    var button = '<button value = "'+value+'" onclick = "eliminar(this)" class = "borrar"> Eliminar contacto </button>';
    return button;
}

function imagenFormatter(row,cell,value,columnDef,dataContext){
    var img = '<img src = "'+value+'" style = " height: 60px; width: 60px "> </img>';
    return img;
}

/*************************************************************************************************************************
*Funcion imprimeTablaSlick():Usando un objeto json, imprime la tabla de contactos usando el plugin slickgrid
*Parametros: json [resultado de la busqueda de contactos]
/*************************************************************************************************************************/
function imprimeTablaSlick(json){
     var grid;
     var columns = [
        { id: "nombre", name: "Nombre", field: "nombre", sortable: true },
        { id: "email", name: "Correo", field: "email", sortable: true },
        { id: "tel", name: "Teléfono", field: "tel", sortable: true },
        { id: "cel", name: "Celular", field: "cel", sortable: true },
        { id: "fotoContacto", name: "Foto", field: "fotoContacto", formatter: imagenFormatter, sortable: false },
        { id: "eliminar", name: "Eliminar contacto", field: "eliminar", formatter: buttonFormatter, sortable: false },
    ];
    
    var options = {
        enableCellNavigation: true,
        enableColumnReorder: false,
        multiColumnSort: true,
        autoHeight: true
    };


    var data = [];
    $.each(json, function(i, contacto)  {
        data[i] = {
            nombre: contacto.nombre,
            email: contacto.email,
            tel: contacto.tel,
            cel: contacto.cel,
            fotoContacto: contacto.fotoContacto,
            eliminar: contacto.idContacto
        };
    })
    grid = new Slick.Grid("#myGrid", data, columns, options);
    grid.onSort.subscribe(function (e, args) {
        var cols = args.sortCols;
        data.sort(function (dataRow1, dataRow2) {
            for (var i = 0, l = cols.length; i < l; i++) {
                var field = cols[i].sortCol.field;
                var sign = cols[i].sortAsc ? 1 : -1;
                var value1 = dataRow1[field], value2 = dataRow2[field];
                var result = (value1 == value2 ? 0 : (value1 > value2 ? 1 : -1)) * sign;
                if (result != 0) {
                    return result;
                }
            }   
            return 0;
        });
        grid.invalidate();
        grid.render();
    });
}

/*************************************************************************************************************************
*Funcion busqueda():realiza una peticion ajax con el metodo get para mostrar los contactos que cumplan con los criterios 
*                   especificados en la busqueda
/*************************************************************************************************************************/
function busqueda(){

    //Borrar las dos tablas
    $('#respuesta').empty();
    $("#myGrid").empty();

    var busqueda = $(":input[name='busqueda']").val();
    var categoria = $("input[name='categoria']:checked").val();

    if(busqueda=='') //Si no hay nada escrito en el campo de busqueda, no se realiza la peticion
        return 0;
        
    $.getJSON( "/contactos", {busqueda:busqueda, categoria:categoria, peticion: "buscar"} )
    .done(function( json ) {
        $('#respuesta').empty();

       if( $.isEmptyObject(json) ){
            $("#respuesta").addClass( "alert alert-danger" ).text("No existen coincidencias para esa búsqueda");
       }

       else{
            if($( "#respuesta" ).hasClass( "alert alert-danger" ))
                $("#respuesta").removeClass( "alert alert-danger" );

            var $tbl;
            var tr="";

            $.each(json, function(i, contacto) {
                if(i==0){
                    
                    tr = tr + '<tr style="border: 1px solid grey">'+
                    '<td>Nombre</td>'+
                    '<td>Email</td>'+
                    '<td>Telefono</td>'+
                    '<td>Celular</td>'+
                    '<td>Direccion</td>'+
                    '<td>Imagen</td>'+
                    '<td>Eliminar contacto</td></tr>';
                }

                tr = tr + '<tr style="border: 1px solid grey">'+
                    '<td>'+contacto.nombre+'</td>'+
                    '<td>'+contacto.email+'</td>'+
                    '<td>'+contacto.tel+'</td>'+
                    '<td>'+contacto.cel+'</td>'+
                    '<td>'+contacto.direccion+'</td>'+
                    '<td><img src = "'+contacto.fotoContacto+'" style = " height: 60px; width: 60px "> </img></td>'+
                    '<td><button value = "'+contacto.idContacto+' " onclick = "eliminar(this)" class = "borrar"> Eliminar contacto </button></td></tr>';
            });

            $("#respuesta").show().html(tr);

            //imprime la tabla tambien en slick
            imprimeTablaSlick(json);
       }
    })
    .fail(function( jqxhr, textStatus, error ) {
        var err = textStatus + ", " + error;
        console.log( "Request Failed: " + err );
    });
}

/*************************************************************************************************************************
*Funcion busqueda():realiza una peticion ajax con el metodo post para eliminar el contacto al que se le hizo clic
*Parametros: btn-> es el boton corresponiente al contacto que se quiere eliminar
/*************************************************************************************************************************/
function eliminar(btn){
    var valor = btn.value;
    var mensaje = confirm("¿Está seguro que desea eliminar este contacto?");
    var token = $('meta[name="_token"]').attr('content');
    if (mensaje) {
        var posting = $.post( "/contactos/eliminar", {valor: valor, peticion: "eliminar", _token:token});
        posting.done(function( data ) {
            $('#respuesta').empty();
            $("#myGrid").empty();
            //alert(data);
           // busqueda();
        });
     //$(btn).parent('tr').fadeOut();
    }            
}

/*************************************************************************************************************************
*Funcion agragar():realiza una peticion ajax con el metodo post agregar un nuevo contacto, junto con una 
*                  foto para identificarlo
*Parametros: event->objeto que configura el comportamiento del submit
/*************************************************************************************************************************/
function agregar(event){
    event.preventDefault();
    
    var formData = new FormData($(".fmAddCont")[0]);
    formData.append("peticion","agregar");

     var token = $('meta[name="_token"]').attr('content');
     formData.append("_token",token);

    $.ajax({
        url: 'contactos/agregar',  
        type: 'POST',
        //datos del formulario
        data: formData,
        //necesario para subir archivos via ajax
        cache: false,
        contentType: false,
        processData: false,
        //mientras enviamos el archivo
        beforeSend: function(){
            message = $("<span class='before'>Subiendo la imagen, por favor espere...</span>");
            showMessage(message);
        },
        //una vez finalizado correctamente
        success: function(data){
            //alert(data);
            busqueda();

            //limpiar el formulario
            $( ":input[name='nombre']" ).val("");
            $( ":input[name='tel']" ).val("");
            $( ":input[name='cel']" ).val("");
            $( ":input[name='dir']" ).val("");
            $( ":input[name='email']" ).val("");
        
            $("#fmAgregar").hide();
            message = $("<span class='success'>La imagen ha subido correctamente.</span>");
            showMessage(message);
             $(location).attr('href','/home');
        },
        //si ha ocurrido un error
        error: function(){
            message = $("<span class='error'>Ha ocurrido un error.</span>");
            showMessage(message);
        }
    });
}

function showMessage(message){
    $(".messages").html("").show();
    $(".messages").html(message);
}


 /* var $tr = $('<tr>').append(
                $('<td>').text(contacto.nombre),
                $('<td>').text(contacto.email),
                $('<td>').text(contacto.tel),
                $('<td>').text(contacto.cel),
                $('<td>').text(contacto.direccion),
                $('<td>').append($('<img>').attr('src',contacto.fotoContacto)
                                           .css('height','60px')
                                           .css('width', '60px')),
                $('<td>').append($('<button>').val(contacto.idContacto)
                                              .attr('onclick', 'eliminar(this)')
                                              .attr('class', 'borrar')
                                              .text("Eliminar contacto"))
            ).css('border', '1px solid black');*/
          /*  var $encabezado = $('<tr>').append(
                $('<th>').text('Nombre'),
                $('<td>').text('Email'),
                $('<td>').text('Telefono'),
                $('<td>').text('Celular'),
                $('<td>').text('Direccion'),
                $('<td>').text('Foto'),
                $('<td>').text('Eliminar contacto'));*/

       // var $tbl = $encabezado.appendTo('#respuesta');    
         //   $tbl = $tr.appendTo('#respuesta');
           // console.log($tr.wrap('<p>').html());
