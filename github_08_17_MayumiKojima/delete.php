<?php

$id = $_GET["id"];

require "funcs.php";
$pdo = db_cct();

$stmt = $pdo->prepare("DELETE FROM myfilm_db WHERE id=:id");
$stmt->bindValue(':id',$id , PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false) {
  sql_error($stmt);
}else{
 redirect('select.php');
}

?>