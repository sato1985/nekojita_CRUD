<?php
//1. POSTデータ取得
$name   = $_POST["name"];
$email = $_POST["category"];
$category = $_POST["category"];
$brand    = $_POST["brand"];   //今回追加してます
$nayami1  = $_POST["nayami1"];
$id    = $_POST["id"];   //idを取得

//2. DB接続します
include("funcs.php");  //funcs.phpを読み込む（関数群）
$pdo = db_conn();      //DB接続関数


//３．データ登録SQL作成
$sql = "update nekojita_an_table set name=:name, email=:email, category=:category, brand=:brand, nayami1=:nayami1, nayami2=:nayami2, nayami3=:nayami3, where id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email', $email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':category', $category, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':brand', $brand, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':nayami1', $nayami_type1, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':nayami2', $nayami_type2, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':nayami3', $nayami_type3, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id',$id,  PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect("select.php");
}

?>
