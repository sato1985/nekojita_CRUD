<?php
//１．PHP
//select.phpの[PHPコードだけ！]をマルっとコピーしてきます。
//※SQLとデータ取得の箇所を修正します。
$id= $_GET["id"];

///////////////////
include("funcs.php");  //funcs.phpを読み込む（関数群）
$pdo = db_conn();      //DB接続関数

//２．データ登録SQL作成
$stmt   = $pdo->prepare("SELECT * FROM nekojita_an_table WHERE id=:id"); //SQLをセット
$stmt->bindValue(':id',   $id,    PDO::PARAM_INT);
$status = $stmt->execute(); //SQLを実行→エラーの場合falseを$statusに代入


//３．データ表示
$view=""; //HTML文字列作り、入れる変数
if($status==false) {
  //SQLエラーの場合
  sql_error($stmt);
}else{
  //SQL成功の場合
  $row = $stmt->fetch(); // １つのデータを取り出して $row に格納
}
var_dump($row);



?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ更新</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form action="./insert.php" method="post">
    名前    <input type="text"    name="name" value="<?php echo $_SESSION['name'] ?>"  class="form-control"><br>
    Eメール <input type="email"   name="email"    value="<?php echo $_SESSION['email'] ?>"  class="form-control"><br>
    カテゴリ:
    <select name="category" class="form-control">
    <?php foreach( $category as $i => $v ){ ?>
      <?php if( $_SESSION['category'] == $i ) { ?>
            <option value="<?php echo $i ?>" selected><?php echo $v ?></option>
      <?php } else { ?>
            <option value="<?php echo $i ?>" ><?php echo $v ?></option>
      <?php } ?>
    <?php } ?>
    </select><br>
    使用しているブランドを教えてください<br>
    <?php foreach( $brand as $i => $v ){ ?>
      <?php if( $_SESSION['brand'] == $i ){ ?>
        <label><input type="radio" name="brand" value="<?php echo $i ?>" checked><?php echo $v ?></label><br>
      <?php } else { ?>
        <label><input type="radio" name="brand" value="<?php echo $i ?>" ><?php echo $v ?></label><br>
      <?php } ?>
    <?php } ?>
    ペットの悩みをチェックしてください<br>
    <label><input type="checkbox" name="nayami1[]" value="食べてくれない" checked>食べてくれない</label><br>
    <label><input type="checkbox" name="nayami1[]" value="抜け毛が多い" checked>抜け毛が多い</label><br>
    <label><input type="checkbox" name="nayami1[]" value="腎臓ケア" checked>腎臓ケア</label><br>

    <div class="button">
    <input type="submit" name="confirm" value="確認" class="btn btn-primary btn-lg"/>
    </div>
  </form> //
   <?php  else <if>( 1mode == 'confirm' )</if> ?>
  <!-- 確認画面 -->
  <form action="./insert.php" method="post">
    <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
    名前    <?php echo $_SESSION['name'] ?><br>
    Eメール <?php echo $_SESSION['email'] ?><br>
    カテゴリ <?php echo $category[ $_SESSION['category'] ] ?><br>
    ブランド <?php echo $brand[ $_SESSION['brand'] ] ?><br>
    ペットの悩み<br>
    <?php echo $_SESSION['nayami1'] ?><br>
    お問い合わせ内容<br>
    <?php echo nl2br($_SESSION['message']) ?><br>
    <input type="submit" name="back" value="戻る" class="btn btn-primary btn-lg"/>
    <input type="hidden" name="id" value="<?=$row["id"]?>">
    <input type="submit" name="send" value="送信" class="btn btn-primary btn-lg"/>
  </form>



<!-- <form method="POST" action="update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>フリーアンケート</legend>
     <label>名前：<input type="text" name="name" value="<?=$row["name"]?>"></label><br>
     <label>Email：<input type="text" name="email" value="<?=$row["email"]?>"></label><br>
     <label>カテゴリ：<input type="text" name="category" value="<?=$row["category"]?>"></label><br>
     <label>ブランド：<input type="text" name="brand" value="<?=$row["brand"]?>"></label><br>

     idを隠して送信
     <input type="hidden" name="id" value="<?=$row["id"]?>">
     idを隠して送信
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form> -->
<!-- Main[End] -->


</body>
</html>




