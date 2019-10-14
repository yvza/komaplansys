const x = {
    data() {
        return {
            //self info
            nama: null
        }
    },
    created() {
        //get user info
        $.ajax({
            type: 'GET',
            url: '../assets/panel/sys/dashboard.php?get=userinfo',
            success: function(res){
                let json = JSON.parse(res)
                app.nama = json.NAMA
            }
        })
    },
    mounted() {
        var calendarEl = document.getElementById('calendar')
        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
            timeZone: 'UTC',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay' //dayGridMonth,timeGridWeek,timeGridDay
            },
            editable: true,
            eventLimit: true,
            dateClick: function(info) {
                alert('Clicked on: ' + info.dateStr);
                alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                alert('Current view: ' + info.view.type);
            },
            events: [
                { // this object will be "parsed" into an Event Object
                    title: 'Tessss', // a property!
                    start: '2019-10-05', // a property!
                    end: '2019-10-16' // a property! ** see important note below about 'end' **
                }
            ]
        })
        calendar.render()

        $(".navbar-burger").click(function() {
            $("#navbarBasicExample").slideToggle()
            $(".navbar-burger").toggleClass("is-active")
            $(".navbar-menu").toggleClass("is-active")
        })
    },
    methods: {
        
    }
}

const app = new Vue(x)
app.$mount('#app')