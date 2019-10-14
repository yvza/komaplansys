const x = {
    data() {
        return {
            data: []
        }
    },
    mounted() {
        $(".navbar-burger").click(function() {
            $("#navbarBasicExample").slideToggle()
            $(".navbar-burger").toggleClass("is-active")
            $(".navbar-menu").toggleClass("is-active")
        })


        $.ajax({
            type: "GET",
            url: "../assets/panel/sys/result.php",
            success: function(res){
                let json = JSON.parse(res)
                app.data = json

                am4core.ready(function() {
                    // Themes begin
                    am4core.useTheme(am4themes_animated);
                    // Themes end
                    var chart = am4core.create("chartdiv", am4charts.PieChart3D);
                    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
                    chart.legend = new am4charts.Legend();
                    chart.data = [
                    {
                        country: "Sesuai Rencana",
                        litres: app.data[2].TOTAL
                    },
                    {
                        country: "Puas",
                        litres: app.data[1].TOTAL
                    },
                    {
                        country: "Gagal",
                        litres: app.data[0].TOTAL
                    }
                    ];
                    var series = chart.series.push(new am4charts.PieSeries3D());
                    series.dataFields.value = "litres";
                    series.dataFields.category = "country";
                }); // end am4core.ready()
            }
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