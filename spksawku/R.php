<?php
//mengambil data PK kecamatan, nama kecamatan, dan nilai per-kriteria masing2nya
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

//memasukkan nilai kedalam array
$result = $db->query($sql);
$X = array(1 => array(), 2 => array(), 3 => array());
while ($row = $result->fetch_object()) {
    array_push($X[1], round($row->C1, 2));
    array_push($X[2], round($row->C2, 2));
    array_push($X[3], round($row->C3, 2));
}
$result->free();

//fungsi dimana jika atribut bertipe 'benefit' maka menggunakan rumus jumlah nilai/max
//sedangkan jika bukan, menggunakan rumus min/jumlah nilai
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
}