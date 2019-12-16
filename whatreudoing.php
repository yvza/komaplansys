<?php
session_start();
if(isset($_SESSION['members_id'])){
    header('Location: ./panel/dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="koma plan sys, kolompok lima planning system" name="keywords">
    <meta content="Adalah Aplikasi Todo-List yang dibangun dengan Vue.js dan Oracle untuk memenuhi tugas Praktek Rekayasa Perangkat Lunak" name="description">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hey Whatsup!</title>
    <link rel="shortcut icon" href="./assets/core/img/logouwu.png" type="image/x-icon">
    <link rel="stylesheet" href="./node_modules/buefy/dist/buefy.min.css">
    <link rel="stylesheet" href="./assets/whatreudoing/style.css">
</head>
<body>
    <div class="form-collection" id="app">
        <div class="card elevation-3 limit-width log-in-card below turned">
            <div class="card-body">
                <div class="pemisah">
                    <div class="kiri">
                        <img src="./assets/core/img/logouwu.png" alt="Kelompok Lima Planning System" style="width:100px;height:100px;">
                    </div>
                    <div class="kanan">
                        <h5>Kelompok Lima Planning System</h5>
                    </div>
                </div>
                <div class="input-group email">
                    <input v-model="logEmail" type="text" placeholder="Email"/>
                </div>
                    <div class="input-group password">
                        <input v-model="logPassword" type="password" placeholder="Password"/>
                    </div>
                    <a @click="lupaPassword($event)" href="!#" class="box-btn">Lupa Password?</a>
                </div>
                <div class="card-footer">
                    <button @click="masuk()" type="submit" class="login-btn">MASUK</button>
                </div>
            </div>

            <div class="card elevation-2 limit-width sign-up-card above">
                <div class="card-body">
                    <div class="pemisah">
                        <div class="kiri">
                            <img src="./assets/core/img/logouwu.png" alt="Kelompok Lima Planning System" style="width:100px;height:100px;">
                        </div>
                        <div class="kanan">
                            <h5>Kelompok Lima Planning System</h5>
                        </div>
                    </div>
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
                    <button @click="daftar()" type="submit" class="signup-btn">DAFTAR</button>
                </div>
            </div>
            <b-loading :is-full-page="isFullPage" :active.sync="isLoading" :can-cancel="true"></b-loading>
        </div>
    </div>
    <script src="./node_modules/vue/dist/vue.min.js"></script>
    <script src="./node_modules/buefy/dist/buefy.min.js"></script>
    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./assets/whatreudoing/script.js"></script>
</body>
</html>