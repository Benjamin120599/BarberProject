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
                return fetch("../../php/Barberos/consultar_barberos.php").then(response => response.json()).then(json => {
                    this.items = json.barberos
                })
            },
            eliminar: function (id, item) {
                console.log("ID: "+id);
                this.items.splice(item, 1);
                var newBarber = {
                    id: id
                }
                enviarInformacion('eliminar', newBarber);
            },

            abrirModal: function(id, name, pap, sap, tel, calle, num, col, city, email) {
                $('#exampleModal2').modal('show');
                $('#txt_idM').html(id);
                $('#txt_nombreM').val(name);
                $('#txt_papM').val(pap);
                $('#txt_sapM').val(sap);
                $('#txt_telM').val(tel);
                $('#txt_calleM').val(calle);
                $('#txt_numM').val(num);
                $('#txt_colM').val(col);
                $('#txt_cityM').val(city);
                $('#txt_emailM').val(email);
            },
            modificar: function () {

                var newBarber = {
                    id: $('#txt_idM').html(),
                    name: $('#txt_nombreM').val(),
                    pap: $('#txt_papM').val(),
                    sap: $('#txt_sapM').val(),
                    tel: $('#txt_telM').val(),
                    calle: $('#txt_calleM').val(),
                    num: $('#txt_numM').val(),
                    col: $('#txt_colM').val(),
                    city: $('#txt_cityM').val(),
                    email: $('#txt_emailM').val()
                }

                $('#exampleModal2').modal('hide');
                console.log(newBarber);
                enviarInformacion('modificar', newBarber);
            }
        }

    });

    $('#btn_modificar').click(function () {
        var newBarber = {
            id: $('#txt_idM').html(),
            name: $('#txt_nombreM').val(),
            pap: $('#txt_papM').val(),
            sap: $('#txt_sapM').val(),
            tel: $('#txt_telM').val(),
            calle: $('#txt_calleM').val(),
            num: $('#txt_numM').val(),
            col: $('#txt_colM').val(),
            city: $('#txt_cityM').val(),
            email: $('#txt_emailM').val()
        }

        $('#exampleModal2').modal('hide');
        console.log(newBarber);
        enviarInformacion('modificar', newBarber);
    });

    $('#btn_agregar').click(function () {

        var newBarber = {

            name: $('#txt_nombre').val(),
            pap: $('#txt_pap').val(),
            sap: $('#txt_sap').val(),
            tel: $('#txt_tel').val(),
            calle: $('#txt_calle').val(),
            num: $('#txt_num').val(),
            col: $('#txt_col').val(),
            city: $('#txt_city').val(),
            email: $('#txt_email').val()
        }

        console.log("Nuevo Evento: " + newBarber);
        enviarInformacion('agregar', newBarber);

    });

    function enviarInformacion(accion, objEvento) {
        $.ajax({
            type: 'POST',
            url: '../..//php/Barberos/consultar_barberos.php?accion=' + accion,
            data: objEvento,
            success: function (msg) {
                if (msg) {
                    //app.refetchItems();
                    window.location.href = 'agregar_personal.php';
                    $('#exampleModal').modal('hide');
                }
            },
            error: function () {
                alert("Error");
            }
        });
    }
});