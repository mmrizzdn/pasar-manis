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
                        <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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

    $stmt = $conn->prepare("SELECT * FROM user WHERE username = :username");
    $stmt->bindParam(':username', $_GET['id']);
    $stmt->execute();
    $k = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Inisialisasi nilai-nilai pengguna
    $username = isset($k['username']) ? $k['username'] : '';
    $name = isset($k['name']) ? $k['name'] : '';
    $email = isset($k['email']) ? $k['email'] : '';
    $role = isset($k['role']) ? $k['role'] : '';

    // Ubah profil
    if(isset($_POST['submit'])) {
        $username = $_POST['username'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $role = $_POST['role'];

        // Proses update data di database
        $query = $conn->prepare("UPDATE user SET name=:name, email=:email, role=:role WHERE username=:username");
        $query->bindParam(':name', $name);
        $query->bindParam(':email', $email);
        $query->bindParam(':role', $role);
        $query->bindParam(':username', $username);
        $update = $query->execute();

        if($update) {
            echo "Data berhasil diperbarui.";
            // Redirect atau tampilkan pesan sukses lainnya
        } else {
            echo "Terjadi kesalahan saat memperbarui data.";
            // Tampilkan pesan error atau lakukan penanganan kesalahan lainnya
        }
    }
    //Ubah password
    if(isset($_POST['submit_password'])){
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];

        // Validasi password baru
        if($pass1 === $pass2){
            // Proses update password di database
            $query = $conn->prepare("UPDATE user SET password=:password WHERE username=:username");
            $query->bindParam(':password', $pass1);
            $query->bindParam(':username', $username);
            $update = $query->execute();

            if($update){
                $_SESSION['msg'] = "Profil berhasil diperbarui!";
                header("Location: #");
            }else{
                $_SESSION['msg'] = "Gagal memperbarui profil";
                header("Location: #");
            }
        }else{
            echo "Konfirmasi password tidak cocok.";
            // Tampilkan pesan error jika konfirmasi password tidak cocok
        }
    }

    ?>
    <div class="section">
        <div class="container" data-wow-delay="0.1s">
            <h3>Profil</h3>
            <div class="box">
                <?php
                    if(isset($_SESSION['msg'])) //msg jika login gagal
                    {
                ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $_SESSION['msg']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php 
                    unset($_SESSION['msg']);
                }?>
                <form action="" method="POST">
                    <div class="form-floating mb-3">
                        <input type="text" name="username" placeholder="Username" class="input-control" value="<?php echo $username; ?>" required readonly>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="name" placeholder="Nama" class="input-control" value="<?php echo $name; ?>" required>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" name="email" placeholder="name@example.com" class="input-control" value="<?php echo $email; ?>" required>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="role" placeholder="Role" class="input-control" value="<?php echo $role; ?>" required>
                    </div>
                    <input type="submit" name="submit" value="Submit" class="btn btn-warning" required>
                </form>
            </div>
            <h3>Ubah Password</h3>
            <div class="box">
                <form action="" method="POST">
                    <div class="form-floating mb-3">
                        <input type="password" name="pass1" placeholder="Password Baru" class="input-control" required>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="pass2" placeholder="Konfirmasi Password Baru" class="input-control" required>
                    </div>
                    <input type="submit" name="submit_password" value="Submit" class="btn btn-warning" required>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>