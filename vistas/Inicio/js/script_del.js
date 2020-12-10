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

    function recolectarDatos(method) {

        var ser = document.getElementById('txt_servicio');
        var servicio = ser.options[ser.selectedIndex].text;

        var bar = document.getElementById('txt_barber');
        var barber = bar.options[bar.selectedIndex].text;

        var NuevoEvento = {
            id:$('#txt_dia').val(),
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
                alert("Error en el registro");
            }
        });
    }

});