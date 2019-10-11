document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar')
    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
        timeZone: 'UTC',
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        editable: true,
        eventLimit: true,
        dateClick: function(info) {
            alert('Clicked on: ' + info.dateStr);
            alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
            alert('Current view: ' + info.view.type);
        }
    })
    calendar.render()

    $(".navbar-burger").click(function() {
        $("#navbarBasicExample").slideToggle()
        $(".navbar-burger").toggleClass("is-active")
        $(".navbar-menu").toggleClass("is-active")
    })
})