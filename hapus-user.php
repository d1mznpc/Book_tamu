<?php
// panggil file function php
require_once 'function.php';

// jika ad id
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (hapus_user($id) > 0) {
        // jika data berhasil di hapus muncul alert
        echo "<script>alert('data berhasil di hapus!')</script>";
        // redirect ke halaman users
        echo "<script>window.location.href='users.php'</script>";
    } else {
        //jika gagal di hapus
        echo "<script>alert('data gagal di hapus!')</script>";
        echo "<script>window.location.href='users.php'</script>";
    }
}
