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
                    <b-select v-model="defaultSortDirection">
                        <option value="asc">Default sort direction: ASC</option>
                        <option value="desc">Default sort direction: DESC</option>
                    </b-select>
                    <b-select v-model="perPage" :disabled="!isPaginated">
                        <option value="5">5 per page</option>
                        <option value="10">10 per page</option>
                        <option value="15">15 per page</option>
                        <option value="20">20 per page</option>
                    </b-select>
                    <div class="control">
                        <button class="button" @click="currentPage = 2" :disabled="!isPaginated">Set page to 2</button>
                    </div>
                    <div class="control">
                        <button class="button" @click="isCardModalActive = true">Tambah Baru</button>
                    </div>
                    <div class="control is-flex">
                        <b-switch v-model="isPaginated">Paginated</b-switch>
                    </div>
                    <div class="control is-flex">
                        <b-switch v-model="isPaginationSimple" :disabled="!isPaginated">Simple pagination</b-switch>
                    </div>
                    <b-select v-model="paginationPosition" :disabled="!isPaginated">
                        <option value="bottom">bottom pagination</option>
                        <option value="top">top pagination</option>
                        <option value="both">both</option>
                    </b-select>
                    <b-select v-model="sortIcon">
                        <option value="arrow-up">Arrow sort icon</option>
                        <option value="menu-up">Caret sort icon</option>
                        <option value="chevron-up">Chevron sort icon </option>
                    </b-select>
                    <b-select v-model="sortIconSize">
                        <option value="is-small">Small sort icon</option>
                        <option value="">Regular sort icon</option>
                        <option value="is-medium">Medium sort icon</option>
                        <option value="is-large">Large sort icon</option>
                    </b-select>
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
                    default-sort="user.first_name"
                    aria-next-label="Next page"
                    aria-previous-label="Previous page"
                    aria-page-label="Page"
                    aria-current-label="Current page">

                    <template slot-scope="props">
                        <b-table-column field="id" label="ID" width="40" sortable numeric>
                            {{ props.row.id }}
                        </b-table-column>

                        <b-table-column field="user.first_name" label="First Name" sortable>
                            {{ props.row.user.first_name }}
                        </b-table-column>

                        <b-table-column field="user.last_name" label="Last Name" sortable>
                            {{ props.row.user.last_name }}
                        </b-table-column>

                        <b-table-column field="date" label="Date" sortable centered>
                            <span class="tag is-success">
                                {{ new Date(props.row.date).toLocaleDateString() }}
                            </span>
                        </b-table-column>

                        <b-table-column label="Gender">
                            <span>
                                <b-icon pack="fas"
                                    :icon="props.row.gender === 'Male' ? 'mars' : 'venus'">
                                </b-icon>
                                {{ props.row.gender }}
                            </span>
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
                                type="text"
                                placeholder="Deskripsi"
                                required>
                            </b-input>
                        </b-field>

                        <b-field label="Pilih rentang tanggal">
                            <b-datepicker
                                @input = "holder()"
                                placeholder="Klik untuk memilih..."
                                v-model="dates"
                                range>
                            </b-datepicker>
                        </b-field>
                    </section>
                    <footer class="modal-card-foot">
                        <button class="button" type="button" @click="$parent.close()">Close</button>
                        <button class="button is-primary">Simpan</button>
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