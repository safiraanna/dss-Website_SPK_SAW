<!DOCTYPE html>
<html lang="en">
  <?php
require "layout/head.php";
require "include/conn.php";
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
          <h3>Matrik</h3>
        </div>
        <div class="page-content">
          <section class="row">
            <div class="col-12">
              <div class="card">

                <div class="card-header">
                  <h4 class="card-title">Matriks Keputusan (X) &amp; Ternormalisasi (R)</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    <p class="card-text">Melakukan perhitungan normalisasi untuk mendapatkan matriks nilai ternormalisasi (R), dengan ketentuan :
Untuk normalisai nilai, jika faktor/attribute kriteria bertipe cost maka digunakan rumusan:
Rij = ( min{Xij} / Xij)
sedangkan jika faktor/attribute kriteria bertipe benefit maka digunakan rumusan:
Rij = ( Xij/max{Xij} )</p>
                  </div>
                  <button type="button" class="btn btn-outline-success btn-sm m-2" data-bs-toggle="modal"
                                        data-bs-target="#inlineForm">
                                        Isi Nilai Alternatif
                                    </button>
                  <div class="table-responsive">
                  <table class="table table-striped mb-0">
    <caption>
        Matrik Keputusan(X)
    </caption>
    <tr>
        <th rowspan='2'>Alternatif</th>
        <th colspan='6'>Kriteria</th>
    </tr>
    <tr>
        <th>C1</th>
        <th>C2</th>
        <th colspan="2">C3</th>
    </tr>
    <?php
$sql = "SELECT
          a.kdKecamatan,
          b.namaKecamatan,
          SUM(IF(a.kdKriteria=1,a.nilai,0)) AS C1,
          SUM(IF(a.kdKriteria=2,a.nilai,0)) AS C2,
          SUM(IF(a.kdKriteria=3,a.nilai,0)) AS C3
        FROM
          evaluations a
          JOIN districts b USING(kdKecamatan)
        GROUP BY a.kdKecamatan
        ORDER BY a.kdKecamatan";
$result = $db->query($sql);
$X = array(1 => array(), 2 => array(), 3 => array());
while ($row = $result->fetch_object()) {
    array_push($X[1], round($row->C1, 2));
    array_push($X[2], round($row->C2, 2));
    array_push($X[3], round($row->C3, 2));
    echo "<tr class='center'>
            <th>A<sub>{$row->kdKecamatan}</sub> {$row->namaKecamatan}</th>
            <td>" . round($row->C1, 2) . "</td>
            <td>" . round($row->C2, 2) . "</td>
            <td>" . round($row->C3, 2) . "</td>
            <td>
            <a href='keputusan-hapus.php?id={$row->kdKecamatan}' class='btn btn-danger btn-sm'>Hapus</a>
            </td>
          </tr>\n";
}
$result->free();

?>
</table>

<table class="table table-striped mb-0">
    <caption>
        Matrik Ternormalisasi (R)
    </caption>
    <tr>
        <th rowspan='2'>Alternatif</th>
        <th colspan='5'>Kriteria</th>
    </tr>
    <tr>
        <th>C1</th>
        <th>C2</th>
        <th>C3</th>
    </tr>
    <?php
$sql = "SELECT
          a.kdKecamatan,
          SUM(
            IF(
              a.kdKriteria=1,
              IF(
                b.atribut='benefit',
                a.nilai/" . max($X[1]) . ",
                " . min($X[1]) . "/a.nilai)
              ,0)
              ) AS C1,
          SUM(
            IF(
              a.kdKriteria=2,
              IF(
                b.atribut='benefit',
                a.nilai/" . max($X[2]) . ",
                " . min($X[2]) . "/a.nilai)
               ,0)
             ) AS C2,
          SUM(
            IF(
              a.kdKriteria=3,
              IF(
                b.atribut='benefit',
                a.nilai/" . max($X[3]) . ",
                " . min($X[3]) . "/a.nilai)
               ,0)
             ) AS C3
        FROM
          evaluations a
          JOIN criteria b USING(kdKriteria)
        GROUP BY a.kdKecamatan
        ORDER BY a.kdKecamatan
       ";
$result = $db->query($sql);
$R = array();
while ($row = $result->fetch_object()) {
    $R[$row->kdKecamatan] = array($row->C1, $row->C2, $row->C3);
    echo "<tr class='center'>
            <th>A{$row->kdKecamatan}</th>
            <td>" . round($row->C1, 2) . "</td>
            <td>" . round($row->C2, 2) . "</td>
            <td>" . round($row->C3, 2) . "</td>
          </tr>\n";
}
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

    <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Isi Nilai Kandidat </h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="matrik-simpan.php" method="POST">
                        <div class="modal-body">
                            <label>Name: </label>
                            <div class="form-group">
                            <select class="form-control form-select" name="id_alternative">
                            <?php
$sql = 'SELECT kdKecamatan,name FROM districts';
$result = $db->query($sql);
$i = 0;
while ($row = $result->fetch_object()) {
    echo '<option value="' . $row->kdKecamatan . '">' . $row->namaKecamatan . '</option>';
}
$result->free(); 
?>
                                          </select>
                            </div>
                        </div>
                        <div class="modal-body">
                            <label>Criteria: </label>
                            <div class="form-group">
                            <select class="form-control form-select" name="id_criteria">
                            <?php
$sql = 'SELECT * FROM criteria';
$result = $db->query($sql);
$i = 0;
while ($row = $result->fetch_object()) {
    echo '<option value="' . $row->kdKriteria . '">' . $row->kriteria . '</option>';
}
$result->free();
?>
                                          </select>
                            </div>
                        </div>
                        <div class="modal-body">
                            <label>Value: </label>
                            <div class="form-group">
                                <input type="text" name="value" placeholder="value..." class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                            <button type="submit" name="submit" class="btn btn-primary ml-1">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Simpan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <?php require "layout/js.php";?>
  </body>

</html>