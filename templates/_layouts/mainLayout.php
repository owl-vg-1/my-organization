<?php

use App\Core\{Auth, ErrorHandler};
use App\View\Helper\HTML;
/* @var $this App\View\View */

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

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav d-flex justify-content-center">
        <li class="nav-item">
          <a class="nav-link" href="?a=home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?t=users&a=show">Сотрудники</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?t=customer&a=show">Список заказчиков</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?t=statusObjects&a=show">Состояние объектов</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?t=objects&a=show">Объекты</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?a=loginform">Login</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="?t=signup&a=ShowForm">Sign Up</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container-fluid">
    <?php 
    if (isset($_SESSION['user'])) {
      echo "<div id='user_state' class='row justify-content-end align-items-center' >".
      Auth::currentUserInfo()
      ."<a class='btn btn-info my-4 m-0' href='?a=logout'>Logout</a></div>";
    }
    ?>
  </div>

  <div id="maincontent">
    <?php $this->body(); ?>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>