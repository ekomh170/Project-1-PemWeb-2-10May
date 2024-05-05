<?php
require_once 'header.php';
require_once 'sidebar.php';

require '../../config/dbkoneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Query untuk mengambil data users berdasarkan id
    $sql = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['submit'])) {
    // Validasi password lama hanya jika kedua input password lama dan baru diisi
    if (!empty($_POST['password_lama']) && !empty($_POST['password'])) {
        $password_lama = md5($_POST['password_lama']);
        $password_baru = $_POST['password'];

        // Query untuk mengambil password dari database
        $sql_pass = "SELECT password FROM users WHERE user_id = ?";
        $stmt_pass = $dbh->prepare($sql_pass);
        $stmt_pass->execute([$id]);
        $hashed_password = $stmt_pass->fetchColumn();

        if ($hashed_password !== $password_lama) {
            // Password lama tidak cocok
            echo "<script>alert('Password lama salah.');</script>";
            exit; // Keluar dari skrip jika password lama salah
        }

        // Enkripsi password baru jika password lama cocok
        $hashed_password_baru = md5($password_baru);
    } else {
        // Jika password lama dan password baru tidak diisi, gunakan password yang sudah ada
        $sql_pass = "SELECT password FROM users WHERE user_id = ?";
        $stmt_pass = $dbh->prepare($sql_pass);
        $stmt_pass->execute([$id]);
        $hashed_password_baru = $stmt_pass->fetchColumn();
    }

    // Data untuk update
    $_username = $_POST['username'];
    $_fullname = $_POST['fullname'];
    $_email = $_POST['email'];
    $_role = $_POST['role'];

    // Periksa apakah ada file yang diunggah
    if ($_FILES['foto']['error'] === UPLOAD_ERR_OK) {

        // Hapus gambar lama jika ada
        $old_image = $row['foto'];
        if (!empty($old_image)) {
            $old_image_path = '../../assets/foto/users/' . $old_image;
            if (file_exists($old_image_path)) {
                unlink($old_image_path); // Hapus gambar lama dari direktori
            }
        }

        // proses file upload
        $upload_dir = '../../assets/foto/users/'; //  direktori tempat menyimpan file upload
        $file_name = $_FILES['foto']['name'];
        $file_tmp = $_FILES['foto']['tmp_name'];

        // Memvalidasi jenis file
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
        $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        if (!in_array($file_extension, $allowed_extensions)) {
            echo "<script>alert('Jenis file tidak didukung.');</script>";
            exit(); // Menghentikan eksekusi jika jenis file tidak didukung
        }

        // Ambil username dari formulir
        $username = $_POST['username'];

        // Gabungkan username dengan nama file
        $file_destination = $upload_dir . $username . "_" . $file_name;
        // Pindahkan file yang diunggah ke direktori tujuan
        move_uploaded_file($file_tmp, $file_destination);
        // Gunakan nama file dengan username sebagai path
        $_foto = $username . "_" . $file_name;
    } else {
        // Gunakan foto yang sudah ada jika tidak ada file baru yang diunggah
        $_foto = $row['foto'];
    }

    // Query SQL untuk update data users berdasarkan id
    $sql = "UPDATE users SET username = ?, fullname = ?, password = ?, email = ?, foto = ?, role = ? WHERE user_id = ?";
    $data = [$_username, $_fullname, $hashed_password_baru, $_email, $_foto, $_role, $id];
    $stmt = $dbh->prepare($sql);

    if ($stmt->execute($data)) {
        // Jika eksekusi query berhasil
        echo "<script>alert('Data berhasil diupdate.'); window.location.href = 'index.php';</script>";
    } else {
        // Jika eksekusi query gagal
        echo "<script>alert('Gagal memperbarui data. Silakan coba lagi.');</script>";
    }
}


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Menu Edit Data - Form Akun Aplikasi Puskesmas</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Akun Aplikasi Puskesmas</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <h2 class="text-center">Form Akun Aplikasi Puskesmas</h2>
                            <form action="edit.php?id=<?= $row['user_id'] ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label for="username" class="col-4 col-form-label">Nama Panggilan</label>
                                    <div class="col-8">
                                        <input id="username" name="username" type="text" class="form-control" value="<?= $row['username'] ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="fullname" class="col-4 col-form-label">Nama Lengkap</label>
                                    <div class="col-8">
                                        <input id="fullname" name="fullname" type="text" class="form-control" value="<?= $row['fullname'] ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-4 col-form-label">Email</label>
                                    <div class="col-8">
                                        <input id="email" name="email" type="text" class="form-control" value="<?= $row['email'] ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password_lama" class="col-4 col-form-label">Password Lama</label>
                                    <div class="col-8">
                                        <input id="password_lama" name="password_lama" type="password" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-4 col-form-label">Password Baru</label>
                                    <div class="col-8">
                                        <input id="password" name="password" type="password" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="foto" class="col-4 col-form-label">Foto</label>
                                    <div class="col-8">
                                        <input type="file" class="form-control-file" id="foto" name="foto">
                                        <?php if (!empty($row['foto'])) : ?>
                                            <img src="../../assets/foto/users/<?= $row['foto'] ?>" alt="Foto" width="100">
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="role" class="col-4 col-form-label">Hak Akses</label>
                                    <div class="col-8">
                                        <select id="role" name="role" class="custom-select">
                                            <?php
                                            // Mendapatkan nilai-nilai enum dari kolom role
                                            $enumValues = $dbh->query("SHOW COLUMNS FROM users  LIKE 'role'")->fetch(PDO::FETCH_ASSOC)['Type'];
                                            preg_match_all("/'(.*?)'/", $enumValues, $matches);
                                            $enumOptions = $matches[1];

                                            // Loop untuk membuat opsi-opsi dropdown
                                            foreach ($enumOptions as $option) {
                                                $selected = ($option == $row['role']) ? 'selected' : '';
                                                echo "<option value='$option' $selected>$option</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-4 col-8">
                                        <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            Project 1 - Aplikasi CRUD Sederhana Puskesmas
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
require_once 'footer.php';
?>