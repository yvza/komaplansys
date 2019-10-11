<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan - KOMAPLANSYS</title>
    <link rel="shortcut icon" href="../assets/core/img/logouwu.png" type="image/x-icon">
    <link rel="stylesheet" href="../node_modules/buefy/dist/buefy.min.css">
    <link rel="stylesheet" href="../assets/panel/css/result.css">
</head>
<body>
    <div id="app">
        <nav class="navbar" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a class="navbar-item" href="yu.za">
                    <img src="../assets/core/img/logouwu.png" width="30" height="30">
                </a>

                <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>

            <div id="navbarBasicExample" class="navbar-menu">
                <div class="navbar-start">
                    <a class="navbar-item" href="./dashboard.php">
                        Dashboard
                    </a>

                    <a class="navbar-item" href="./planning.php">
                        Buat Baru
                    </a>

                    <a class="navbar-item menu-is-active" href="./result.php">
                        Laporan Pencapaian
                    </a>
                </div>

                <div class="navbar-end">
                    <div class="navbar-item">
                        <div class="buttons">
                            <a class="button is-info">
                                <strong>Log out</strong>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="notification">
                <p>Welcome, [xxx].</p>
            </div>
        </div>

        <footer>
            Made with 💖 using Vue.js & Oracle
        </footer>
    </div>

    <script src="../node_modules/vue/dist/vue.min.js"></script>
    <script src="../node_modules/buefy/dist/buefy.min.js"></script>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../assets/panel/js/result.js"></script>
</body>
</html>