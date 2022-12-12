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
                    <h3>List beasiswa</h3>
                </div>
                <div class="page-content">
                    <section class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-header">
                                    <h4 class="card-title">Beasiswa</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <p class="card-text">
                                            Pilihan Beasiswa non-pemerintah untuk siswa yang kurang mampu namun ingin bersekolah.
                                        </p>
                                    </div>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table table-striped mb-0">
                                            <tr>
                                                <th>No</th>
                                                <th>Beasiswa</th>
                                                <th>Deadline</th>
                                                <th>Penyedia</th>
                                                <th>Link</th>
                                            </tr>
                                            <?php
$sql = 'SELECT kdBeasiswa, judulBeasiswa, durasi, penyedia, akses FROM scholarship';
$result = $db->query($sql);
$i = 0;
while ($row = $result->fetch_object()) {
    echo "<tr>
        <td class='right'>" . (++$i) . "</td>
        <td class='center'>{$row->judulBeasiswa}</td>
        <td class='center'>{$row->durasi}</td>
        <td class='center'>{$row->penyedia}</td>
        <td class='center'><a href={$row->akses}>Access</a></td>
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