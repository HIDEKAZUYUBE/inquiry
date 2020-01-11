<?php
if($_SERVER['REQUEST_METHOD'] != 'POST') {
    //POSTでアクセスできない場合
    $name = '';
    $email = '';
    $subject = '';
    $err_msg = '';
    $complete_msg = '';

} else {
    //POST処理、入力された値を取得する
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    //エラーメッセージ及び完了メッセージ
    $err_msg = '';
    $complete_msg = '';

    //空チェック
    if ($name == '' || $email == '' || $subject == '' || $message == '') {
        $err_msg = '全ての項目を入力してください。';
}

    //全ての項目が入力されている
    if($err_msg == '') {
       $to =  ''; //送信先の指定
       $headers = "from: " . $email . "\r\n";

       //本文の最後に名前を追加
       $messege .= "\r\n\r\n" . $name;

       //メール送信
       mb_send_mail($to, $subject, $message, $headers);

       //完了メッセージ
       $complete_msg = '送信されました';

       //全てクリア
       $name = '';
       $email = '';
       $subject = '';
       $message = '';
    }
}
?>

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="utf-8">
    <title>お問い合わせフォーム</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP" rel="stylesheet">
    <style>
       body {
           background: #f3f3f3;
       }
       .container {
           font-family: "Noto Sans JP";
           margin-top: 60px;
       }
       h1 {
           margin-bottom: 50px;
           text-align: center;
       }
       button {
           margin-top: 30px;
       }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-xs-offset-4 col-xs-4">
            <h1>お問い合わせ</h1>

            <?php if ($err_msg != ''): ?>
                <div class="alert alert-danger">
                    <?php echo $err_msg; ?>
                </div>
            <?php endif; ?>

            <?php if ($complete_msg != ''): ?>
                <div class="alert alert-success">
                    <?php echo $complete_msg; ?>
            </div>
            <?php endif; ?>

            <form method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="お名前" value="<?php echo $name; ?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="email" placeholder="メールアドレス" value="<?php echo $email; ?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="subject" placeholder="件名" value="<?php echo $subject; ?>">
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="message" rows="5" placeholder="本文"><?php echo $message; ?></textarea>
                </div>
                <button type="submit" class="btn btn-success btn-block">送信</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>