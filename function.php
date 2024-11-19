<?php
//panggil file koneksi.php
require_once('koneksi.php');

// membuat query ke / dari database
function query($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
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

    $gambar = uploadGambar();
    if (!$gambar){
        return false;
    }

    $query = "INSERT INTO bukutamu VALUES ('$kode', '$tanggal', '$nama_tamu', '$alamat', '$no_hp', '$bertemu', '$kepentingan','$gambar')";
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

// function hapus data tamu
function hapus_tamu($id)
{
    global $koneksi;

    $query = "DELETE FROM bukutamu WHERE id_tamu = '$id'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

// function tambah user
function tambah_user($data)
{
    global $koneksi;

    $kode = htmlspecialchars($data["id_user"]);
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);
    $user_role = htmlspecialchars($data["user_role"]);

    // enkripsi password dengan password hash
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users VALUES ('$kode', '$username', '$password_hash', '$user_role')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}
// function ubah data tamu
function ubah_user($data)
{
    global $koneksi;

    $kode = htmlspecialchars($data["id_user"]);
    $username = htmlspecialchars($data["username"]);
    $user_role = htmlspecialchars($data["user_role"]);

    $query = "UPDATE users SET
            username = '$username',
            user_role = '$user_role'
            WHERE id_user = '$kode'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

// function hapus data tamu
function hapus_user($id)
{
    global $koneksi;

    $query = "DELETE FROM users WHERE id_user = '$id'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}
// function ganti password user
function ganti_password($data)
{
    global $koneksi;

    $kode = htmlspecialchars($data["id_user"]);
    $password = htmlspecialchars($data["password"]);
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "UPDATE users SET
              password = '$password_hash'
              WHERE id_user = '$kode' ";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

// upload gambar
function uploadGambar(){
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
              </script>";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile); 
    $ekstensiGambar = strtolower(end($ekstensiGambar)); 
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
    echo "<script> 
            alert('File yang diunggah harus gambar!'); 
          </script>"; 
    return false;
    }
    // cek jika ukurannya terlalu besar 
    if($ukuranFile > 1000000){
    echo "<script> 
            alert('Ukuran gambar terlalu besar!'); 
          </script>";
    return false;
    }
    // jika lolos pengecekan, gambar akan diunggah // generate nama gambar baru dengan uniqid()
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, 'assets/upload_gambar/'.$namaFileBaru);
    return $namaFileBaru;
}