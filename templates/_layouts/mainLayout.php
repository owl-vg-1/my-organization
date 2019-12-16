<?php

use App\Core\{Auth, ErrorHandler};
use App\View\Helper\HTML;

/** @var string $title */
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <base href="/">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?= $title ?></title>
  <link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Pangolin&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Ruslan+Display&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav d-flex justify-content-center">
        <li class="nav-item">
          <a class="nav-link" href="?a=home">Home</a>
        </li>
        <?php
          if ($_SESSION['user']['group_workers'] == 'leader') {
           ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Меню руководителя
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="?t=users&a=show">Сотрудники</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="?t=statusObjects&a=show">Состояние объектов</a>
              </div>
              </li>
            <?php
          }
        ?>
        <?php
          if ($_SESSION['user']['group_workers'] == 'leader' || $_SESSION['user']['group_workers'] == 'worker') {
           ?>
            <li class="nav-item">
              <a class="nav-link" href="?t=customer&a=show">Список заказчиков</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?t=objects&a=show">Объекты</a>
            </li>
            <?php
          }
        ?>

        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Вход / Регистрация
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="?a=loginform">Вход</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="?t=signup&a=ShowForm">Регистрация</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="?a=logout">Выход</a>
        </div>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container-fluid">
    <div class="row">
      <div class="col text-center" id="user_state">
        <?php 
          if (isset($_SESSION['user'])) {
            echo Auth::currentUserInfo();
          }
        ?>
      </div>
    </div>
  </div>

  <div id="maincontent">
    <?php $this->body(); ?>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>