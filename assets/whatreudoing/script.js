const x = {
    data() {
        return {
            //for register
            newNamaLengkap: null,
            newEmail: null,
            newPassword: null,

            //for login
            logEmail: null,
            logPassword: null
        }
    },
    created() {
        $(document).on('click', '.below button', function(){
            var belowCard = $('.below'),
            aboveCard = $('.above'),
            parent = $('.form-collection')
            parent.addClass('animation-state-1')
            setTimeout(function(){
                belowCard.removeClass('below')
                aboveCard.removeClass('above')
                belowCard.addClass('above')
                aboveCard.addClass('below')
                setTimeout(function(){
                parent.addClass('animation-state-finish')
                parent.removeClass('animation-state-1')
                setTimeout(function(){
                    aboveCard.addClass('turned')
                    belowCard.removeClass('turned')
                    parent.removeClass('animation-state-finish')
                }, 300)
                }, 10)
            }, 300)
        })
    },
    mounted() {
        
    },
    methods: {
        //0: daftar | 1: login
        daftar(){
            if(this.newNamaLengkap == null || this.newNamaLengkap == '' ||
            this.newEmail == null || this.newEmail == '' ||
            this.newPassword == null || this.newPassword == ''){
                return false
            }
            $.ajax({
                type: "POST",
                url: "./assets/core/sys/action.php",
                data: "key=31337&action=0&newNamaLengkap="+app.newNamaLengkap+
                    "&newEmail="+app.newEmail+
                    "&newPassword="+app.newPassword,
                success: function(res){
                    switch (res) {
                        case 'ok':
                            app.$buefy.toast.open({
                                message: 'Register Berhasil! 😄',
                                type: 'is-success'
                            })
                            setTimeout(function() {
                                app.newNamaLengkap = null
                                app.newEmail = null
                                app.newPassword = null
                                $('.login-btn').click()
                            }, 2000)
                            break;

                        case 'emailexist':
                            app.$buefy.toast.open({
                                message: 'Email sudah terdaftar anjay mabar slur! 👊😎',
                                type: 'is-white'
                            })
                            break;
                    }
                }
            })
        },
        masuk(){
            if(this.logEmail == null || this.logEmail == '' ||
            this.logPassword == null || this.logPassword == ''){
                return false
            }
        },
        lupaPassword(event){
            event.preventDefault()
            this.$buefy.toast.open({
                message: 'Fitur ini masih di matikan lur 🤐',
                type: 'is-light'
            })
        }
    }
}

const app = new Vue(x)
app.$mount('#app')