<?php
//5-1 判断是否为空
if (empty($first_name)) {
    $first_name = 'Slagga';
}

//5.2 建立默认值
if (!isset($cars)) {
    $cars = $first_name;
}
$cars = isset($_GET['cars']) ? $_GET['cars'] : $first_name;

//5.3 交换值而不是用临时变量
$a = 'Alice';
$b = 'Bob';
list($a, $b) = [$b, $a];
echo $a, $b, "\n";

//5.4 创建动态变量名
$animal = 'turtles';
$turtles = 103;
echo $turtles, "\n";

//5.5 跨函数调用持久存储局部变量的值
function check_the_count($pitch)
{
    static $strikes = 0;
    static $balls = 0;

    switch ($pitch) {
        case 'foul':
            if (2 == $strikes)
                break;
        case 'strike':
            $strikes++;
            break;
        case 'ball':
            $balls++;
            break;
    }

    if (3 == $strikes) {
        $strikes = $balls = 0;
        return 'strike out';
    }
    if (4 == $balls) {
        $strikes = $balls = 0;
        return 'walk';
    }
    return 'at bat';
}

$pitches = ['strike', 'ball', 'ball', 'strike', 'foul', 'strike'];
$what_happened = [];
foreach ($pitches as $pitch) {
    $what_happened[] = check_the_count($pitch);
}
//显示结果
var_dump($what_happened);

//5.6 进程间共享变量
//一下需要安装 APC 扩展
//$bar = 'BAR';
//apc_add('foo', $bar);
//var_dump(apc_fetch('foo'));
//echo "\n";
//$bar = 'NEVER GETS SET';
//apc_add('foo', $bar);
//var_dump(apc_fetch('foo'));
//echo "\n";

//5-6 使用shmop共享内存函数 (php7 已废弃)
//$shmop_key = ftok(__FILE__, 'p');
//$shmop_id = shmop_open($shmop_key, "c", 0600, 16384);
//$population = shmop_read($shmop_id, 0, 0);
//$population += 1;
//$shmop_bytes_written = shmop_write($shmop_id, $population, 0);
//if($shmop_bytes_written != strlen($population)){
//    echo "Can't write all of: $population\n";
//}
//shmop_close($shmop_id);

//5.7 将复杂数据类型封装在字符串中
$pantry = ['sugar' => '2 lbs.', 'butter' => '3 sticks'];
$fp = fopen('log.txt', 'w') or die("Can't open pantry");
fputs($fp, serialize($pantry));
fclose($fp);

$new_pantry = unserialize(file_get_contents('log.txt'));
print_r($new_pantry);

$fp = fopen('log.txt', 'w') or die("Can't open pantry");
fputs($fp, json_encode($pantry));
fclose($fp);

$new_pantry = json_decode(file_get_contents('log.txt'));
print_r($new_pantry);

//5.8 变量内容转储为字符串
$user_1 = ['name' => 'max', 'username' => 'max'];
$user_2 = ['name' => 'Leo Bloom', 'username' => 'leo'];

// Max and Leo are friend
$user_2['friend'] = &$user_1;
$user_1['friend'] = &$user_2;

$user_1['job'] = 'Swindler';
$user_2['job'] = 'Accountant';
print_r($user_1);
var_dump($user_1);

ob_start();
var_dump($user_1);
$dump = ob_get_contents();
ob_end_clean();
print_r($dump);
