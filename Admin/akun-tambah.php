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
                            <li><a class="dropdown-item" href="#">Tambah Data</a></li>
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
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role']; // Mendapatkan nilai dari pilihan role
    
        // Prepare and execute the SQL query
        $query = $conn->prepare("INSERT INTO user ( username, name, email, password, role) VALUES ( :username, :name, :email,:password, :role)");
        
        $query->bindParam(':username', $username);
        $query->bindParam(':name', $name);
        $query->bindParam(':email', $email);
        $query->bindParam(':password', $password);
        $query->bindParam(':role', $role);
        $query->execute();
    
        // Check if the query was successful
        if ($query) {
            $_SESSION['msg'] = "Registration successful!";
            header("Location: #");
            exit();
        } else {
            $_SESSION['msg'] = "Registration failed.";
            header("Location: #");
            exit();
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
                        <input type="text" name="username" placeholder="Username" class="input-control" required >
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="name" placeholder="Nama" class="input-control" required>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" name="email" placeholder="name@example.com" class="input-control" required>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password" placeholder="Password" class="input-control" required>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="role" placeholder="Role" class="input-control" required>
                        <p class="text-muted">Isi "Admin" untuk akses administratif atau "User" untuk akses pengguna.</p>
                    </div>
                    <input type="submit" name="submit" value="Submit" class="btn btn-warning" required>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>