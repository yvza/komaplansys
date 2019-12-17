const x = {
    data() {
        return {
            //self info
            nama: null,
            //schedule
            list: [],
            //store drag and drop
            startDate: null,
            endDate: null
        }
    },
    mounted() {
        $.ajax({
            type: 'GET',
            url: '../assets/panel/sys/dashboard.php?get=allinfo',
            success: function(res){
                let json = JSON.parse(res)
                app.nama = json[0].NAMA
                app.list = json[1]
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
                    selectable: true,
                    eventLimit: true,
                    eventDrop: function(info) {
                        function standart(dateobject){ //date manipulation
                            function pad(n){return n<10 ? '0'+n : n}
                            return pad(dateobject.getFullYear())+"-"+
                            pad(dateobject.getMonth()+1)+"-"+
                            pad(dateobject.getDate())
                        }
                        app.startDate = standart(info.event.start),
                        app.endDate = standart(info.event.end)
                        let title = info.event.title
                        app.$buefy.dialog.confirm({
                            message: 'Yakin anda merubah tanggal schedule?',
                            onConfirm: () => $.ajax({
                                type: "POST",
                                data: "title="+title+
                                "&startDate="+app.startDate+
                                "&endDate="+app.endDate,
                                url: "../assets/panel/sys/dashboard.php?moving=schedule",
                                success: function(res){
                                    if(res === 'ok'){
                                        app.$buefy.toast.open({
                                            message: 'Berhasil mengubah acara ✨',
                                            type: 'is-success'
                                        })
                                    }
                                }
                            }),
                            onCancel: () => info.revert()
                        })
                    },
                    events: app.list
                })
                calendar.render()
            }
        })

        $(".navbar-burger").click(function() {
            $("#navbarBasicExample").slideToggle()
            $(".navbar-burger").toggleClass("is-active")
            $(".navbar-menu").toggleClass("is-active")
        })
    },
    methods: {
        keluar(event){
            event.preventDefault()
            $.ajax({
                type: 'GET',
                url: './dashboard.php?keluar=y',
                success: function(){
                    window.location.href = '../whatreudoing.php'
                }
            })
        }
    }
}

const app = new Vue(x)
app.$mount('#app')