<?php
//panggil file koneksi.php
require_once('koneksi.php');
// jika ada id_tamu di URL
if (isset($_GET['id'])) {
    $id_tamu = $_GET['id'];
    // ambil data tamu  yang sesuai dengan id_tamu
    $data = query("SELECT * FROM bukutamu WHERE id_tamu = '$id_tamu'")[0];
}
// membuat query ke / dari database
function query($query){
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}
// function tambah data 
function tambah_tamu($data) 
{
    global $koneksi;

    $kode = htmlspecialchars($data["id_tamu"]);
    $tanggal = date("Y-m-d");
    $nama_tamu = htmlspecialchars($data["nama_tamu"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $no_hp = htmlspecialchars($data["no_hp"]);
    $bertemu = htmlspecialchars($data["bertemu"]);
    $kepentingan = htmlspecialchars($data["kepentingan"]);
    
    $query = "INSERT INTO bukutamu VALUES ('$kode', '$tanggal', '$nama_tamu', '$alamat', '$no_hp', '$bertemu', '$kepentingan')";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

// function ubah data tamu
function ubah_tamu($data)
{
    global $koneksi;

    $id = htmlspecialchars($data["id_tamu"]);
    $nama_tamu = htmlspecialchars($data["nama_tamu"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $no_hp = htmlspecialchars($data["no_hp"]);
    $bertemu = htmlspecialchars($data["bertemu"]);
    $kepentingan = htmlspecialchars($data["kepentingan"]);

    $query = "UPDATE bukutamu SET
            nama_tamu = '$nama_tamu',
            alamat = '$alamat',
            no_hp = '$no_hp',
            bertemu = '$bertemu',
            kepentingan = '$kepentingan'
            WHERE id_tamu = '$id'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}