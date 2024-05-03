<?php  
    include "koneksi.php"; //include koneksi
    session_start(); 
    if (isset($_POST['submitLogin'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];   
        $query = $conn->prepare("SELECT * FROM user WHERE username = :username && password = :password");
        $query->bindParam('username', $username);
        $query->bindParam('password', $password);
        $query->execute();  
    
        if ($query->rowCount() > 0) {
            $user = $query->fetch(PDO::FETCH_ASSOC);
            $_SESSION['username'] = $user['username'];  
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
    
            if ($user['role'] == 'Admin') {
                header("Location: ./Admin/index.php"); // Mengarahkan ke halaman index.php jika peran (role) adalah admin
            } else if ($user['role'] == 'User') {
                header("Location: index.php"); // Mengarahkan ke halaman Dashboard.php jika peran (role) adalah user
            } else {
                $_SESSION['msg'] = "Peran tidak valid"; // Jika peran tidak sesuai, sesi pesan akan diset
                header("Location: login.php");
            }
        } else {
            $_SESSION['msg'] = "Akun gagal"; // Jika login gagal, sesi pesan akan diset
            header("Location: login.php");
        }  
    }  
    

    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $name = $_POST['name'];
        $password = $_POST['password'];
    
        // Prepare and execute the SQL query
        $query = $conn->prepare("INSERT INTO user (email, username, name, password, role) VALUES (:email, :username, :name, :password, :role)");
        $query->bindParam(':email', $email);
        $query->bindParam(':username', $username);
        $query->bindParam(':name', $name);
    
        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query->bindParam(':password', $hashedPassword);
    
        $role = 'User'; // Set the role as 'User'
        $query->bindParam(':role', $role);
    
        // Check if the query was successful
        if ($query->execute()) {
            $_SESSION['msg'] = "Registration successful!";
            header("Location: ./login.php");
            exit();
        } else {
            $_SESSION['msg'] = "Registration failed.";
            header("Location: #");
            exit();
        }
    }
    
?>