<?php
  // membuat koneksi ke database
  $connection = mysqli_connect("localhost", "root", "", "ardufarm_db");

  // membaca data dari table sensor
  $sql = mysqli_query($connection, "SELECT * FROM kebun order by id desc"); // data terakhir akan berada diatas / dibaca dahulu

  // baca data suhu tersebut
  $data = mysqli_fetch_array($sql);
  $suhu = $data['temperatur'];

  // uji apabila nilai t tidak ada, maka t = 0
  if ($suhu == "") {
    $suhu == 0;
  }

  // print nilai t
  echo $suhu;
?>