<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'travel_agency') or die(mysqli_error($mysqli));

$update = false;
$id ='';
$Country = '';
$Climate = '';
$Lasting = '';
$Hotel='';
$Cost = '';

if (isset($_POST['save'])){
    $id = $_POST['id'];
    $Country = $_POST['Country'];
    $Climate = $_POST['Climate'];
    $Lasting = $_POST['Lasting'];
    $Hotel = $_POST['Hotel'];
    $Cost = $_POST['Cost'];

    $result = $mysqli->query("SELECT * FROM routes WHERE id=$id ORDER BY id ASC");
    
        $mysqli->query("INSERT INTO routes(id, Country, Climate, Lasting, Hotel, Cost) VALUES('$id', '$Country', '$Climate', '$Lasting', '$Hotel' , '$Cost')") or die($mysqli->error);

        $_SESSION['message'] = "Запись была успешно добавлена";
        $_SESSION['msg_type'] = "success";

        header("location: routes.php");
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];

    $mysqli->query("DELETE FROM routes WHERE id=$id") or die($mysqli->error);
    
    $_SESSION['message'] = "Запись была успешно удалена";
    $_SESSION['msg_type'] = "danger";
    
    header("location: routes.php");
}

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM routes WHERE id=$id") or die($mysqli->error);
    if(count(array($result))==1){
        $row = $result->fetch_array();
        $id = $row['id'];
        $Country = $row['Country'];
        $Climate = $row['Climate'];
        $Lasting = $row['Lasting'];
		$Hotel = $row['Hotel'];
		$Cost = $row['Cost'];
    }
}

if (isset($_POST['update'])){
    $id = $_POST['id'];
    $Country = $_POST['Country'];
    $Climate = $_POST['Climate'];
    $Lasting = $_POST['Lasting'];
	$Hotel = $_POST['Hotel'];
	$Cost = $_POST['Cost'];

    $mysqli->query("UPDATE routes SET id='$id', Country='$Country', Climate='$Climate', Lasting='$Lasting', Hotel='$Hotel', Cost='$Cost' WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Запись была успешно обновлена";
    $_SESSION['msg_type'] = "warning";

    header("location: routes.php");
}