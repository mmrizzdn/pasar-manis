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
    <div class="section">
        <div class="container">
            <h1>Data UMKM</h1>
            <div class="box">
                <?php

                include "../koneksi.php";
                $query = "SELECT * FROM menu WHERE umkm_id = :umkm_id";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':umkm_id', $_GET['id'], PDO::PARAM_INT);
                $stmt->execute();
                ?>
                <p><a href="menu-tambah.php?id=<?php echo $_GET['id']; ?>">Tambah Data</a></p>
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id Menu</th>
                            <th>Nama Menu</th>
                            <th>Gambar</th>
                            <th>Price</th>
                            <th>Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            $no = 1;
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $row['menu_id'] ?></td>
                            <td><?php echo $row['name'] ?></td>
                            <?php
                            $file_info = pathinfo($row['gambar']);
                            $file_extension = strtolower($file_info['extension']);
                            ?>
                            
                            <td><img src="../menu/<?php echo $row['gambar']; ?>" width="200px"></td>
                            <td><?php echo $row['price'] ?></td>
                            <td><?php echo $row['deskripsi'] ?></td>
                            <td>
                            <a href="menu-edit.php?id=<?php echo $row['menu_id'] ?>">Edit</a> || <a href="proses-hapus.php?idm=<?php echo $row['menu_id'] ?>">hapus</a>
                            </td>
                        </tr>
                        <?php
                        $no++;
                        }
                        ?>
                    </tbody>
                </table>

            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>