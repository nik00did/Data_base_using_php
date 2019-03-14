<!DOCTYPE html>
<html>
    <head>
        <title>Клиенты</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php require_once 'custProc.php';?>
        
        <?php
        if (isset($_SESSION['message'])):?>
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
                        <a class="nav-link active" href="customers.php#">Клиенты</a>
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

        <div class="container">
        <?php 
            $mysqli = new mysqli('localhost', 'root', '', 'travel_agency') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM customers ORDER BY id ASC") or die($mysqli->error);
        ?>
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
                        <th colspan="2">Действия</th>
                    </tr>
                </thead>
        <?php 
            while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['surname']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['patronymic']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td>
                        <a href="customers.php?edit=<?php echo $row['id']; ?>"
                           class="btn btn-info">Изменить</a>
                        <a href="custProc.php?delete=<?php echo $row['id']; ?>"
                           class="btn btn-danger">Удалить</a>   
                    </td>
                </tr>
            <?php endwhile; ?>
            </table>
        </div>

        <div class="row justify-content-center">
            <form action="custProc.php" method="POST">
            <div class="d-none">
            <input type="text" name="id" class="form-" 
                   value="<?php echo $id; ?>" >
            </div>
            
            <div class="form-group">
            <label>Фамилия</label>
            <input type="text" name="surname" class="form-control" pattern="[A-Za-zА-Яа-я]{1,}$"
                   value="<?php echo $surname; ?>" placeholder="Введите фамилию" required>
            </div>
            <div class="form-group">
            <label>Имя</label>
            <input type="text" name="name" class="form-control" pattern="[A-Za-zА-Яа-я]{1,}$"
                   value="<?php echo $name; ?>" placeholder="Введите имя" required>
            </div>
            <div class="form-group">
            <label>Отчество</label>
            <input type="text" name="patronymic" class="form-control" pattern="[A-Za-zА-Яа-я]{1,}$"
                   value="<?php echo $patronymic; ?>" placeholder="Введите отчество" required>
            </div>
            <div class="form-group">
            <label>Адресс</label>
            <input type="tel" name="address" class="form-control" pattern="[A-Za-zА-Яа-я]{1,}$"
                   value="<?php echo $address; ?>" placeholder="Введите адресс" required>
                <small id="name" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
            <label>Телефон</label>
            <input type="text" name="phone" class="form-control" pattern="[0-9]{1,}$"
                   value="<?php echo $phone; ?>" placeholder="Введите номер" required>
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