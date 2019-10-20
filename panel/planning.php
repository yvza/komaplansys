<?php
session_start();
if(!isset($_SESSION['members_id'])){
    header('Location: ../whatreudoing.php');
}
if(@$_GET['keluar'] === 'y'){
    session_destroy();
    session_unset();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buat Baru - KOMAPLANSYS</title>
    <link rel="shortcut icon" href="../assets/core/img/logouwu.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/2.5.94/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../node_modules/buefy/dist/buefy.min.css">
    <link rel="stylesheet" href="../assets/panel/css/planning.css">
</head>
<body>
    <div id="app" v-cloak>
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

                    <a class="navbar-item menu-is-active" href="./planning.php">
                        Buat Baru
                    </a>

                    <a class="navbar-item" href="./result.php">
                        Laporan Pencapaian
                    </a>
                </div>

                <div class="navbar-end">
                    <div class="navbar-item">
                        <div class="buttons">
                            <a @click="keluar($event)" href="!#" class="button is-info">
                                <strong>Log out</strong>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container">
            <section>
                <b-field grouped group-multiline>
                    <div class="control">
                        <button class="button" @click="isCardModalActive = true">Tambah Baru</button>
                    </div>
                </b-field>

                <b-table
                    :data="data"
                    :paginated="isPaginated"
                    :per-page="perPage"
                    :current-page.sync="currentPage"
                    :pagination-simple="isPaginationSimple"
                    :pagination-position="paginationPosition"
                    :default-sort-direction="defaultSortDirection"
                    :sort-icon="sortIcon"
                    :sort-icon-size="sortIconSize"
                    default-sort="id"
                    aria-next-label="Next page"
                    aria-previous-label="Previous page"
                    aria-page-label="Page"
                    aria-current-label="Current page">

                    <template slot-scope="props">
                        <b-table-column field="title" label="TITLE" sortable>
                            {{ props.row.TITLE }}
                        </b-table-column>

                        <b-table-column field="start_date" label="START DATE" sortable>
                            {{ props.row.START_DATE }}
                        </b-table-column>

                        <b-table-column field="end_date" label="END DATE" sortable>
                            {{ props.row.END_DATE }}
                        </b-table-column>

                        <b-table-column field="category" label="CATEGORY" sortable>
                            <div class="select">
                                <select @change="categoryChanged(props.row.KUNCI)" id="category" name="category">
                                    <option v-for="cat in categories" :value="cat.ID" :selected="cat.ID == props.row.CATID">{{cat.CATEGORY}}</option>
                                </select>
                            </div>
                        </b-table-column>

                        <b-table-column field="description" label="RATING" sortable>
                            <b-rate 
                                v-model="props.row.DESCRIPTION" 
                                @change="starsChange(props.row.KUNCI, $event)"></b-rate>
                        </b-table-column>

                        <b-table-column field="status" label="STATUS" sortable>
                            <div class="select">
                                <select @change="statusChanged(props.row.KUNCI)" id="status" name="status">
                                    <option v-for="st in status" :value="st.ID" :selected="st.ID == props.row.SUID">{{st.STATUS}}</option>
                                </select>
                            </div>
                        </b-table-column>

                        <b-table-column field="action" label="ACTION" sortable>
                            <button @click="hapus(props.row.KUNCI)" class="button">DELETE</button>
                        </b-table-column>
                    </template>
                </b-table>
            </section>
            <b-modal :active.sync="isCardModalActive" scroll="keep">
                <div class="modal-card" style="width:auto; height: 650px;">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Masukkan Agenda Baru</p>
                    </header>
                    <section class="modal-card-body">
                        <b-field label="Acara">
                            <b-input
                                id="desc"
                                type="text"
                                placeholder="Deskripsi"
                                required>
                            </b-input>
                        </b-field>

                        <b-field label="Pilih rentang tanggal">
                            <b-datepicker
                                placeholder="Klik untuk memilih..."
                                v-model="dates"
                                range>
                            </b-datepicker>
                        </b-field>
                    </section>
                    <footer class="modal-card-foot">
                        <button @click="buat()" class="button is-primary">Simpan</button>
                    </footer>
                </div>
            </b-modal>
        </div>

        <footer>
            Made with 💖 using Vue.js & Oracle
        </footer>
    </div>

    <script src="../node_modules/vue/dist/vue.min.js"></script>
    <script src="../node_modules/buefy/dist/buefy.min.js"></script>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../assets/panel/js/planning.js"></script>
</body>
</html>