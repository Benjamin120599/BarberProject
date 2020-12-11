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
        //defaultView: 'timeGridDay'
        defaultView: 'timeGridWeek',
        height: 'auto',
        minTime: '09:00:00',
        maxTime: '21:00:00',
        //editable: 'true',
        slotDuration: '01:00:00',
        allDay: 'false',
        hiddenDays: [0],
        allDaySlot: false,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'timeGridWeek,timeGridDay'
        },

        events: 'http://localhost/PaginasWebs/ProyectoFinal/php/eventos.php?accion=special',

        eventClick: function(info) {
            $('#exampleModal').modal('show');
        
            $('#txt_id').html('ID Evento: '+info.event.id);
            $('#txt_dia').val(info.event.extendedProps.dia);
            $('#txt_fecha').val(info.event.extendedProps.fecha);
            $('#txt_hora').val(info.event.extendedProps.hora);
            $('#txt_servicio').val(info.event.extendedProps.servicio);
            $('#txt_barber').val(info.event.extendedProps.barber);
            $('#txt_cliente').val(info.event.extendedProps.cliente);

        }, 
        editable: true,
        eventDrop: function(info) {
            /*console.log(info.event.title);
            console.log(info.event.start);
            console.log("IMPORTANTE: "+info.event.start.toString());
            console.log(info.event.start.getDate());
            console.log(info.event.extendedProps.fecha);
            alert(info.event.id);*/

            var arreglo = info.event.start.toString().split(" ");

            var dia;
            if (info.event.start.getDay() == 1) {
                dia = "Lunes";
            } else if (info.event.start.getDay() == 2) {
                dia = "Martes";
            } else if (info.event.start.getDay() == 3) {
                dia = "Miercoles";
            } else if (info.event.start.getDay() == 4) {
                dia = "Jueves";
            } else if (info.event.start.getDay() == 5) {
                dia = "Viernes";
            } else if (info.event.start.getDay() == 6) {
                dia = "Sábado";
            } else if (info.event.start.getDay() == 0) {
                dia = "Domingo";
            }

        
            var fecha = arreglo[3]+"-"+(info.event.start.getMonth()+1)+"-"+arreglo[2];
            var hora = arreglo[4];
            var id = info.event.id
            

            $('#txt_id').html(id);
            $('#txt_dia').val(dia);
            $('#txt_fecha').val(fecha);
            $('#txt_hora').val(hora);
            //$('#txt_servicio').val(info.event.extendedProps.servicio);
            //$('#txt_barber').val(info.event.extendedProps.barber);
            //$('#txt_servicio').val($('#songValue').outerText);
            $('#txt_cliente').val(info.event.extendedProps.cliente);
            document.getElementById("txt_servicio").value = info.event.extendedProps.servicio;
            document.getElementById("txt_barber").value = info.event.extendedProps.barber;

            
            enviarInformacion('modificar', recolectarDatos());

        }

    });

    calendar.setOption('locale', 'Es');
    calendar.render();

    $('#btn_eliminar').click(function () {
        //recolectarDatos("POST");

        var NuevoEvento = {
            id:$('#txt_id').html().substring(11),
            dia:$('#txt_dia').val(),
            hora:$('#txt_hora').val(),
            fecha:$('#txt_fecha').val(),
            servicio:$('#txt_servicio').val(),
            barber: $('#txt_barber').val(),
            cliente:$('#txt_cliente').val()

        }

        console.log('NE: '+NuevoEvento);
        enviarInformacion('eliminar', NuevoEvento);
    });

    /*$('#btn_modificar').click(function () {
        //recolectarDatos("POST");

        var ser = document.getElementById('txt_servicio');
        var servicio = ser.options[ser.selectedIndex].text;

        var bar = document.getElementById('txt_barber');
        var barber = bar.options[bar.selectedIndex].text;

        var NuevoEvento = {
            id:$('#txt_id').html().substring(11),
            dia:$('#txt_dia').val(),
            hora:$('#txt_hora').val(),
            fecha:$('#txt_fecha').val(),
            servicio:servicio,
            barber: barber,
            cliente:$('#txt_cliente').val()
        }

        console.log('NE: '+NuevoEvento);
        enviarInformacion('modificar', NuevoEvento);
    });*/



    function recolectarDatos(method) {

        var ser = document.getElementById('txt_servicio');
        var servicio = ser.options[ser.selectedIndex].text;

        var bar = document.getElementById('txt_barber');
        var barber = bar.options[bar.selectedIndex].text;

        var NuevoEvento = {
            id:$('#txt_id').html(),
            dia:$('#txt_dia').val(),
            hora:$('#txt_hora').val(),
            fecha:$('#txt_fecha').val(),
            servicio:servicio,
            barber: barber,
            cliente:$('#txt_cliente').val()
            
        }
        console.log(NuevoEvento);
        
        return NuevoEvento;
    }

    function enviarInformacion(accion, objEvento) {
        $.ajax({
            type:'POST',
            url:'../../php/eventos.php?accion='+accion,
            //url: '../../../php/eventos.php?accion='+accion,
            data: objEvento,
            success:function(msg){
                if(msg) {
                    calendar.refetchEvents();
                    $('#exampleModal').modal('hide');
                }
            },
            error: function() {
                alert("Error");
            }
        });
    }

});