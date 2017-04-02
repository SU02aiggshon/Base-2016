<?php
// \0 到 \777 为八进制    \x0 到 \xFF 为十六进制 
//header('Content-type:text/html;charset:utf-8;');
error_reporting(~E_NOTICE);

//1-0 示例 引言
print 'I have gone to the store.';
print 'I\'ve gone to the store.';
print 'Would you pay $1.75 for 8 ounces of tap water?';
print 'In double-quoted strings, newline is represented by \n';
print "<hr />";

//1-1 示例 双引号字符串
print "I've gone to the store.";
print "The sauce cost $10.25.";
$cost = '$10.25';
print "The sauce cost $cost";
print "The sauce cost \$\061\060.\x32\x35.";
print "<hr />";

//1-2 示例 定义一个 here 文档
print <<< END
It's funny when signs say things like:
  Original "Root" Bear
  "Free" Gift
  Shoes cleaned while "you" wait
or have other misquoted words.
END;
print "<hr />";

//1-3 示例 更多 here 文档
print <<< PARSLEY
It's easy to grow fresh:
Parsley
Chives
on your windowsill
PARSLEY;

print <<< DOGS
If you like pets, yell out:
DOGS AND CATS ARE GREAT!
DOGS;
print "<hr />";

//1-4 示例 使用 here 文档输出 HTML
if ($remaining_cards > 0) {
    $url = '/deal.php';
    $text = 'Deal More Cards';
} else {
    $url = '/new-game.php';
    $text = 'Start a New Game';
}
print <<< HTML
There are <b>$remainning_cards</b> left.
<p>
<a href=' $url' >$text</a>
HTML;
print "<hr />";

//1-5 示例 使用 here 文档连接字符串
$divClass = 'class1';
$ulClass = 'class2';
$listItem = 'The List Item ';
$html = <<< END
<div class="$divClass">
<ul class="$ulClass">
<li>
END
    . $listItem . '</li></div>';
print $html;

$js = <<< __JS__
$.ajax({
	'url': '/api/getStock',
	'data': {
		'ticker': 'LNKD'
	},
	'': function( data ) {
		$( "#stock-price" ).html( "<strong>$" + data + "</strong>" );
	}
});
__JS__;
print $js;
print "<hr />";

//1-6 示例 获取字符串的单个字节
$neighbor = 'Hilda';
print $neighbor[3];
print "<hr />";

//1-7 示例 使用 strpos() 查找子串
if (strpos($_POST['email'], '@') === false) {
    print 'There was no @ in the e-mail address!';
}
print "<hr />";

//1-8 示例 用 substr() 抽取子串
$substring = substr($string, $start, $length);
$username = substr($_GET['username'], 0, 8);
print $username;
print "<hr />";

//1-9 示例 使用 substr() ($start,$length 为正数)
print substr('watch out for that tree', 6, 5);
print "<hr />";

//1-10 示例 使用 substr() (起始位置为正数，未指定长度)
print substr('watch out fot that tree', 17);
print "<hr />";

//1-11 示例 使用 substr() (长度超过字符串末尾)
print substr('watch out for that tree', 20, 5);
print "<hr />";

//1-12 示例 使用 substr() (起始位置为负数)
print substr('watch out for that tree', -6);
print substr('watch out for that tree', -17, 5);
print "<hr />";

//1-13 示例 使用 substr() (长度为负数)
print substr('watch out for that tree', 15, -2);
print substr('watch out for that tree', -4, -1);
print "<hr />";

//1-14 示例 使用 substr_replace() 替换子串
$new_string = substr_replace($old_string, $new_substring, $start);
$new_string = substr_replace($old_string, $new_substring, $start, $length);

print substr_replace('My pet is a blue dog.', 'fish.', 12);
print substr_replace('My pet is a blue dog.', 'green', 12, 4);
$credit_card = '4111 1111 1111 1111';
print substr_replace($credit_card, 'xxxx', 0, strlen($credit_card) - 4);

print substr_replace('My pet is a blue dog.', 'fish.', -9);
print substr_replace('My pet is a blue dog.', 'green', -9, 4);
print substr_replace('My pet is a blue dog.', 'Title: ', 0, 0);
print "<hr />";

//1-15 示例 用省略号显示长文本
$mysqli = new mysqli('localhost', 'root', 'root', 'test');
$mysqli->query('set names utf8;');
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
if ($result = $mysqli->query('SELECT id,content FROM messages WHERE id = 1')) {
    while ($row = $result->fetch_assoc()) {
        printf('<a href="more-text.php?id=%d">%s</a>',
            $row['id'], substr_replace($row['content'], ' ...', 25));
    }
}
print "<hr />";

//1-16 示例 处理字符串中的各个字节
$string = "This weekend, I'm going shopping for a pet chicken.";
$vowels = 0;
for ($i = 0, $j = strlen($string); $i < $j; $i++) {
    if (strpos('aeiouAEIOU', $string[$i]) !== false) {
        $vowels++;
    }
}
echo $vowels;
print "<hr />";

//1-17 示例 Look and Say 序列
function lookandsay($s)
{
    $r = '';
    $m = $s[0];
    $n = 1;

    for ($i = 1, $j = strlen($s); $i < $j; $i++) {
        if ($s[$i] == $m) {
            $n++;
        } else {
            $r .= $n . $m;
            $m = $s[$i];
            $n = 1;
        }
    }
    return $r . $n . $m;
}

for ($i = 0, $s = 1; $i < 10; $i++) {
    $s = lookandsay($s);
    print("$s\n");
}
print "<hr />";

//1-18 示例 按字节反转字符串
print strrev('This is not a palindrome.');
print "<hr />";

//1-19 示例 按单词反转字符串
$s = "Once upon a time there was a turtle.";
$words = explode(' ', $s);
$words = array_reverse($words);
$s = implode(' ', $words);
print $s;
print "<hr />";

//1-20 示例 按单词反转字符串的简洁代码
$reverse_s = implode(' ', array_reverse(explode(' ', $s)));
echo $reverse_s;
print "<hr />";

//1.6 示例 生成一个随机字符串(PHP 内置函数只有生成随机数，没有随机字符串)
function str_rand($length = 32, $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
{
    if (!is_int($length) || $length < 0) {
        return false;
    }

    $characters_length = strlen($characters) - 1;
    $string = '';
    for ($i = $length; $i > 0; $i--) {
        $string .= $characters[mt_rand(0, $characters_length)];
    }
    return $string;
}

echo str_rand() . "\n";
echo str_rand(16, '.-') . "\n";
print "<hr />";

//1-21 示例 替换制表符和空格
$s = 'This 	is 	a 	cat.';
$tabbed = str_replace(' ', "\t", $s);
$spaced = str_replace("\t", ' ', $s);
print "With Tabs: <pre>$tabbed</pre>";
print "With Spaces: <pre>$spaced</pre>";
print "<hr />";

//1-22 示例 替换制表符
function tab_expand($text)
{
    while (strstr($text, "\t")) {
        $text = preg_replace_callback('/^([^\t\n]*)(\t+)/m', 'tab_expand_helper', $text);
    }
    return $text;
}

function tab_expand_helper($matches)
{
    $tab_stop = 4;
    return $matches[1] . str_repeat(' ', strlen($matches[2])) * $tab_stop - (strlen($matches[1] % $tab_stop));
}

$spaced = tab_expand($s);
print $spaced;
print "<hr />";

//1-23 示例 替换空格
function tab_unexpand($text)
{
    $tab_stop = 8;
    $lines = explode("\n", $text);
    foreach ($lines as $i => $line) {
        $line = tab_expand($line);
        $chunks = str_split($line, $tab_stop);
        $chunkCount = count($chunks);

        for ($j = 0; $j < $chunkCount - 1; $j++) {
            $chunks[$j] = preg_replace('/ {2,}$/', "\t", $chunks[$j]);
        }
        if ($chunks[$chunkCount - 1] == str_repeat(' ', $tab_stop)) {
            $chunks[$chunkCount - 1] = "\t";
        }
        $lines[$i] = implode('', $chunks);
    }
    return implode("\n", $lines);
}

$tabbed = tab_unexpand($s);
print $tabbed;
print "<hr />";

//1-24 示例 首字母大写
print ucfirst("how do you do today?");
print ucwords("the prince of wales");
print "<hr />";

//1-25 示例 改变字符串的大小写
print strtoupper("i'm not yelling!");
print strtolower('<A HREF="ONE.PHP">ONE</A>');
print "<hr />";

//1-26 示例 字符串链接
print 'You have ' . ($_POST['boys'] + $_POST['girls']) . ' childen.';
print "The word '$s' is " . strlen($s) . ' characters long.';
print 'You owe ' . $amounts['payment'] . ' immediately.';
print "My circle's diameter is inches.<br />";
print <<< END
Right now, the time is 
END
    . strftime('%c') . <<< END
 but tomorrow is will be 
END
    . strftime('%c', time() + 86400);
print "<hr />";

//1.10 示例 去掉字符串首尾的空格
$str = ' abcde ';
print trim($str);
print ltrim($str);
print rtrim($str);
print "<hr />";

//1-27 示例 生成逗号分割数据
$sales = [
    ['Northeast', '2015-01-01', '2015-02-01', 12.54],
    ['Northwest', '2015-01-01', '2015-02-01', 546.33],
    ['Southeast', '2015-01-01', '2015-02-01', 93.26],
    ['Southwest', '2015-01-01', '2015-02-01', 945.21],
    ['All Regions', '--', '--', 1597.34]
];
$filename = './sales.csv';
$fh = fopen($filename, 'w') or die("Can't open $filename.");
foreach ($sales as $sales_line) {
    if (fputcsv($fh, $sales_line) === false) {
        die("Can't write CSV line.");
    }
}
print "Import Success.";
fclose($fh) or die("Can't close $filename.");
print "<hr />";

//1-28 示例 输出逗号分割数据
$sales = [
    ['Northeast', '2015-01-01', '2015-02-01', 12.54],
    ['Northwest', '2015-01-01', '2015-02-01', 546.33],
    ['Southeast', '2015-01-01', '2015-02-01', 93.26],
    ['Southwest', '2015-01-01', '2015-02-01', 945.21],
    ['All Regions', '--', '--', 1597.34]
];
$fh = fopen('php://output', 'w');
foreach ($sales as $sales_line) {
    if (fputcsv($fh, $sales_line) === false) {
        die("Can't write CSV line.");
    }
}
fclose($fh);
print "<hr />";

//1-29 示例 将逗号分割数据放入一个字符串
$sales = [
    ['Northeast', '2015-01-01', '2015-02-01', 12.54],
    ['Northwest', '2015-01-01', '2015-02-01', 546.33],
    ['Southeast', '2015-01-01', '2015-02-01', 93.26],
    ['Southwest', '2015-01-01', '2015-02-01', 945.21],
    ['All Regions', '--', '--', 1597.34]
];
ob_start();
$fh = fopen('php://output', 'w') or die("Can't open php://output.");
foreach ($sales as $sales_line) {
    if (fputcsv($fh, $sales_line) === false) {
        die("Can't write CSV line.");
    }
}
fclose($fh) or die("Can't close php://output.");
$output = ob_get_contents();
//ob_end_clean();			//清理文件缓冲区
print "<hr />";

//1-30 示例 从文件读取 CSV 数据
$fp = fopen($filename, 'r') or die("Can't open file.");
print "<table>\n";
while ($csv_line = fgetcsv($fp)) {
    print "<tr>";
    for ($i = 0, $j = count($csv_line); $i < $j; $i++) {
        print "<td>" . htmlentities($csv_line[$i]) . "</td>";
    }
    print "</tr>";
}
print "</table>";
fclose($fp) or die("Can't close file.");
print "<hr />";

//1-31 示例 生成固定宽度字段数据记录
$books = [
    ['Elmer Gantry', 'Sinclair Lewis', 1927],
    ['The Scarlatti Inheritance', 'Robert Ludlum', 1971],
    ['The Parsifal Mosaic', 'William Styron', 1979],
];
foreach ($books as $book) {
    print pack('A25A15A4', $book[0], $book[1], $book[2]) . "\n";
}
print "<hr />";

//1-32 示例 不使用pack()生成固定宽度字段数据记录
$books = [
    ['Elmer Gantry', 'Sinclair Lewis', 1927],
    ['The Scarlatti Inheritance', 'Robert Ludlum', 1971],
    ['The Parsifal Mosaic', 'William Styron', 1979],
];
foreach ($books as $book) {
    $title = str_pad(substr($book[0], 0, 25), 25, '.');
    $author = str_pad(substr($book[1], 0, 15), 15, '.');
    $year = str_pad(substr($book[2], 0, 4), 4, '.');
    print "$title$author$year\n";
}
print "<hr />";

//1-33 示例 使用 substr() 解析固定宽度记录
$fp = fopen('fixed-width-records.txt', 'r', true) or die("Can't open file.");
while ($s = fgets($fp, 1024)) {
    $fields[0] = substr($s, 0, 25);
    $fields[1] = substr($s, 25, 15);
    $fields[2] = substr($s, 40, 4);
    $fields = array_map('rtrim', $fields);
    print_r($fields);
}
fclose($fp) or die("Can't close file.");
print "<hr />";

//1-34 示例 使用 unpack() 解析固定宽度记录
function fixed_width_unpack($format_string, $data)
{
    $r = [];
    for ($i = 0, $j = count($data); $i < $j; $i++) {
        $r[$i] = unpack($format_string, $data[$i]);
    }
    return $r;
}

$data = [
    '\x04\x00\xa0\x00'
];
var_dump(fixed_width_unpack("cchars/nint", $data));
print "<hr />";

//1-35 示例 使用 fixed_width_substr() 解析固定宽度记录
function fixed_width_substr($fields, $data)
{
    $r = [];
    for ($i = 0, $j = count($data); $i < $j; $i++) {
        $line_pos = 0;
        foreach ($fields as $field_name => $field_length) {
            $r[$i][$field_name] = rtrim(substr($data[$i], $line_pos, $field_length));
            $line_pos += $field_length;
        }
    }
    return $r;
}

$booklist = <<< END
Elmer Gantry            Sinclair Lewis 1972
The Scarlatti InheritanceRobert Ludlum 1971
The Parsifal Mosaic     Robert Ludlum 1982
Sophie's Choice         William Styron 1989
END;

$book_fields = [
    'title' => 25,
    'author' => 15,
    'publiction_year' => 4,
];
$book_array = fixed_width_substr($book_fields, $booklist);
var_dump($book_array);
print "<hr />";

//1-36 示例 使用 explode() 分解字符串
$words = explode(' ', 'My sentence is not very complicated.');
print_r($words);
$words = explode(',', 'dopey,sleepy,happy,grumpy,sneezy,bashful,doc', 5);
print_r($words);
print "<hr />";

//1-37 示例 使用 str_split() 分解字符串
$words = str_split('My sentence is not very complicated.', 5);
print_r($words);
$words = preg_split('/\d\./', 'my day: 1. get up 1. get dressed 3. eat toast');
print_r($words);
$words = preg_split('/[\n\r]+/', "I'm a 
	person.");
print_r($words);
$words = preg_split('/ x /i', '31 inches x 22 inches X 9 inches.');
print_r($words);
print "<hr />";

//1.16 示例 使用文本在指定行长度自动换行
$s = "Four score and seven years ago our fathers brought forth on this continent a new nation, conceived in liberty and dedicated to the proposition that all men are created equal.";
print "<pre>\n" . wordwrap($s) . "</pre>" . "<br />";
print "<pre>" . wordwrap($s, 50) . "</pre>" . "<br />";
print wordwrap('jabberwocky', 5) . "\n<br />";
print wordwrap('jabberwocky', 5, "\n", 1);
print "<hr />";

//1.17 示例 字符串中存储二进制数据
$packed = pack('S4', 1974, 106, 28225, 32725);
$nums = unpack('S4', $packed);
print_r($nums);
$nums = unpack('S4num', $packed);
print_r($nums);
print "<br />";
$nums = unpack('S1a/S1b/S1c/S1d', $packed);
print_r($nums);
$s = 'platypus';
$ascii = unpack('c*', $s);
print_r($ascii);
print "<hr />";

//1-38 示例 可下载的CSV 文件
$db = new PDO('mysql:host=localhost;port=3306;dbname=test;', 'root', 'root');
$db->query('set names utf8;');
$sth = $db->prepare("SELECT * FROM messages");
$sth->execute();
$sales_data = $sth->fetchAll(PDO::FETCH_NUM);
//为 fputcsv() 打开文件句柄
$output = fopen('php://output', 'w') or die("Can't open php://output.");
$total = 0;
//告诉浏览器这是一个CSV文件
// header('Content-type: application/csv');
// header('Content-Disposition: attachment; filename="abc.csv"');
// Print header row
fputcsv($output, ['Region', 'Start Date', 'End Date', 'Amount']);
foreach ($sales_data as $sales_line) {
    fputcsv($output, $sales_line);
    $total += $sales_line[3];
}
//输出total,关闭句柄
fputcsv($output, ['All Regions', '--', '--', $total]);
fclose($output) or die("Can't close php://output.");
print "<hr />";

//1-39 示例 动态CSV或HTML
$column_headers = ['Region', 'Start Date', 'End Date', 'Amount'];
//确定使用那种格式
$format = $_GET['format'] == 'csv' ? 'csv' : 'html';
//输出相应格式的开始部分
if ($format == 'csv') {
    $output = fopen('php://output', 'w') or die("Can't open php://output");
    header('Content-type: application/csv');
    header('Content-Disposition: attachment; filename="abc.csv"');
    fputcsv($output, $column_headers);
} else {
    echo '<table><tr><th>';
    echo implode('</th><th>', $column_headers);
    echo '</th></tr>';
}

foreach ($sales_data as $sales_line) {
    //输出相应格式的数据行
    if ($format == 'csv') {
        fputcsv($output, $sales_line);
    } else {
        echo '<tr><td>' . implode('</td><td>', $sales_line) . '</td></tr>';
    }
    $total += $sales_line[3];
}
$total_line = ['All Regions', '--', '--', $total];
//输出相应格式的尾部
if ($format == 'csv') {
    fputcsv($output, $total_line);
    fclose($output) or die("Can't close php://output.");
} else {
    echo '<tr><td>' . implode('</td><td>', $total_line) . '</td></tr>';
    echo '</table>';
}
