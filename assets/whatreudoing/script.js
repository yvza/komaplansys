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
                app.$buefy.toast.open({
                    message: 'Ngisi yang bener lah babi 😡',
                    type: 'is-danger'
                })
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
                                message: 'Register Berhasil, Silahkan Login Untuk Mengakses Aplikasi! 😄',
                                duration: 3000,
                                type: 'is-success'
                            })
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
        }
    }
}

const app = new Vue(x)
app.$mount('#app')