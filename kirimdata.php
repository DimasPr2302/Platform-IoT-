<?php
  // koneksi ke database
  $connection = mysqli_connect("localhost", "root", "", "ardufarm_db");

  global $suhu;
  global $kelembaban;
  global $soil;


  // membaca data yang dikirim dari ESP-32
  if (isset($_GET['suhu']) && isset($_GET['kelembaban'])) {
    $suhu = $_GET['suhu']; // t = temperature
    $kelembaban = $_GET['kelembaban']; // h = humidity level
  }

  $soil = $_GET['soil'];
  mysqli_query($connection, "UPDATE kebun SET soil_moisture = '$soil'");
  

  // pembacaan RELAY
  // $sql = mysqli_query($connection, "SELECT * FROM kebun");
  // $data = mysqli_fetch_array($sql);
  // $relay = $data['relay'];

  // echo $relay;

  // auto increment > mengembalikan id menjadi 1 ketika kita mengosongkan data dan kemudian kita tambah data baru
  mysqli_query($connection, "ALTER TABLE kebun AUTO_INCREMENT=1");

  $save = mysqli_query($connection, "INSERT INTO kebun(`id`, `temperatur`, `humidity`,`soil_moisture`) VALUES (NULL,'$suhu','$kelembaban', '$soil')");

  if ($save) {
    echo "Berhasil tersimpan";
  } else {
    echo "Gagal tersimpan";
  }
  ?>