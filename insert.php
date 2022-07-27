<?php
//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
$name = $_POST['name'];
$email = $_POST['email'];
$category = $_POST['category'];
$brand = $_POST['brand'];
$nayami1 = $_POST['nayami1'];
$nayami_type1 = $nayami1[0];
$nayami_type2 = $nayami1[1];
$nayami_type3 = $nayami1[2];
//nayami1をわけて変数に入れる。

//2. DB接続します 
//mysql dbname意向をphpMyAdminと揃える.localhost rootだけ。
//try後にエラー回避するため。exit後を修正
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=nekojita_an_table;charset=utf8;host=localhost','root','');
  //$pdo = new PDO('mysql:dbname=sato1985_nekojita;charset=utf8;host=mysql57.sato1985.sakura.ne.jp','sato1985','nekojita01');

} catch (PDOException $e) {
  exit('DBConnection Error:'.$e->getMessage());
}

//３．データ登録SQL作成
$stmt = $pdo->prepare("insert into nekojita_an_table(name, email, category, brand, nayami1,nayami2,nayami3, indate) values(:name, :email, :category, :brand, :nayami1,:nayami2,:nayami3, sysdate())");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email', $email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':category', $category, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':brand', $brand, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':nayami1', $nayami_type1, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':nayami2', $nayami_type2, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':nayami3', $nayami_type3, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: index.php");
  exit();
}
?>
