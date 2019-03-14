<!DOCTYPE html>
<html>
    <head>
        <title>Сложные запросы</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php require_once 'processhardquery.php'; ?>
        
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
                    <div class="light p-2" style="background-color: #e3f2fd;">
                        <ul class="nav nav-pills nav-fill">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php#">Главная</a>
                            </li>
                        </ul>
                    </div>
                    <div class="light p-5" style="background-color: #e3f2fd;">
                    <ul class="nav nav-pills nav-fill">
                        <li class="nav-item">
                        <a class="nav-link" href="output.php#">Общий вывод</a>
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
                            <a class="nav-link active" href="hardquery.php#">Сложные запросы</a>
                        </li>
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
        $resultcustomers = $mysqli->query("SELECT * FROM customers WHERE id>20 ORDER BY id ASC") or die($mysqli->error);
        $resultroutes = $mysqli->query("SELECT * FROM routes WHERE cost>1000 ORDER BY id ASC") or die($mysqli->error);
        $resultpermits = $mysqli->query("SELECT * FROM permits WHERE discount>10 ORDER BY id ASC") or die($mysqli->error);
        if ($_POST) {
            $discount1 = $_POST['discount'];
                $resultsearch = $mysqli->query("SELECT * FROM permits WHERE discount>'$discount1' ORDER BY id_route ASC") or die($mysqli->error);
        }
        else{
            $resultsearch = $mysqli->query("SELECT * FROM permits ORDER BY id_route ASC") or die($mysqli->error);
        }
		?>
        <div class="row justify-content-center">
            <h1>Таблица клиентов, код которых > 20</h1>
        </div>
        <div class="container">
            <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Фамилия</th>
                        <th>Имя</th>
                        <th>Отчество</th>
                        <th>Адресс</th>
                        <th>Телефон</th>
                    </tr>
                </thead>
        <?php 
            while ($row = $resultcustomers->fetch_assoc()): ?>
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
		<div class="container">
        <div class="row justify-content-center">
            <h1>Таблица маршрутов, стоимость которых >1000</h1>
        </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Номер маршрута</th>
                        <th>Страна</th>
                        <th>Климат</th>
                        <th>Длительность</th>
						<th>Отель</th>
						<th>Стоимость</th>
                    </tr>
                </thead>
        <?php 
            while ($row = $resultroutes->fetch_assoc()): ?>
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
            <h1>Таблица путевок, где скидка>10</h1>
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
        <?php 
            while ($row = $resultpermits->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id_route']; ?></td>
                    <td><?php echo $row['id_cust']; ?></td>
                    <td><?php echo $row['date_go']; ?></td>
                    <td><?php echo $row['discount']; ?></td>
                    <td><?php echo $row['discount']; ?></td>
                </tr>
            <?php endwhile; ?>
            </table>
        </div>
            </form>
        </div>
		<div class="container">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                Фильтр по скидке
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Введите данные для выполнения запроса</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="hardquery.php" method="POST" name="formsearch">
                                Таблица путевок, где скидка БОЛЬШЕ ЧЕМ
                                <input type="text" name="discount" class="form-control" pattern="[0-9]{1,2}$"
                                placeholder="" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="search">Search</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
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
        <?php 
            while ($row = $resultsearch->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id_route']; ?></td>
                    <td><?php echo $row['id_cust']; ?></td>
                    <td><?php echo $row['date_go']; ?></td>
                    <td><?php echo $row['discount']; ?></td>
                    <td><?php echo $row['discount']; ?></td>
                </tr>
            <?php endwhile; ?>
            </table>
        </div>
        </div>
    </body>
</html>