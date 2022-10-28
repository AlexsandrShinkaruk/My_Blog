<?php session_start();
    include "../../path.php"; 
    include "../../app/controllers/topics.php";
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
        <div class="button-row">
          <a href="<?php echo BASE_URL . "admin/topics/create.php";?>" class="col-3 btn btn-success">Создать</a>
          <span class="col-1"></span>
          <a href="<?php echo BASE_URL . "admin/topics/index.php";?>" class="col-3 btn btn-warning">Редактировать</a>
        </div>
        <div class="row title-table">
          <h2>Создать категорию</h2>        
        </div>
        <div class="row add-post">
          <div class="mb-12 col-12 col-md-12 err">
              <!-- Вывод массива с ошибками -->
              <?php include "../../app/helps/errorInfo.php"; ?>
          </div>
          <form action="edit.php" method="post">
            <input name="id" value="<?=$id;?>" type="hidden">
            <div class="col">
                <input name="name" value="<?=$name;?>" type="text" class="form-control" placeholder="Имя категории" aria-label="Название категории">
            </div>
            <div class="col">
                <label for="content" class="form-label">Описание категории</label>
                <textarea name="description" class="form-control" id="content" rows="6"><?=$description;?></textarea>
            </div>
            <div class="col">
                <button name="topic-edit" class="btn btn-primary" type="submit">Обновить категорию</button>
            </div>
          </form>
        </div>        
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