<!DOCTYPE html> 
<html lang="en">
    <?php
require "layout/head.php";
require "include/conn.php";

//koneksi database, 
?>
    <body>
        <div id="app">
            <?php require "layout/sidebar.php";?>
            <div id="main">
                <header class="mb-3">
                    <a href="#" class="burger-btn d-block d-xl-none">
                        <i class="bi bi-justify fs-3"></i>
                    </a>
                </header>
                <div class="page-heading">
                    <h3>Kecamatan</h3>
                </div>
                <div class="page-content">
                    <section class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-header">
                                    <h4 class="card-title">Tabel Kecamatan</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <p class="card-text">
                                            Alternatif yang digunakan dalam sistem pendukung keputusan kali ini adalah kecamatan-kecamatan yang ada pada
                                            Kabupaten Sumerang. Data ini kami peroleh dari website <a href="https://opendata.sumedangkab.go.id/index.php/dashboard/dataseet">Open Data Kabupaten Sumedang </a>
                                            Data-data mengenai kandidat kecamatan yang akan dievaluasi di representasikan dalam tabel berikut:
                                        </p>
                                    </div>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table table-striped mb-0">
                                            <caption>
                                                Tabel Kecamatan<sub>i</sub>
                                            </caption>
                                            <tr>
                                                <th>No</th>
                                                <th colspan="2">Name</th>
                                            </tr>
<?php
//query sql untuk menampilkan data kecamatan dari database

$sql = 'SELECT kdKecamatan, namaKecamatan FROM districts';
$result = $db->query($sql);
$i = 0;
while ($row = $result->fetch_object()) {
    echo "<tr>
        <td class='right'>" . (++$i) . "</td>
        <td class='center'>{$row->namaKecamatan}</td>
        </tr>\n";
}
$result->free();
?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <?php require "layout/footer.php";?>
            </div>
        </div>
        <?php require "layout/js.php";?>
    </body>

</html>