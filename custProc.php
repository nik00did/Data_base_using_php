<?php
session_start();
$mysqli = new mysqli('localhost', 'root', '', 'travel_agency') or die(mysqli_error($mysqli));
$update = false;
$id = '';
$surname = '';
$name = '';
$patronymic = '';
$address = '';
$phone = '';

if (isset($_POST['save'])){
    $id = $_POST['id'];
    $surname = $_POST['surname'];
    $name = $_POST['name'];
    $patronymic = $_POST['patronymic'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    $mysqli->query("INSERT INTO customers(id, surname, name, patronymic, address, phone) VALUES('$id', '$surname', '$name', '$patronymic', '$address', '$phone')") or die($mysqli->error);

    $_SESSION['message'] = "Запись была успешно добавлена";
    $_SESSION['msg_type'] = "success";
header("location: customers.php");
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];

    $mysqli->query("DELETE FROM customers WHERE id=$id") or die($mysqli->error);
    
    $_SESSION['message'] = "Запись была успешно удалена";
    $_SESSION['msg_type'] = "danger";
    
    header("location: customers.php");
}

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM customers WHERE id=$id ORDER BY id ASC") or die($mysqli->error);
    if(count(array($result))==1){
        $row = $result->fetch_array();
        $id = $row['id'];
        $surname = $row['surname'];
        $name = $row['name'];
        $patronymic = $row['patronymic'];
        $address = $row['address'];
        $phone = $row['phone'];
    }
}

if (isset($_POST['update'])){
    $id = $_POST['id'];
    $surname = $_POST['surname'];
    $name = $_POST['name'];
    $patronymic = $_POST['patronymic'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];


    $mysqli->query("UPDATE customers SET id='$id', surname='$surname', name='$name', patronymic='$patronymic', address='$address', phone='$phone'  WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Запись была успешно обновлена";
    $_SESSION['msg_type'] = "warning";

    header("location: customers.php");
}
?>