<?php
//6.1 访问函数参数
function commercial_sponsorship($letter, $number){
    print "This episode of Sesame Street is brought to you by ";
    print "the letter $letter and number $number. \n";
}
commercial_sponsorship('G', 3);

//6.2 为函数参数设置默认值
$str = 'Hello Slagga.';
function wrap_in_html_tag($text, $tag = 'strong'){
    return "<$tag>$text</$tag>";
}
echo wrap_in_html_tag($str), "\n";

//6.3 按引用传递值
function wrap_html_tag(&$text, $tag = 'strong'){
    $text = "<$tag>$text</$tag>";
}
wrap_html_tag($str);
echo $str, "\n";

//6.4 使用命名参数
function image($img){
    $tag = '<img src="'.$img['src'].'" ';
    $tag .= 'alt="'.(isset($img['alt']) ? $img['alt'] : '').'"/>';
    return $tag;
}
$image1 = image(['src' => 'cow.png', 'alt' => 'cows say moo']);
$image2 = image(['src' => 'pig.jpeg']);
print_r($image1);
print_r($image2);

//6.5 强制函数参数的类型
function drink_juice(Liquid $drink){

}
function enumerate_some_stuff(array $values){

}

//6.6 创建参数个数可变的函数
function mean(){
    // 初始化以避免警告
    $sum = 0;
    // 传入函数的参数
    $size = func_num_args();
    // 迭代处理参数， 并累加数字
    for ($i = 0; $i < $size; $i++){
        $sum += func_get_arg($i);
    }
    // 除以数字个数
    $average = $sum / $size;
    return $average;
}

// $mean为96.25
$mean = mean(96, 93, 98, 98);
print_r($mean);

function means(){
    // 初始化以避免警告
    $sum = 0;
    // 传入函数的参数
    $size = func_num_args();
    // 迭代处理参数， 并累加数字
    foreach(func_get_args() as $arg){
        $sum += $arg;
    }
    // 除以数字个数
    $average = $sum / $size;
    return $average;
}

// $mean为96.25
$mean = means(96, 93, 98, 98);
print_r($mean);

//6.7 按引用返回值
function &array_find_value($needle, &$haystack){
    foreach ($haystack as $key => $value){
        if($needle == $value){
            return $haystack[$key];
        }
    }
}
$minnesota = ['Bob Dylan', 'F. Sott Fitzgerald', 'Prince', 'Charles Schultz'];
$prince = &array_find_value('Prince', $minnesota);
$prince = 'O(+>';
print_r($minnesota);

//6.8 返回多个值
function array_stats($values){
    $min = min($values);
    $max = max($values);
    $mean = array_sum($values) / count($values);

    return [$min, $max, $mean];
}
$values = [1, 3, 5, 9, 13, 1442];
list($min, $max, $mean) = array_stats($values);
$list = array_stats($values);
print_r($list);

//6.9 天国所选的返回值
function time_parts($time){
    return explode(':', $time);
}
list(, $minute,) = time_parts('12:34:56');
print_r($minute);

//6.10 返回失败
function loolup($name){
    if(empty($name)){
        return false;
    }
}
$name = 'alice';
if(false !== loolup($name)){
    echo "Success. \n";
}else{
    echo "Fail. \n";
}

//6.11 调用可变函数
function get_file($filename){ return file_get_contents($filename); }
$function = 'get_file';
$filename = 'log.txt';
print call_user_func($function, $filename)."\n";

function put_file($filename, $d){ return file_put_contents($filename, $d); }
$action = 'get';
if($action == 'get'){
    $function = 'get_file';
    $args = ['log.txt'];
}elseif($action == 'put'){
    $function = 'put_file';
    $args = ['log.txt','Hello Slagga.'];
}
print call_user_func_array($function, $args)."\n";

//6.12 在函数中访问全局变量
$food = 'pizza';
$drink = 'beer';
function party(){
    global $food, $drink;

    unset($food);
    unset($GLOBALS['drink']);
}

print "$food: $drink\n";
party();
print "$food: $drink\n";

//6.13 创建动态函数
$increment = 7;
$add = function($i, $j) use ($increment) { return $i + $j + $increment; };
$sum = $add(1, 2);
echo $sum;
