<?php include "path.php"; 
      include "app/controllers/topics.php";
      $posts = selectall('posts', ['id_topic' => $_GET['id']]);
      $topTopic = selectTopTopicFromPostsOnIndex('posts');
      $category = selectOne('topics', ['id' => $_GET['id']]);
   // tt($category);
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
    <link rel="stylesheet" href = "assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>My blog</title>
  </head>
  <body>
 
  <?php include("app/include/header.php"); ?>
   

    <!--блок main START-->
    <div class="container">
      <div class="content row">
        <!--Main Content-->
        <div class="main-content col-md-9 col-12">
          <h2>Статьи с раздела <?= $category['name'];?></h2>
          <?php foreach ($posts as $post): ?>
          <div class="post row">
            <div class="img col-12 col-md-4"> 
              <img src="<?=BASE_URL . 'assets/images/posts/' . $post['img']?>" alt="<?=$post['title']?>" class="img-thumbnail" > 
            </div>
            <div class="post_text col-12 col-md-8">
              <h3>
                <a href="<?=BASE_URL . 'single.php?post=' . $post['id'];?>"><?=mb_substr($post['title'], 0, 80, 'UTF-8') . '...' ?></a>
              </h3>
              <i class="far fa-user"> <??></i>
              <i class="far fa-calendar"> <?=$post['created_date'];?></i>
              <p class="preview-text">
                <?=mb_substr($post['content'], 0, 55, 'UTF-8') . '...' ?>
              </p>
            </div>
          </div>
          <?php endforeach; ?>
                             
        </div>
        <!-- sidebar Content-->
        <div class="sidebar col-md-3 col-12">

          <div class="section search">
            <h3>Поиск</h3>
            <form action="search.php" method="post">
              <input type="text" name="search-term" class="text-input" placeholder="Введите искомое слово...">
            </form>
          </div>

          <div class="section topics">
            <h3>Категории</h3>
            <ul>
              <?php foreach($topics as $key => $topic): ?>
              <li>
                <a href="<?=BASE_URL . 'category.php?id=' . $topic['id']; ?>"><?=$topic['name']; ?></a>
              </li>
              <?php endforeach; ?>
            </ul>
          </div>

        </div>
      </div>
    </div>
    
    <!--блок mane END-->
    <!--footer-->
    <?php include("app/include/footer.php"); ?>
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