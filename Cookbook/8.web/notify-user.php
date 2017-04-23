<?php
/**
 * Created by PhpStorm.
 * User: Slagga
 * Date: 2017/4/21
 * Time: 21:51
 */
//8.19 网站账户激活（撤销）系统
$db = new Pdo('mysql:host=localhost;port=3306;dbname=test', 'root', '') or die("Can't connect mysql.");
$email = 'david';
//生成 verrify_string
$verify_string = '';
for ($i = 0; $i < 16; $i++) {
    $verify_string .= chr(mt_rand(32, 126));
}
//插入数据库
$sth = $db->prepare("Insert into users " . "(email,created_on,verify_string,verified) " . "values (?,now(),?,0)");
$sth->execute([$email, $verify_string]);
$verify_string = urlencode($verify_string);
$safe_email = urlencode($email);
$verify_url = "http://www.example.com/verify-user.php";
$mail_body = <<<_MAIL_
To $email:
Please click on the following link to verify your account creation:
$verify_url?email=$safe_email&verify_string=$verify_string
If you do not verify your account in the next seven days, it will be deleted.
_MAIL_;

//mail($email, "User Verification", $mail_body);    //使用内置函数发送邮件
print "$mail_body <br />";











