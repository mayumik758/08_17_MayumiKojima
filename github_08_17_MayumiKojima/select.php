<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Watched Films List</title>
<script src="js/jquery-2.1.3.min.js"></script>
<style>div{padding: 10px;font-size:16px;}</style>
<link rel="stylesheet" href="style.css">
</head>
<body id="main">

<header>
<div class="htitle">
  <h1>Film Review</h1>
  <p>Hollywood blockbusters, local greats, European movies, Japanese and Korean dramas, animation, art house films...all the films you watched</p>
</div>
</header>

<div class="wrap">
  <a class="newitem" href="index.php">Add New Item</a>
  <div class="container" id="container">
  </div>
</div>


<?php

// DBに接続
try {
  $pdo = new PDO('mysql:dbname=film_db;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

// データ取得
$stmt = $pdo->prepare("SELECT * FROM myfilm_db");
$status = $stmt->execute();

// データを表示

$view="";
if($status==false) {
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  // JSONにエンコードする
  while( $result[] = $stmt->fetch(PDO::FETCH_ASSOC));
  $json = json_encode($result);
}
?>


<script>
// JSONデータ
const data = JSON.parse('<?=$json?>');
console.log(data);

Object.keys(data).forEach(function(value){
  console.log(data[value]);
  console.log(data[value].title);
  const title = data[value].title;
  const place = data[value].place;
  const date = data[value].date;
  const imdb = data[value].imdb;
  const myscore = data[value].myscore;
  const review = data[value].review;
  const time = data[value].time;
  const img = data[value].imgurl;
  const id = data[value].id;
  
  const list = `
    <div id="content">
      <div id="images">
        <img src="${img}">
      </div>
      <div id="texts">                                
        <ul>
          <li><h3>${title}<h3></li>
          <li>${date} / ${place}</li>
          <li>TMDb: ${imdb} / My Score: ${myscore}</li>
          <li>${review}</li>
          <li>${time}</li>
          <li><a href="renew.php?id=${id}">Change</a>    <a href="delete.php?id=${id}">Delete</a></li>

        </ul>
      </div>
    </div>
    `;

  $("#container").append(list);
})
</script>

</body>
</html>
