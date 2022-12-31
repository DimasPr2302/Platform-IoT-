<?php
  // buat koneksi ke database
  $connection = mysqli_connect("localhost", "root", "", "ardufarm_db");

  // ambil parameter stat yang dikirim dari ajax
  $stat = $_GET['stat'];
  if ($stat == "ON")
  {
    // ubah field relay menjadi 1
    mysqli_query($connection, "UPDATE kebun SET relay = 1");

    // respon
    echo "ON";
  } else {
    // ubah field relay menjadi 1
    mysqli_query($connection, "UPDATE kebun SET relay = 0");

    // respon
    echo "OFF";
  }

?>