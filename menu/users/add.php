<?php
require_once 'header.php';
require_once 'sidebar.php';

require '../../config/dbkoneksi.php';

if (isset($_POST['submit'])) {
    $_username = $_POST['username'];
    $_fullname = $_POST['fullname'];
    $_email = $_POST['email'];
    $_role = $_POST['role'];

    // Enkripsi password baru jika dibutuhkan
    $hashed_password_baru = md5($_POST['password']);

    // Periksa apakah ada file yang diunggah
    if ($_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../../assets/foto/users/';
        $file_name = $_FILES['foto']['name'];
        $file_tmp = $_FILES['foto']['tmp_name'];

        // Memvalidasi jenis file
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
        $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        if (!in_array($file_extension, $allowed_extensions)) {
            echo "<script>alert('Jenis file tidak didukung.');</script>";
            exit(); // Menghentikan eksekusi jika jenis file tidak didukung
        }

        // Memvalidasi ukuran file 
        if ($_FILES['foto']['size'] > 15097152) { // 15 MB dalam bytes
            echo "<script>alert('Ukuran file terlalu besar.');</script>";
            exit(); // Menghentikan eksekusi jika ukuran file terlalu besar
        }

        $file_destination = $upload_dir . $_username . "_" . $file_name;
        move_uploaded_file($file_tmp, $file_destination);
        $_foto = $_username . "_" . $file_name;
    } else {
        $_foto = ''; // Jika tidak ada file diunggah, gunakan foto default atau kosong
    }


    // Query SQL untuk insert data baru
    $sql = "INSERT INTO users (username, fullname, password, email, foto, role) VALUES (?, ?, ?, ?, ?, ?)";
    $data = [$_username, $_fullname, $hashed_password_baru, $_email, $_foto, $_role];

    try {
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);

        // Jika eksekusi query berhasil
        echo "<script>alert('Data berhasil ditambahkan.'); window.location.href = 'index.php';</script>";
    } catch (PDOException $e) {
        // Jika eksekusi query gagal, tangani eksepsi
        echo "<script>alert('Gagal menambahkan data. Silakan coba lagi.');</script>";
        // Tampilkan pesan kesalahan untuk debugging
        echo "Error: " . $e->getMessage();
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
                    <h1>Menu Tambah Data - Form Akun Aplikasi Puskesmas</h1>
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
                            <form action="add.php" method="POST" enctype="multipart/form-data">
                                <!-- Form input fields -->
                                <div class="form-group row">
                                    <label for="username" class="col-4 col-form-label">Nama Panggilan</label>
                                    <div class="col-8">
                                        <input id="username" name="username" type="text" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="fullname" class="col-4 col-form-label">Nama Lengkap</label>
                                    <div class="col-8">
                                        <input id="fullname" name="fullname" type="text" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-4 col-form-label">Email</label>
                                    <div class="col-8">
                                        <input id="email" name="email" type="email" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-4 col-form-label">Password</label>
                                    <div class="col-8">
                                        <input id="password" name="password" type="password" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="foto" class="col-4 col-form-label">Foto</label>
                                    <div class="col-8">
                                        <input type="file" class="form-control-file" id="foto" name="foto">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="role" class="col-4 col-form-label">Hak Akses</label>
                                    <div class="col-8">
                                        <select id="role" name="role" class="custom-select">
                                            <?php
                                            // Mendapatkan nilai-nilai enum dari kolom role dengan prepared statement
                                            $stmt_enum = $dbh->prepare("SHOW COLUMNS FROM users LIKE 'role'");
                                            $stmt_enum->execute();
                                            $enumValues = $stmt_enum->fetch(PDO::FETCH_ASSOC)['Type'];
                                            preg_match_all("/'(.*?)'/", $enumValues, $matches);
                                            $enumOptions = $matches[1];

                                            // Loop untuk membuat opsi-opsi dropdown
                                            foreach ($enumOptions as $option) {
                                                $selected = ($_role == $option) ? 'selected' : '';
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