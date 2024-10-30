<?php 

include("koneksi.php");

echo"<h1>LOGIN</h1>";

$password = $_POST["password"];
$username = $_POST["username"];

$query = mysqli_query($koneksi, "select * from user where username='$username'");

$jumlah_data = mysqli_num_rows($query);

if($jumlah_data > 0){
    $data = mysqli_fetch_array($query);

    //if($data['password'] == $password){
    
    if(password_verify($password, $data['password'])){
       session_start();
       $_SESSION['id']     = $data['id'];
       $_SESSION['username']   =$data['username'];
       $_SESSION['password']   =$data['password'];
       $_SESSION['role']       =$data['role'];

       if($data['role'] == "admin"){
        header("location: haladmin.php");
       }else if($data["role"] == "customer") {

        header("location: index.php");
       } 
    }else{
        header("Location: login.php?error=username atau password salah");
    }
    }else{
        header("Location: login.php?error=username atau password salah");
    
}