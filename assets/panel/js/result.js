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
        
    }
}

const app = new Vue(x)
app.$mount('#app')