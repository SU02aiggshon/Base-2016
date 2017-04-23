<?php
/*
 * Web 基础
 */
//8.2 读取 cookie 值
if (isset($_COOKIE['flavor'])) {
    print "You ate a {$_COOKIE['flavor']} cookie.";
}

//8.3 删除 cookie
setcookie('flavor', '', 1);

//8.4 构建查询字符串
$vars = ['name' => 'Oscar the Grouch', 'color' => 'green', 'favorite_punctuation' => '#'];
$query_string = http_build_query($vars);
$url = '/muppet/select.php?' . $query_string;
print "$url \n";

//8.5 读取 POST 请求体
$body = file_get_contents('php://input');
print "$body \n";

//8.6 使用 HTTP 基本或摘要认证
function validate($user, $pass)
{
    /* 可以替换为适当的用户名和密码检查， 如检查一个数据库 */
    $users = ['david' => 'fadj&32', 'adam' => '8HEj838', 'admin' => 'admin'];
    if (isset($users[$user]) && ($users[$user] === $pass)) {
        return true;
    } else {
        return false;
    }
}

if (!validate($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])) {
    http_response_code(401);
    header('WWW-Authenticate: Basic realm="My Website"');
    echo "You need to enter a valid username and password.";
    exit();
}

//8.7 使用 cookie 认证
$secret_word = 'if i ate spinach';
if (validate('david', 'fadj&32')) {
    setcookie('login', 'david' . ',' . md5('david' . $secret_word));
}

//验证一个 cookie
unset($username);
if (isset($_COOKIE['login'])) {
    list($c_username, $cookie_hash) = explode(',', $_COOKIE['login']);
    if (md5($c_username . $secret_word) == $cookie_hash) {
        $username = $c_username;
    } else {
        print "You have sent a bad cookie.";
    }
}

if (isset($username)) {
    print "Welcome, $username. \n";
} else {
    print "Welcome, anonyous user.";
}
//error_log('abcdefg');

//8.8 读取 HTTP 首部
echo "<br />" . $_SERVER['HTTP_USER_AGENT'] . "<br />";
$headers = getallheaders();
echo $headers['User-Agent'] . "<br />";

//8.9 写 HTTP 首部
header('Contetn-Type: image/png');
header('WWW-Authenticate: Basic realm="http://server.example.com/"');
header('WWW-Authenticate: OAuth realm="http://server.example.com/"', true);

//8.10 发送一个特定的 HTTP 状态码
//http_response_code(401);

//8.11 重定向到不同的位置
//header('Location: http://www.example.com/confirm.html');
//exit;

//8.12 浏览器刷新输出
print str_repeat(' ', 300);
print "Finding identical snowflakes... <br />";
flush();
echo "select <br />";

//8.13 浏览器缓冲输出
ob_start();
echo "I haven't decided if I want to send a cookie yet. <br />";
//setcookie('heron', 'great blue');
echo "Yes, sending that cookie was the right decision. <br />";
ob_end_flush();

//8.14 压缩 Web 输出    php.ini 文件配置
//zlib.output_compression=1     开启压缩
//zlib.output_compression_level=1
//zlib.output_compression_level=1   压缩级别越高 服务器发送给浏览器的数据越少，压缩数据所需的服务器 CPU 时间也越多

//8.15 读取环境变量   出于速度方面的考虑，默认 $_ENV 不可用
print getenv('PATH') . "<br />";
print getenv('HOME') . "<br />";
//print $_ENV['USER']."<br />";

//8.16 PHP 设置环境变量   Apache 设置环境变量
putenv('ORACLE_SID=ORACLE');
print getenv('ORACLE_SID') . "<br />";

apache_setenv('ORACLE_SID', 'ORACLE');
print apache_getenv('ORACLE_SID') . "<br />";

//8.17 Apache 内部通信
$session = session_id();
apache_note('session', $session);  //设置值
$session = apache_note('session');  //获取值
print "$session <br />";

//8.18 将移动浏览器重定向到专为移动设备优化的网站
//print get_browser()."<br />";
print $_SERVER['HTTP_USER_AGENT'] . "<br />";


