<?php 
      include "../../path.php";
      include "../../app/controllers/comments.php";
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--Awesome-->
    <link rel="stylesheet" href="/css/awesome/css/all.css" />
    <script src="https://kit.fontawesome.com/9e2ec5709f.js" crossorigin="anonymous"></script>
    <!--Custom styling-->
    <link rel="stylesheet" href = "../../assets/css/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>My blog</title>
  </head>
  <body>
 
  <?php include("../../app/include/header-admin.php"); ?>

  <div class="container">
  <?php include ("../../app/include/sidebar-admin.php"); ?>
      <div class="posts col-9">
        <div class="row title-table">
          <h2>Управление комментариями</h2>
          <div class="col-1">ID</div>
          <div class="col-5">Текст</div>
          <div class="col-2">Автор</div>
          <div class="col-4">Управление</div>
        </div>
        <?php foreach ($commentsForAdm as $key => $comment): ?>
        <div class="row post">
          <div class="id col-1"><?=$comment['id']; ?></div>
          <div class="title col-5"><?=mb_substr($comment['comment'], 0, 50, 'UTF-8') . '...' ?></div>
          <?php
              $user = $comment['email'];
              $user = explode('@', $user);
              $user = $user[0];
          ?>
          <div class="admin col-3"><?=$user . "@"; ?></div>
          <div class="red col-1"><a href="edit.php?id=<?= $comment['id'];?>">edit</a></div>
          <div class="dell col-1"><a href="edit.php?delete_id=<?= $comment['id'];?>">delete</a></div>
          <?php if($comment['status']): ?>
            <div class="status col-1"><a href="edit.php?publish=0&pub_id=<?= $comment['id'];?>">uppublish</a></div>
          <?php else:?>
            <div class="status col-1"><a href="edit.php?publish=1&pub_id=<?= $comment['id'];?>">publish</a></div>
          <?php endif; ?>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
    
    <!--footer-->
    <?php include("../../app/include/footer.php"); ?>
    <!--footer END-->
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>