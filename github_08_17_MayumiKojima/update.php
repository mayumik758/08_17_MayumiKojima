<?php
  // 更新データを取得
  $name = $_POST["name"];
  $title = $_POST["title"];
  $date = $_POST["date"];  
  $place = $_POST["place"];  
  $imdb = $_POST["imdb"];
  $myscore = $_POST["myscore"];
  $review = $_POST["review"];
  $imgurl = $_POST["url"];
  $id = $_POST["id"];

  //DB接続
  require "funcs.php";
  $pdo = db_cct(); 

  $stmt = $pdo->prepare("UPDATE myfilm_db SET username=:a1, title=:a2, date=:a3, place=:a4, imdb=:a5, myscore=:a6, review=:a7, imgurl=:a8 WHERE id=:id");
  $stmt->bindValue(':a1',$name , PDO::PARAM_STR);  
  $stmt->bindValue(':a2', $title, PDO::PARAM_STR);  
  $stmt->bindValue(':a3',$date, PDO::PARAM_STR);  
  $stmt->bindValue(':a4',$place, PDO::PARAM_STR);  
  $stmt->bindValue(':a5',$imdb, PDO::PARAM_STR);  
  $stmt->bindValue(':a6',$myscore, PDO::PARAM_STR);  
  $stmt->bindValue(':a7',$review, PDO::PARAM_STR);
  $stmt->bindValue(':a8',$imgurl, PDO::PARAM_STR);
  $stmt->bindValue(':id',$id , PDO::PARAM_INT);

  $status = $stmt->execute();

  if($status==false) {
    sql_error($stmt);
  }else{

   //一覧ページへ戻る
   redirect('select.php');
  }

  
  ?>