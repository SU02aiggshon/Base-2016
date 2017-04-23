<?php
/**
 * Created by PhpStorm.
 * User: Slagga
 * Date: 2017/4/23
 * Time: 13:02
 */
$db = new Pdo('mysql:host=localhost;port=3306;dbname=test', 'root', '') or die("Can't connect mysql.");
$sth = $db->prepare('Update users set verified = 1 where email = ? and verify_string = ? and verified = 0');
$res = $sth->execute([$_GET['email'], $_GET['verify_string']]);
var_dump($res, $sth->rowCount());
if (!$res) {
    print "Please try again later due to a database error.";
} else {
    if ($sth->rowCount() == 1) {
        print "Thank you , your account is verified.";
    } else {
        print "Sorry, you could not be verified.";
    }
}
















