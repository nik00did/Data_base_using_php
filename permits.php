<!DOCTYPE html>
<html>
    <head>
        <title>Путевки</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php require_once 'permProc.php'; ?>
        
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
                        <a class="nav-link" href="output.php#">Общий вывод</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="routes.php#">Маршруты</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="customers.php#">Клиенты</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="permits.php#">Путевки</a>
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

        <div class="container">
        <?php
            $mysqli = new mysqli('localhost', 'root', '', 'travel_agency') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM permits ORDER BY id ASC") or die($mysqli->error);
            $searchRouteResult = $mysqli->query("SELECT * FROM routes ORDER BY id ASC") or die($mysqli->error);
            $searchCustomersResult = $mysqli->query("SELECT * FROM customers ORDER BY id ASC") or die($mysqli->error);
        ?>
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Код маршрута</th>
                        <th>Код клиента</th>
                        <th>Дата отбытия</th>
                        <th>Количество</th>
                        <th>Скидка</th>
                        <th colspan="2">Действия</th>
                    </tr>
                </thead>
        <?php 
            while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id_route']; ?></td>
                    <td><?php echo $row['id_cust']; ?></td>
                    <td><?php echo $row['date_go']; ?></td>
                    <td><?php echo $row['amount']; ?></td>
                    <td><?php echo $row['discount']; ?></td>
                    <td>
                        <a href="permits.php?edit=<?php echo $row['id']; ?>"
                           class="btn btn-info">Изменить</a>
                        <a href="permProc.php?delete=<?php echo $row['id']; ?>"
                           class="btn btn-danger">Удалить</a>   
                    </td>
                </tr>
            <?php endwhile; ?>
            </table>
        </div>
        
        <div class="row justify-content-center">
            <form action="permProc.php" method="POST">
			<div class="d-none">
            <input type="text" name="id" class="form-" 
                   value="<?php echo $id; ?>" >
            </div>
            <div class="form-group">
                <label>Выберите Маршрут</label>
                <select class="form-control" id="exampleFormControlSelect1" name = id_route>
                  <?php while ($row = $searchRouteResult->fetch_assoc()): ?>
                  <option><?php echo $row['id']; ?></option>
                  <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Выберите клиентов</label>
                <select class="form-control" id="exampleFormControlSelect1" name = id_cust>
                  <?php while ($row = $searchCustomersResult->fetch_assoc()): ?>
                  <option><?php echo $row['id']; ?></option>
                  <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
            <label>Дата отправления</label>
            <input type="date" name="date_go" class="form-control" pattern="[0-9]{1,}$"
                   value="<?php echo $date_go; ?>" placeholder="Введите дату отпраления" required>
            </div>
            <div class="form-group">
            <label>Количество</label>
            <input type="text" name="amount" class="form-control" pattern="[0-9]{1,}$"
                   value="<?php echo $amount; ?>" placeholder="Введите количество" required>
            </div>
            <div class="form-group">
            <label>Скидка</label>
            <input type="text" name="discount" class="form-control" pattern="[0-9]{1,}$"
                   value="<?php echo $discount; ?>" placeholder="Введите скидку %" required>
            </div>
            <div class="form-group">
            <?php 
            if($update == true):
            ?>
            <button type="submit" class="btn btn-info" name="update">Обновить</button>
            <?php else: ?>
            <button type="submit" class="btn btn-primary" name="save">Добавить</button>
            <?php endif; ?>
            </div>
        </form>
        </div>
    </div>
    </body>
</html>