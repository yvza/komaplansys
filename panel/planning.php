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
    <link rel="stylesheet" href="//cdn.materialdesignicons.com/4.7.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../node_modules/buefy/dist/buefy.min.css">
    <link rel="stylesheet" href="../node_modules/@simonwep/pickr/dist/themes/nano.min.css">
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
                        <b-button @click="keluar($event)" icon-right="exit-run" class="is-warning">
                            KELUAR
                        </b-button>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container">
            <section>
                <div class="field">
                    <b-switch v-model="isSwitched">
                        Tambah Agenda
                    </b-switch>
                </div>
                <div v-show="isSwitched" class="agendaWrapper">
                    <div class="columns">
                        <div class="column">
                            <b-field label="Judul Kegiatan">
                                <b-input
                                    id="desc"
                                    type="text"
                                    placeholder="Saya ingin..."
                                    required>
                                </b-input>
                            </b-field>

                            <b-field label="Pilih Rentang Tanggal   ">
                                <b-datepicker
                                    placeholder="Klik untuk memilih..."
                                    v-model="dates"
                                    range>
                                </b-datepicker>
                            </b-field>

                            <b-field label="Warna Label">
                                <div class="color-picker"></div>
                            </b-field>

                            <b-field label="Catatan">
                                <div id="editor"></div>
                            </b-field>

                            <br><b-button @click="buat()" icon-left="send-outline" class="is-info is-outlined">
                                Buat Sekarang
                            </b-button>
                        </div>
                    </div>
                </div>

                <b-table
                    v-if="data.length != 0"
                    v-show="!isSwitched"
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
                            <b-button icon-left="magnify" class="is-success is-outlined"></b-button>
                            <b-button icon-left="file-document-edit" class="is-dark is-outlined"></b-button>
                            <b-button @click="hapus(props.row.KUNCI)" icon-left="delete-empty" class="is-danger is-outlined"></b-button>
                        </b-table-column>
                    </template>
                </b-table>

                <div v-else
                    class="columns"
                    v-show="!isSwitched">
                    <div class="column has-text-centered">BELUM ADA AGENDA 😭</div>
                </div>
            </section>
            <!-- <b-modal :active.sync="isCardModalActive" scroll="keep">
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
            </b-modal> -->
        </div>

        <footer>
            Made with 💖 using Vue.js & Oracle
        </footer>
    </div>

    <script src="../node_modules/vue/dist/vue.min.js"></script>
    <script src="../node_modules/buefy/dist/buefy.min.js"></script>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/@simonwep/pickr/dist/pickr.min.js"></script>
    <script src="../node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
    <script src="../assets/panel/js/planning.js"></script>
</body>
</html>