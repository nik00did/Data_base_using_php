<!DOCTYPE html>
<html>
<head>
    <title>Общий вывод</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>
    <body>
        <?php require_once 'processoutput.php'; ?>
        <?php
            if (isset($_SESSION['message'])): ?>
                <div class="alert alert-<?=$_SESSION['msg_type']?>">
                    <?php
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    ?>
                </div>
        <?php endif ?>
        <div class="pos-f-t">
            <div class="collapse" id="navbarToggleExternalContent">
                <div class="light" style="background-color: #e3f2fd;">
                    <ul class="nav nav-pills nav-fill">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php#">Главная</a>
                        </li>
                    </ul>
                </div>
                <div class="light p-4" style="background-color: #e3f2fd;">
                    <ul class="nav nav-pills nav-fill">
                        <li class="nav-item">
                            <a class="nav-link active" href="output.php#">Общий вывод</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="routes.php#">Маршруты</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="customers.php#">Клиенты</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="permits.php#">Путевки</a>
                        </li>
						<li class="nav-item">
                            <a class="nav-link" href="hardquery.php#">Сложные запросы</a>
                        </li>
                    </ul>
                    </ul>
                </div>
            </div>
            <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
        </div>
        <?php
            $mysqli = new mysqli('localhost', 'root', '', 'travel_agency') or die(mysqli_error($mysqli));
            $resultroutes = $mysqli->query("SELECT * FROM routes ORDER BY id ASC") or die($mysqli->error);
            $resultcustomers = $mysqli->query("SELECT * FROM customers ORDER BY id ASC") or die($mysqli->error);
            $resultpermits = $mysqli->query("SELECT * FROM permits ORDER BY id ASC") or die($mysqli->error);
        ?>
        <div class="row justify-content-center">
            <h1>Таблица групп</h1>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Номер маршрута</th>
                            <th>Страна</th>
                            <th>Климат</th>
                            <th>Длительность</th>
        					<th>Отель</th>
        					<th>Стоимость</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <?php while ($row = $resultroutes->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['Country']; ?></td>
                            <td><?php echo $row['Climate']; ?></td>
                            <td><?php echo $row['Lasting']; ?></td>
                            <td><?php echo $row['Hotel']; ?></td>
                            <td><?php echo $row['Cost']; ?></td>
    					</tr>
                    <?php endwhile; ?>
                </table>
            </div>
        </div>
        <div class="row justify-content-center">
            <h1>Таблица клиентов</h1>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <table class="table">
                    <thead>
                           <tr>
                            <th>Код клиента</th>
                            <th>Фамилия</th>
                            <th>Имя</th>
                            <th>Отчество</th>
                            <th>Адрес</th>
                            <th>Телефон</th>
                        </tr>
                    </thead>
                    <?php while ($row = $resultcustomers->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['surname']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['patronymic']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['phone']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        </div>
        <div class="row justify-content-center">
            <h1>Таблица путевок</h1>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Код маршрута</th>
                            <th>Код клиента</th>
                            <th>Дата отбытия</th>
                            <th>Количество</th>
                            <th>Скидка</th>
                        </tr>
                    </thead>
                    <?php while ($row = $resultpermits->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id_route']; ?></td>
                            <td><?php echo $row['id_cust']; ?></td>
                            <td><?php echo $row['date_go']; ?></td>
                            <td><?php echo $row['amount']; ?></td>
                            <td><?php echo $row['discount']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        </div>
        </div>
    </body>
</html>