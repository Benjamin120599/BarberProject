/*!
 * Start Bootstrap - SB Admin v6.0.2 (https://startbootstrap.com/template/sb-admin)
 * Copyright 2013-2020 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
 */
(function ($) {
    "use strict";

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
    $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function () {
        if (this.href === path) {
            $(this).addClass("active");
        }
    });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function (e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });
})(jQuery);

//VUE

document.addEventListener('DOMContentLoaded', function () {

    var app = new Vue({
        el: '#app', // Elemento
        data: { // Parametros
            items: []
        },
        created: function () {
            console.log("Iniciando ...");
            console.log("CONTACTOS: " + this.get_contacts);
            this.get_contacts();
        },
        methods: {
            get_contacts: async function () {
                return fetch("../../php/Servicios/consultar_servicios.php").then(response => response.json()).then(json => {
                    this.items = json.servicios
                })
            },
            eliminar: function (id, item) {
                console.log("ID: "+id);
                this.items.splice(item, 1);
                var newService = {
                    id: id
                }
                enviarInformacion('eliminar', newService);
            },

            abrirModal: function(id, tipo, precio) {
                $('#exampleModal2').modal('show');
                $('#txt_idM').html(id);
                $('#txt_nombreM').val(tipo);
                $('#txt_precioM').val(precio);
            },
            modificar: function () {

                var newService = {
                    id: $('#txt_idM').html(),
                    tipo: $('#txt_nombreM').val(),
                    precio: $('#txt_precioM').val()
                }

                $('#exampleModal2').modal('hide');
                enviarInformacion('modificar', newService);
            }
        }

    });

    $('#btn_modificar').click(function () {
        var newService = {
            id: $('#txt_idM').html(),
            tipo: $('#txt_nombreM').val(),
            precio: $('#txt_precioM').val()
        }

        $('#exampleModal2').modal('hide');
        enviarInformacion('modificar', newService);
    });

    $('#btn_agregar').click(function () {

        var newService = {
            tipo: $('#txt_nombre').val(),
            precio: $('#txt_precio').val()
        }
        enviarInformacion('agregar', newService);

    });

    function enviarInformacion(accion, objEvento) {
        $.ajax({
            type: 'POST',
            url: '../../php/Servicios/consultar_servicios.php?accion=' + accion,
            data: objEvento,
            success: function (msg) {
                if (msg) {
                    //app.refetchItems();
                    window.location.href = 'agregar_servicio.php';
                    $('#exampleModal').modal('hide');
                }
            },
            error: function () {
                alert("Error");
            }
        });
    }
});