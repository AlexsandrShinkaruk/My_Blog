<?php

session_start();
require('connect.php');

function tt($value){
    echo '<pre>';
    print_r($value);
    echo '</pre>';
    exit();
}

function tte($value){
    echo '<pre>';
    print_r($value);
    echo '</pre>';
}

// Проверка выполнения запроса к БД
function dbCheckError($query){
    $errinfo = $query->errorinfo();
    if ($errinfo[0] !== PDO::ERR_NONE){
        echo $errinfo[2];
        exit();
    }
    return true;
}

// Запрос на получение с одной таблицы
function selectall($table, $params = []){
    global $pdo;
    $sql = "SELECT * FROM $table";

    if (!empty($params)){
        $i = 0;
        foreach ($params as $key => $value){
            if (!is_numeric($value)){
                $value = "'".$value."'";
            }
            if ($i === 0){
                    $sql = $sql . " WHERE $key = $value";
            } else {
                    $sql = $sql . " AND $key = $value";
            }
            $i++;
        }
    }
   
    $query =  $pdo->prepare($sql);
    $query->execute();    
    dbCheckError($query);
    return $query->fetchAll();
}

// Запрос на получение одной строки с выбранной таблицы
function selectOne($table, $params = []){
    global $pdo;
    $sql = "SELECT * FROM $table";

    if (!empty($params)){
        $i = 0;
        foreach ($params as $key => $value){
            if (!is_numeric($value)){
                $value = "'".$value."'";
            }
            if ($i === 0){
                    $sql = $sql . " WHERE $key = $value";
            } else {
                    $sql = $sql . " AND $key = $value";
            }
            $i++;
        }
    }
    //$sql = $sql . "LIMIT 1";
    $query =  $pdo->prepare($sql);
    $query->execute();    
    dbCheckError($query);
    return $query->fetch();
}

// Запись в таблицу БД

function insert($table, $params){
    global $pdo;
    $i = 0;
    $coll = '';
    $mask = '';
    foreach($params as $key => $value){
        if ($i === 0){
            $coll = $coll . "$key";
            $mask = $mask . "'" . "$value" . "'";
        } else {
            $coll = $coll . ", $key";
            $mask = $mask .", '" . "$value" . "'";
        }        
        $i++;
    }

    $sql = "INSERT INTO $table ($coll) VALUES ($mask)";
     
    $query =  $pdo->prepare($sql);
    $query->execute();    
    dbCheckError($query);
    return $pdo->lastInsertId();
}

// Обновление строки в таблицу
function update($table, $id, $params){
    global $pdo;
    $i = 0;
    $str = '';
    foreach($params as $key => $value){
        if ($i === 0){
            $str = $str . $key . " = '" . $value . "'";
        } else {
            $str = $str . ", " . $key . " = '" . $value . "'";
        }        
        $i++;
    }

    $sql = "UPDATE $table SET $str WHERE id = $id";

    $query =  $pdo->prepare($sql);
    $query->execute();    
    dbCheckError($query);
}

// Удаление строки в таблицу
function delete($table, $id){
    global $pdo;
    //DELETE FROM `users` WHERE id_user = 8
    $sql = "DELETE FROM $table WHERE id =" . $id;

    $query =  $pdo->prepare($sql);
    $query->execute();    
    dbCheckError($query);
}

//Выборка записей (posts) с автором в админку

function selectAllFromPostsWithUsers($table1, $table2){
    global $pdo;
    $sql = "
    SELECT 
    t1.id,
    t1.title,
    t1.img,
    t1.content,
    t1.status,
    t1.id_topic,
    t1.created_date,
    t2.username
    FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_user = t2.id";
    $query =  $pdo->prepare($sql);
    $query->execute();    
    dbCheckError($query);
    return $query->fetchAll();
}

//Выборка записей (posts) с автором на главную

function selectAllFromPostsWithUsersOnIndex($table1, $table2, $limit, $offset){
    global $pdo;
    $sql = "SELECT p.*, u.username FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id WHERE p.status=1 LiMIT $limit OFFSET $offset";
    $query =  $pdo->prepare($sql);
    $query->execute();    
    dbCheckError($query);
    return $query->fetchAll();
}

//Выборка записей в ТОП(posts) с автором 

function selectTopTopicFromPostsOnIndex($table1){
    global $pdo;
    $sql = "SELECT * FROM $table1 WHERE id_topic = 10";
    $query =  $pdo->prepare($sql);
    $query->execute();    
    dbCheckError($query);
    return $query->fetchAll();
}

//Поиск по заголовку и содержимому

function searchInTitleAndContent($text, $table1, $table2){
    $text = trim(strip_tags(stripslashes(htmlspecialchars($text))));
    global $pdo;
    $sql = "SELECT 
    p.*, u.username 
    FROM $table1 AS p 
    JOIN $table2 AS u ON p.id_user = u.id 
    WHERE p.status=1 AND p.title LIKE '%$text%' OR p.content LIKE '%$text%'";

    $query =  $pdo->prepare($sql);
    $query->execute();    
    dbCheckError($query);
    return $query->fetchAll();
}


//Выборка записи (posts) с автором на single

function selectPostFromPostsWithUsersOnSingle($table1, $table2, $id){
    global $pdo;
    $sql = "SELECT p.*, u.username FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id WHERE p.id=$id";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetch();
}

//Пагинация

function countRow($table){
    global $pdo;
    $sql = "SELECT COUNT(*) FROM $table WHERE status = 1";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchColumn();
}