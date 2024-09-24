<?php
    // panggil file function php
    require_once 'function.php';

    // jika ad id
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        if (hapus_tamu($id) > 0){
            // 
            echo "<script>alert('data berhasil di hapus!')</script>";
            // 
            echo "<script>window.location.href='buku-tamu.php'</script>";
        } else {
            //jika gagal di hapus
            echo "<script>alert('data gagal di hapus!')</script>"; 
        }
    }
    
?>