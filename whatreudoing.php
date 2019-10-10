<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="koma plan sys, kolompok lima planning system" name="keywords">
    <meta content="Adalah Aplikasi Todo-List yang dibangun dengan Vue.js dan Oracle untuk memenuhi tugas Praktek Rekayasa Perangkat Lunak" name="description">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hey Whatsup!</title>
    <link rel="stylesheet" href="./assets/whatreudoing/style.css">
</head>
<body>
    <div class="form-collection" id="app">
        <div class="card elevation-3 limit-width log-in-card below turned">
            <div class="card-body">
                <div class="input-group email">
                    <input v-model="logEmail" type="text" placeholder="Email"/>
                </div>
                    <div class="input-group password">
                        <input v-model="logPassword" type="password" placeholder="Password"/>
                    </div>
                    <a href="!#" class="box-btn">Lupa Password?</a>
                </div>
                <div class="card-footer">
                    <button type="submit" class="login-btn">MASUK</button>
                </div>
            </div>

            <div class="card elevation-2 limit-width sign-up-card above">
                <div class="card-body">
                    <div class="input-group fullname">
                        <input v-model="newNamaLengkap" type="text" placeholder="Nama Lengkap"/>
                    </div>
                    <div class="input-group email">
                        <input v-model="newEmail" type="email" placeholder="Email"/>
                    </div>
                    <div class="input-group password">
                        <input v-model="newPassword" type="password" placeholder="Password"/>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="signup-btn">DAFTAR</button>
                </div>
            </div>
        </div>
    </div>
    <script src="./node_modules/vue/dist/vue.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="./assets/whatreudoing/script.js"></script>
</body>
</html>