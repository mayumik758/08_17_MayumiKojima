<?php

// POSTデータを取得
$name = $_POST["name"];
$title = $_POST["title"];
$date = $_POST["date"];
$place = $_POST["place"];
$imdb = $_POST["imdb"];
$myscore = $_POST["myscore"];
$review = $_POST["review"];
$imgurl = $_POST["url"];

// DB
require "funcs.php";
$pdo = db_cct();

// try{
//   $pdo = new PDO('mysql:dbname=film_db;charset=utf8;host=localhost','root','root');
// } catch (PDOException $e) {
//   exit('DBConnectError:'.$e->getMessage());
// }

$sql = "INSERT INTO myfilm_db(id,username,title,date,place,imdb,myscore,review,imgurl,time)VALUES(NULL,:a1,:a2,:a3,:a4,:a5,:a6,:a7,:a8,current_timestamp())";

$stmt = $pdo->prepare($sql);

$stmt ->bindvalue(':a1',$name, PDO::PARAM_STR);
$stmt ->bindvalue(':a2',$title, PDO::PARAM_STR);
$stmt ->bindvalue(':a3',$date, PDO::PARAM_STR);
$stmt ->bindvalue(':a4',$place, PDO::PARAM_STR);
$stmt ->bindvalue(':a5',$imdb, PDO::PARAM_STR);
$stmt ->bindvalue(':a6',$myscore, PDO::PARAM_STR);
$stmt ->bindvalue(':a7',$review, PDO::PARAM_STR);
$stmt ->bindvalue(':a8',$imgurl, PDO::PARAM_STR);


$status = $stmt->execute();

// 登録処理後のエラー
if($status==false){
  $error = $stmt->errorInfo();
  exit("ErrorMassage:".$error[2]);
}else{
  header('Location: index.php');

}



?>