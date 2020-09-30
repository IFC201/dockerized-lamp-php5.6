// ready(): su funcionalidad es la de ejecutar funciones una vez cargada en su totalidad una página web (DOM).
$(document).ready(function() {
    // Dónde $("selector=id/class/etiqueta").funcion_a_ejecutar
    $("#navbar-auto-ocultar").autoHidingNavbar();
    $(".button-mobile-menu").click(function(){
        $("#mobile-menu-list").animate({width: 'toggle'},200);
    });	
    $('.all-elements-tooltip').tooltip('hide');

    /* Función para preguntar y cerrar sesión (En <a>) */ // $(selector).metodo(event,function(parámetro))
    $('.exit-system').on('click', function(e){
        e.preventDefault(); // Evita que un enlace abra la URL #!
        swal({ // Opciones
            title: "¿Quieres salir del sistema?",   
            text: "Estas seguro que quieres cerrar la sesión actual y salir del sistema",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#16a085",   
            confirmButtonText: "Si, salir",
            cancelButtonText: "No, cancelar",
            closeOnConfirm: false,
            animation: "slide-from-top",
            allowOutsideClick: true
            }, // Cierra sesión
            function(){window.location='process/logout.php';
        });
    });

    /* Función para preguntar y borrar carrito (En <a>) */
    $('.vaciar-carrito').on('click', function(e){
        e.preventDefault(); // Evita que un enlace abra la URL #!
        swal({ // Opciones
            title: "¿Quieres vaciar el carrito?",   
            text: "Los productos añadidos al carrito se borrarán",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#16a085",   
            confirmButtonText: "Si, borrar",
            cancelButtonText: "No, cancelar",
            closeOnConfirm: false,
            animation: "slide-from-top",
            allowOutsideClick: true
            }, // Vacía el carrito
            function(){window.location='process/vaciarcarrito.php';
        });
    });

    /* Función para enviar datos de formularios con ajax (En <form> -> <button>) */
    $('.FormEnviar').submit(function(e){
        e.preventDefault();
        var StatusInfo='<div class="content-send-form"></div>';
        var formType=$(this).attr('data-form');
        var form=$(this);
        var formdata=false;
        if (window.FormData){
            formdata = new FormData(form[0]);
        }
        var formAction = form.attr('action');
        var metodo=form.attr('method');

        /* Si el formulario es de tipo "login" */
        if(formType=="login"){
            $.ajax({
                type: metodo,
                url: formAction,
                data: formdata ? formdata : form.serialize(),
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $(".ResFormL").html('Iniciando sesión...');
                },
                error: function() {
                    $(".ResFormL").html("Ha ocurrido un error en el sistema");
                },
                success: function (data) {
                    $(".ResFormL").html(data);
                }
            });
            return false;
        /* Si no lo es, será de tipo confirmar */
        }else{
            swal({
                title: "¿Estás seguro?",   
                text: "Quieres realizar la operación solicitada, una vez realizada la operación no se podrá revertir",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#16a085",   
                confirmButtonText: "Si, realizar",
                cancelButtonText: "No, cancelar",
                closeOnConfirm: false,
                animation: "slide-from-top",
                allowOutsideClick: true
            }, function(){
                $.ajax({
                    xhr: function(){
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                          if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);
                            $('.content-send-form').html('<p class="text-center" style="padding-top: 10px;">Procesando... ('+percentComplete+'%)</p><div class="progress progress-striped active"><div class="progress-bar" style="width: '+percentComplete+'%"></div></div>');
                          }
                        }, false);
                        return xhr;
                    },
                    type: metodo,
                    url: formAction,
                    data: formdata ? formdata : form.serialize(),
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function(){
                        $(".ResbeforeSend").html(StatusInfo);
                    },
                    error: function() {
                        $(".ResbeforeSend").html("Ha ocurrido un error en el sistema");
                    },
                    success: function (data) {
                        $(".ResbeforeSend").html(data);
                    }
                });
                return false;
            });
        }
    });
});
