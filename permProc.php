<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'travel_agency') or die(mysqli_error($mysqli));

$update = false;
$id = '';
$id_route = '';
$id_cust = '';
$date_go ='';
$amount = '';
$discount = '';

if (isset($_POST['save'])){
    $id_route = $_POST['id_route'];
    $id_cust = $_POST['id_cust'];
    $date_go = $_POST['date_go'];
    $amount = $_POST['amount'];
    $discount = $_POST['discount'];

    $mysqli->query("INSERT INTO permits(id_route, id_cust, date_go, amount, discount) VALUES('$id_route', '$id_cust', '$date_go', '$amount', '$discount')") or die($mysqli->error);

    $_SESSION['message'] = "Запись была успешно добавлена";
    $_SESSION['msg_type'] = "success";

    header("location: permits.php");
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];

    $mysqli->query("DELETE FROM permits WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Запись была успешно удалена";
    $_SESSION['msg_type'] = "danger";

    header("location: permits.php");
}

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM permits WHERE id=$id") or die($mysqli->error);
    if(count(array($result))==1){
        $row = $result->fetch_array();
        $id_route = $row['id_route'];
        $id_cust = $row['id_cust'];
        $date_go = $row['date_go'];
        $amount = $row['amount'];
        $discount = $row['discount'];
    }
}

if (isset($_POST['update'])){
    $id = $_POST['id'];
    $id_route = $_POST['id_route'];
    $id_cust = $_POST['id_cust'];
    $date_go = $_POST['date_go'];
    $amount = $_POST['amount'];
    $discount = $_POST['discount'];

    $mysqli->query("UPDATE permits SET id_route='$id_route', id_cust='$id_cust', date_go='$date_go', amount='$amount', discount='$discount' WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Запись была успешно обновлена";
    $_SESSION['msg_type'] = "warning";
    
    header("location: permits.php");
}