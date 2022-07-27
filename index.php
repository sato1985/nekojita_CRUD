<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ペットフード入力</title>
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

<?php
$category     = array();
$category[1]  = '機能食';
$category[2]  = 'グルメ';
$category[3]  = '療法食';
$brand  = array();
$brand[1]  = 'ロイヤルカナン';
$brand[2]  = 'ヒルズ';
$brand[3]  = 'ペットライン';
session_start();
$mode = 'input';
$errmessage = array();
if( isset($_POST['back']) && $_POST['back'] ){
  // 何もしない
} else if( isset($_POST['confirm']) && $_POST['confirm'] ){
  // 確認画面
  if( !$_POST['name'] ) {
    $errmessage[] = "名前を入力してください";
  } else if( mb_strlen($_POST['name']) > 100 ){
    $errmessage[] = "名前は100文字以内にしてください";
  }
  $_SESSION['name']	= htmlspecialchars($_POST['name'], ENT_QUOTES);

  if( !$_POST['email'] ) {
    $errmessage[] = "Eメールを入力してください";
  } else if( mb_strlen($_POST['email']) > 200 ){
    $errmessage[] = "Eメールは200文字以内にしてください";
  } else if( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ){
    $errmessage[] = "メールアドレスが不正です";
  }
  $_SESSION['email']	= htmlspecialchars($_POST['email'], ENT_QUOTES);

  if( !$_POST['category'] ) {
    $errmessage[] = "カテゴリを入力してください";
  } else if( $_POST['category'] <= 0 || $_POST['category'] >= 4 ){
    $errmessage[] = "カテゴリが不正です";
  }
  $_SESSION['category']	= htmlspecialchars($_POST['category'], ENT_QUOTES);

  if( !isset($_POST['brand']) || !$_POST['brand'] ) {
    $errmessage[] = "悩みを選んでください";
  } else if( $_POST['brand'] <= 0 || $_POST['brand'] >= 4 ){
    $errmessage[] = "悩みが不正です";
  }
  if( isset($_POST['brand']) ){
    $_SESSION['brand']	= htmlspecialchars($_POST['brand'], ENT_QUOTES);
  }

  if( isset($_POST['nayami1']) && mb_strlen($_POST['nayami1']) > 100 ) {
    $errmessage[] = "ブランド1が不正です";
  }
  if( isset($_POST['nayami1']) ){
    $_SESSION['nayami1']	= htmlspecialchars($_POST['nayami1'], ENT_QUOTES);
  } else {
    $_SESSION['nayami1']	= "";
  }


  
 
  if( $errmessage ){
    $mode = 'input';
  } else {
    $token = bin2hex(random_bytes(32));            
    $_SESSION['token']  = $token;
    $mode = 'confirm';
  }
} else if( isset($_POST['send']) && $_POST['send'] ){
  // 送信ボタンを押したとき
  if( !$_POST['token'] || !$_SESSION['token'] || !$_SESSION['email'] ){
    $errmessage[] = '不正な処理が行われました';
    $_SESSION     = array();
    $mode         = 'input';
  } else if( $_POST['token'] != $_SESSION['token'] ){
    $errmessage[] = '不正な処理が行われました';
    $_SESSION     = array();
    $mode         = 'input';
  } else {
    $message = "お問い合わせを受け付けました \r\n"
           . "名前: " . $_SESSION['name'] . "\r\n"
           . "email: " . $_SESSION['email'] . "\r\n"
           . "カテゴリ: " . $category[ $_SESSION['category'] ] . "\r\n"
           . "ブランド: " . $brand[ $_SESSION['brand'] ] . "\r\n"
           . "ペットの悩み: \r\n"
           . "" . $_SESSION['nayami1']. "\r\n"
           . "お問い合わせ内容:\r\n"
           . preg_replace( "/\r\n|\r|\n/", "\r\n", $_SESSION['message'] );
    mail( $_SESSION['email'], 'お問い合わせありがとうございます', $message );
    mail( 'tanaka.com', 'お問い合わせありがとうございます', $message );
    $_SESSION = array();
    $mode     = 'send';
  }
} else {
  $_SESSION['name'] = "";
  $_SESSION['email']    = "";
  $_SESSION['category']    = "";
  $_SESSION['brand']  = "";
  $_SESSION['nayami1']  = "";
  $_SESSION['message']  = "";
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>お問い合わせフォーム</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <style>
    body{
      padding: 10px;
      max-width: 600px;
      margin: 0px auto;
    }
    div.button{
      text-align: center;
    }
  </style>
</head>
<body>
<?php if( $mode == 'input' ){ ?>
  <!-- 入力画面 -->
  <?php
  if( $errmessage ){
    echo '<div class="alert alert-danger" role="alert">';
    echo implode('<br>', $errmessage );
    echo '</div>';
  }
  ?>
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
  </form>
<?php } else if( $mode == 'confirm' ){ ?>
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
    <input type="submit" name="send" value="送信" class="btn btn-primary btn-lg"/>
  </form>
<?php } else { ?>
  <!-- 完了画面 -->
  入力ありがとうございました。<br>
<?php } ?>
</body>
</html>



</body>
</html>


<!-- Main[Start] -->
<!-- <form method="post" action="insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>使用商品入力</legend>
     <label>名前：<input type="text" name="name"></label><br>
     <label>Email：<input type="text" name="email"></label><br>
     <label>カテゴリ：<input type="text" name="category"></label><br>
     <label>ブランド：<input type="text" name="brand"></label><br>
     <label>SKU：<input type="text" name="sku"></label><br>
     <label>ペットの悩み①：<input type="text" name="brand"></label><br>
     <label>ペットの悩み②：<input type="text" name="nayami1"></label><br>
     <label>ペットの悩み③：<input type="text" name="nayami3"></label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form> -->
<!-- Main[End] -->