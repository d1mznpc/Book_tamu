<?php
include_once('template/header.php');

// Jika ada id_tamu di URL
if (isset($_GET['id'])) {
    $id_tamu = $_GET['id'];
    // Ambil data tamu yang sesuai dengan id_tamu
    $data = query("SELECT * FROM bukutamu WHERE id_tamu = '$id_tamu'")[0];
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Ubah data tamu</h1>

    <?php
    if (isset($_POST['simpan'])) {
        if (ubah_tamu($_POST) > 0) {
    ?>
            <div class="alert alert-success" role="alert">
                Data berhasil diubah!
            </div>
        <?php
        } else {
        ?>
            <div class="alert alert-danger" role="alert">
                Data gagal diubah!
            </div>
    <?php
        }
    }
    ?>

    <!-- Konten edit data tamu -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6>Data Tamu</h6>
        </div>
        <div class="card-body">
            <form method="post" action="">
                <input type="hidden" name="id_tamu" id="id_tamu" value="<?= $data['id_tamu'] ?>">
                <div class="form-group row">
                    <label for="nama_tamu" class="col-sm-3 col-form-label">Nama Tamu</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nama_tamu" name="nama_tamu" value="<?= $data['nama_tamu'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="alamat" name="alamat"><?= $data['alamat'] ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_hp" class="col-sm-3 col-form-label">No. Telepon</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $data['no_hp'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="bertemu" class="col-sm-3 col-form-label">Bertemu dg.</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="bertemu" name="bertemu" value="<?= $data['bertemu'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kepentingan" class="col-sm-3 col-form-label">Kepentingan</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="kepentingan" name="kepentingan" value="<?= $data['kepentingan'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="gambar" class="col-sm-3 col-form-label">Gambar</label>
                    <div class="col-sm-8">
                        <img src="assets/upload_gambar/<?= $data['gambar']?>" alt="">
                        <input type="file" class="form-control" id="gambar" name="gambar" value="<?= $data['gambar'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-8 d-flex justify-content-end">
                        <div>
                            <a type="button" class="btn btn-danger btn-icon-split" href="buku-tamu.php">
                                <span class="icon text-white-50">
                                    <i class="fas fa-chevron-left"></i>
                                </span>
                                <span class="text">Kembali</span>
                            </a>
                            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php
include_once('template/footer.php');
?>