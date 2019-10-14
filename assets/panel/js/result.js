const x = {
    data() {
        return {
            
        }
    },
    mounted() {
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