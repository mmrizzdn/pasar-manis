<?php
    session_start();

    include "../koneksi.php"; // Include koneksi database
    if(isset($_GET['idk'])){
        $delete = $conn->prepare("DELETE FROM user WHERE username=:username");
        $delete->bindParam(':username', $_GET['idk']);
        $delete->execute();

        echo '<script> window.location="akunData.php"</script>';
    }

    if (isset($_GET['idu'])) {
        $query_select = $conn->prepare("SELECT gambar FROM umkm WHERE umkm_id = :umkm_id");
        $query_select->bindParam(':umkm_id', $_GET['idu']);
        $query_select->execute();
        $row_select = $query_select->fetch(PDO::FETCH_ASSOC);
        $gambar = $row_select['gambar'];
    
        if (!empty($gambar)) {
            unlink('../UMKM/' . $gambar);
        }
    
        $query_delete = $conn->prepare("DELETE FROM umkm WHERE umkm_id = :umkm_id");
        $query_delete->bindParam(':umkm_id', $_GET['idu']);
        $delete = $query_delete->execute();
    
        if ($delete) {
            echo '<script> window.location="UMKM-data.php"</script>';
        }
    }
    if (isset($_GET['idm'])) {
        $query_select = $conn->prepare("SELECT gambar FROM menu WHERE menu_id = :menu_id");
        $query_select->bindParam(':menu_id', $_GET['idm']);
        $query_select->execute();
        $row_select = $query_select->fetch(PDO::FETCH_ASSOC);
        $gambar = $row_select['gambar'];
    
        if (!empty($gambar)) {
            unlink('../menu/' . $gambar);
        }
    
        $query_delete = $conn->prepare("DELETE FROM menu WHERE menu_id = :menu_id");
        $query_delete->bindParam(':menu_id', $_GET['idm']);
        $delete = $query_delete->execute();
    
        if ($delete) {
            echo '<script> window.location="menu-data.php"</script>';
        }
    }
?>