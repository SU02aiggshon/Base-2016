<?php
/**
 * Created by PhpStorm.
 * User: Slagga
 * Date: 2017/4/23
 * Time: 13:18
 */
// 连接数据库
$db = new Pdo('mysql:host=localhost;port=3306;dbname=test', 'root', '') or die("Can't connect mysql.");
$window = '7';
$sth = $db->prepare("delete from users where verified = 0 and timestamp(created_on) < timestamp(CURDATE() - ?);");
$res = $sth->execute([$window]);
if ($res) {
    print "Deactivated " . $sth->rowCount() . " users.\n";
} else {
    print "Can't delete users. \n";
}







