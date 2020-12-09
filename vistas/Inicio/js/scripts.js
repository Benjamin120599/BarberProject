/*!
    * Start Bootstrap - SB Admin v6.0.2 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2020 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    (function($) {
    "use strict";

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
        $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
            if (this.href === path) {
                $(this).addClass("active");
            }
        });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function(e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });
})(jQuery);


document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['dayGrid', 'interaction', 'timeGrid', 'list'],
        //defaultView: 'timeGridDay'
        defaultView: 'timeGridWeek',
        height: 'auto',
        minTime: '09:00:00',
        maxTime: '21:00:00',
        editable: 'true',
        slotDuration: '01:00:00',
        allDay: 'false',
        hiddenDays: [0],
        allDaySlot: false,
        header: {
            left: 'prev,next today Miboton',
            center: 'title',
            //right: 'dayGridMonth,timeGridWeek,timeGridDay'
            right: 'timeGridWeek,timeGridDay'
        },
        /*customButtons: {
            Miboton: {
                text: "Botón",
                click: function() {
                    alert("Hola mundo");
                }
            }
        },

        businessHours: [ // specify an array instead
            {
                daysOfWeek: [1, 2, 3, 4, 5], // Monday, Tuesday, Wednesday
                startTime: '09:00', // 8am
                endTime: '21:00' // 6pm
            },
            {
                daysOfWeek: [6,0], // Thursday, Friday
                startTime: '10:00', // 10am
                endTime: '16:00' // 4pm
            }
        ],*/

        dateClick: function(info) {
            $('#exampleModal').modal('show');
            console.log(info);

            var fecha = info.dateStr;
            var hora = info.dateStr.substring(11, 19);

            var day = info.date.toString();
            console.log(day);
            var dia = "Prueba";
            if(day.substring(0,3)== "Mon") {
                dia = "Lunes";
            } else if(day.substring(0,3) == "Tue") {
                dia = "Martes";
            } else if(day.substring(0,3) == "Wed") {
                dia = "Miercoles";
            } else if(day.substring(0,3) == "Thu") {
                dia = "Jueves";
            } else if(day.substring(0,3) == "Fri") {
                dia = "Viernes";
            } else if(day.substring(0,3) == "Sat") {
                dia = "Sábado";
            } else if(day.substring(0,3) == "Sun") {
                dia = "Domingo";
            }

            

            $('#txt_fecha').val(fecha.substring(0, 10));
            $('#txt_hora').val(hora);
            $('#txt_dia').val(dia);

            /*calendar.addEvent({
                title: "Evento",
                date: info.dateStr
            });*/
        }
        /*eventClick: function(info) {
            console.log(info);
            console.log(info.event.title);
            console.log(info.event.start);
            console.log(info.event.end);
            console.log(info.event.backgroundColor);
            console.log(info.event.textColor);
            console.log(info.event.extendedProps.descripcion);
        }
        
        events: [{
                title: "Navidad",
                start: "2020-12-24 19:00:00",
                end: "2020-12-25 03:00:00",
                descripcion: "Descripcion evento 1"
            },
            {
                title: "Año nuevo",
                start: "2020-12-31 19:00:00",
                end: "2021-01-01 03:00:00",
                color: "#46231be6",
                textColor: "#ffffff",
                descripcion: "Descripcion evento 1"
            }
        ]*/

    });

    calendar.setOption('locale', 'Es');
    calendar.render();

    $('#btn_agendar').click(function(){
        var objEvento = recolectarDatos("POST");
        enviarInformacion('', objEvento);
    });
    
    function recolectarDatos(method) {
    
        var ser = document.getElementById('txt_servicio');
        var servicio = ser.options[ser.selectedIndex].text;
    
        var bar = document.getElementById('txt_barber');
        var barber = bar.options[bar.selectedIndex].text;
    
        nuevoEvento={
            dia:$('#txt_dia').val(),
            hora:$('#txt_hora').val(),
            fecha:$('#txt_fecha').val(),
            servicio:servicio,
            barber:barber,
            cliente:$('#txt_cliente').val()
        }
        console.log(nuevoEvento);
        return nuevoEvento;
    }

    function enviarInformacion(accion, objEvent) {
        $.ajax(
            {
                type:"POST",
                url:"{{url('')}}"+accion,
                data:objEvent,
                success:function(msg){console.log(msg);},
                error:function(){alert("No se pudo registrar");} 
            }
        );
    }

});



