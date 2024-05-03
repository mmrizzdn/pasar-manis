<?php
    session_start();
    if(!isset($_SESSION['username'], $_SESSION['role'])){ //Auth jika role bukan admin
        header("Location: ../login.php");
    }else{
        if($_SESSION['role']=="User"){
            header("Location: ../index.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="./index.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="./profile.php">Profil</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Akun
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="./akunData.php">Data</a></li>
                            <li><a class="dropdown-item" href="./akun-tambah.php">Tambah Data</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        UMKM
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="./UMKM-data.php">Data</a></li>
                            <li><a class="dropdown-item" href="./UMKM-tambah.php">Tambah Data</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php

        include "../koneksi.php"; // Include koneksi database

        $stmt = $conn->prepare("SELECT * FROM menu WHERE menu_id = :menu_id");
        $stmt->bindParam(':menu_id', $_GET['id']);
        $stmt->execute();
        $k = $stmt->fetch(PDO::FETCH_ASSOC);

        // Inisialisasi nilai-nilai UMKM
        $name = isset($k['name']) ? $k['name'] : '';
        $price = isset($k['price']) ? $k['price'] : '';
        $deskripsi = isset($k['deskripsi']) ? $k['deskripsi'] : '';

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $deskripsi = $_POST['deskripsi'];

            // Validasi tipe file gambar
            $allowed_formats = array('jpg', 'png', 'jpeg');
            $file_extension = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
            if (!in_array($file_extension, $allowed_formats)) {
                $_SESSION['msg'] = "Format gambar tidak valid. Hanya file JPG, PNG, dan JPEG yang diizinkan.";
                header("Location: #");
                exit();
            }

            $gambar = $_FILES['gambar']['tmp_name'];
            $gambar_name = $_FILES['gambar']['name'];
            $target_dir = "../menu/";
            $target_file = $target_dir . basename($gambar_name);

            // Pindahkan file gambar ke direktori tujuan
            if (move_uploaded_file($gambar, $target_file)) {
                // Menghapus gambar sebelumnya
                $gambar_lama = isset($k['gambar']) ? $k['gambar'] : '';
                if (!empty($gambar_lama)) {
                    unlink("../menu/" . $gambar_lama);
                }

                // Proses update data di database
                $query = $conn->prepare("UPDATE menu SET name=:name, gambar=:gambar, price=:price, deskripsi=:deskripsi WHERE menu_id=:menu_id");
                $query->bindParam(':name', $name);
                $query->bindParam(':gambar', $target_file);
                $query->bindParam(':price', $price);
                $query->bindParam(':deskripsi', $deskripsi);
                $query->bindParam(':menu_id', $_GET['id']);
                $update = $query->execute();

                if ($update) {
                    $_SESSION['msg'] = "Menu berhasil diperbarui!";
                    header("Location: #");
                    exit();
                } else {
                    $_SESSION['msg'] = "Gagal memperbarui Menu.";
                    header("Location: #");
                    exit();
                }
            } else {
                $_SESSION['msg'] = "Terjadi kesalahan saat mengunggah gambar.";
                header("Location: #");
                exit();
            }
        }
    ?>

    <div class="section">
        <div class="container" data-wow-delay="0.1s">
            <h3>Edit</h3>
            <div class="box">
                <?php
                if (isset($_SESSION['msg'])) {
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $_SESSION['msg']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                    unset($_SESSION['msg']);
                }
                ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-floating mb-3">
                        <input type="text" name="name" placeholder="Nama" class="input-control" value="<?= $name; ?>" required readonly>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="file" name="gambar" class="form-control" accept="image/jpeg, image/png, image/jpg" required>
                        <label for="gambar">File gambar dengan format JPG, PNG, atau JPEG</label>
                        </div>
                        <div class="form-floating mb-3">
                        <input type="text" name="price" placeholder="Price" class="input-control" value="<?= $price; ?>" required>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea name="deskripsi" placeholder="Deskripsi" class="input-control" required><?= $deskripsi; ?></textarea>
                        <p class="text-muted">Maksimal 50 kata</p>
                    </div>
                    <input type="submit" name="submit" value="Submit" class="btn btn-warning" required>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
