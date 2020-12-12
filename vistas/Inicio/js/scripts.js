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


document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['dayGrid', 'interaction', 'timeGrid', 'list'],
        defaultView: 'timeGridDay',
        //defaultView: 'timeGridWeek',
        height: 'auto',
        minTime: '09:00:00',
        maxTime: '21:00:00',
        //editable: 'true',
        slotDuration: '01:00:00',
        allDay: 'false',
        hiddenDays: [0],
        allDaySlot: false,
        header: {
            //left: 'prev,next today',
            left: 'next today',
            center: 'title',
            //right: 'timeGridWeek,timeGridDay'
            right: 'timeGridDay'
        },

        events: 'http://localhost/PaginasWebs/ProyectoFinal/php/eventos.php',

        eventClick: function (info) {

        },

        dateClick: function (info) {
            $('#exampleModal').modal('show');
            console.log(info);
            console.log("Version: " + jQuery().jquery);

            var fecha = info.dateStr;
            var hora = info.dateStr.substring(11, 19);

            var day = info.date.toString();
            console.log(day);
            var dia = "Prueba";
            if (day.substring(0, 3) == "Mon") {
                dia = "Lunes";
            } else if (day.substring(0, 3) == "Tue") {
                dia = "Martes";
            } else if (day.substring(0, 3) == "Wed") {
                dia = "Miercoles";
            } else if (day.substring(0, 3) == "Thu") {
                dia = "Jueves";
            } else if (day.substring(0, 3) == "Fri") {
                dia = "Viernes";
            } else if (day.substring(0, 3) == "Sat") {
                dia = "Sábado";
            } else if (day.substring(0, 3) == "Sun") {
                dia = "Domingo";
            }

            $('#txt_fecha').val(fecha.substring(0, 10));
            $('#txt_hora').val(hora);
            $('#txt_dia').val(dia);

        }

    });

    calendar.setOption('locale', 'Es');
    calendar.render();

    $('#btn_agendar').click(function () {
        //recolectarDatos("POST");

        var ser = document.getElementById('txt_servicio');
        var servicio = ser.options[ser.selectedIndex].text;

        var bar = document.getElementById('txt_barber');
        var barber = bar.options[bar.selectedIndex].text;

        var NuevoEvento = {
            /*title: servicio + " - " + $('#txt_cliente').val(),
            date: $('#txt_fecha').val() + " " + $('#txt_hora').val(),
            barber: barber,*/
            dia: $('#txt_dia').val(),
            hora: $('#txt_hora').val(),
            fecha: $('#txt_fecha').val(),
            servicio: servicio,
            barber: barber,
            cliente: $('#txt_cliente').val()
        }

        console.log("Nuevo Evento recolectarRes: " + recolectarDatos());
        console.log("Nuevo Evento btnAgendar: " + NuevoEvento);
        recolectarDatos();
        enviarInformacion('agregar', NuevoEvento);


        //calendar.addEvent(NuevoEvento);
        //$('#exampleModal').modal('hide');

    });

    function recolectarDatos(method) {

        var ser = document.getElementById('txt_servicio');
        var servicio = ser.options[ser.selectedIndex].text;

        var bar = document.getElementById('txt_barber');
        var barber = bar.options[bar.selectedIndex].text;

        var NuevoEvento = {

            dia: $('#txt_dia').val(),
            hora: $('#txt_hora').val(),
            fecha: $('#txt_fecha').val(),
            servicio: servicio,
            barber: barber,
            cliente: $('#txt_cliente').val()

        }
        console.log(NuevoEvento);

        return NuevoEvento;
    }

    function enviarInformacion(accion, objEvento) {
        $.ajax({
            type: 'POST',
            url: '../../php/eventos.php?accion=' + accion,
            //url: '../../../php/eventos.php?accion='+accion,
            data: objEvento,
            success: function (msg) {
                if (msg) {
                    calendar.refetchEvents();
                    $('#exampleModal').modal('hide');
                }
            },
            error: function () {
                alert("Error en el registro");
            }
        });
    }

});

//VUE
/*var app = new Vue({
    el: '#app', // Elemento
    data: { // Parametros
        //all_data:[]
    },
    created: function(){
        console.log("Iniciando ...");
        this.get_contacts();
    },
    methods:{
        get_contacts: function(){
            //fetch("../../../php/eventos.php").then(response=>response.json()).then(json=>{this.all_data=json.eventos})
        },
        remove: function (index) {
            this.items.splice(index, 1);
        }
    }
});*/