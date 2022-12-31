<?php
  // membuat koneksi ke database
  $connection = mysqli_connect("localhost", "root", "", "ardufarm_db");

  // membaca data dari table sensor
  $sql = mysqli_query($connection, "SELECT * FROM kebun order by id desc"); // data terakhir akan berada diatas / dibaca dahulu

  // baca data suhu tersebut
  $data = mysqli_fetch_array($sql);
  $kelembaban = $data['humidity'];

  // uji apabila nilai suhu tidak ada, maka h = 0
  if ($kelembaban == "") {
    $kelembaban == 0;
  }

  // print nilai suhu
  echo $kelembaban;
?>