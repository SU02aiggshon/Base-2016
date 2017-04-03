<?php
// 4-1  迭代处理数组
$array = [1 => 'zhangsan', 'lisan', 'wangwu'];
foreach ($array as $value) {

}
foreach ($array as $key => $val) {

}
for ($key = 0, $size = count($array); $key < $size; $key++) {

}
reset($array);
while (list($key, $val) = each($array)) {

}

// 4-2 处理数组的每个元素
$lc = array_map('strtoupper', $array);

// 4-3 从数组中删除元素
unset($array[1]);
$lc = array_values($array);     //压缩数组
array_splice($lc, 1, 1);        //删除元素并重新建立索引

// 4-4 改变数组大小
$lc = array_pad($array, 5, ''); //扩展数组
$lc = array_pad($array, 3, 'lisa');

// 4-5 合并数组
$lc = array_merge($array, $lc);
var_dump($lc);

// 4-6 数组转换字符串
$string = 1;
$string = join(',', $lc);
var_dump($string);

// 4-7 检测数组中包含的键和值
if (array_key_exists('5', $lc)) {
    echo $string;
}
if (isset($lc[5])) {
    echo $string;
}
if (in_array('tom', $lc)) {
    echo $string;
}

$lc = array_flip($lc);      //转换为关联数组
echo $lc['lisan'] . "\n";

// 4-8 查找值在数组中的位置
$position = array_search('lisan', $array);
echo $position . "\n";

// 4-9 查找数组中的最大和最小元素
$largest = max($array);
echo $largest . "\n";
$smallest = min($array);
echo $smallest . "\n";

//4-10 反转数组 (反转数组中元素的顺序)
$lc = array_reverse($lc);
var_dump($lc);

//4-11 数组排序 多个数组排序
$states = ['Delaware', 'Pennsylvania', 'New Jersey'];
$scores = [1, 10, 2, 20];
sort($scores);      //正序
rsort($scores);     //倒序

usort($states, function ($a, $b) {
    return strnatcmp($b, $a);   //倒序
});

function array_sort($array, $map_func, $sort_func = '')
{
    $mapped = array_map($map_func, $array);
    $sorted = [];

    if ('' === $sort_func) {
        asort($mapped);
    } else {
        uasort($mapped, $sort_func);
    }

    while (list($key) = each($mapped)) {
        $sorted[] = $array[$key];
    }

    return $sorted;
}

print_r(array_sort($states, 'strtoupper'));

$colors = ['Red', 'White', 'Blue'];
$cities = ['Bostom', 'New York', 'Chicago'];
array_multisort($colors, $cities);  //多重数组的排序
print_r($cities);

shuffle($cities);                   //随机调整数组
print_r($cities);

//4-12 删除数组中重复的元素
$unique = array_unique($colors);

//4-13 对数组中的各个元素应用一个函数
$names = ['firstname' => 'Baba', 'lastname' => "O'Riley"];
array_walk($names, function (&$value, $key) {
    $value = htmlentities($value, ENT_QUOTES);
});

print_r($names);

//4-14 对于嵌套数组的各个元素应用一个函数
$names = ['firstnames' => ['Baba', 'Bill'], 'lastnames' => ["O'Riley", "O'Reilly"]];
array_walk_recursive($names, function (&$value, $key) {
    $value = htmlentities($value, ENT_QUOTES);
});

print_r($names);

//4.23 查找两个数组的并集、交集和差集
$a = ['To', 'be', 'or', 'not', 'to', 'be'];
$b = ['To', 'be', 'or', 'whatever'];
$union = array_unique(array_merge($a, $b));//数组并集，两个数组的所有元素
$intersection = array_intersect($a, $b);//数组交集，两个数组中共有的元素
$difference = array_diff($a, $b);//数组差集，一个数组有，另一个数组没有的元素
$difference = array_merge(array_diff($a, $b), array_diff($b, $a));//对称差集，两个数组互相不相同的元素
print_r($difference);

//4.24 高效迭代处理大型数据集
function FileLineGenerator($file)
{
    if (!$fh = fopen($file, 'r')) {
        return;
    }

    while (false !== ($line = fgets($fh))) {
        yield $line;
    }
    fclose($fh);
}

$file = FileLineGenerator('log.txt');
foreach ($file as $line) {
    print $line;
}

//使用数组语法访问对象
class FakeArray implements ArrayAccess
{
    private $elements;

    public function __construct()
    {
        $this->elements = [];
    }

    public function offsetExists($offset)
    {
        return isset($this->elements[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->elements[$offset];
    }

    public function offsetSet($offset, $value)
    {
        return $this->elements[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->elements[$offset]);
    }
}

$array = new FakeArray();
$array['animal'] = 'wabbit';
if (isset($array['animal']) && $array['animal'] == 'wabbit') {
    unset($array['animal']);
}
if (!isset($array['animal'])) {
    print "Well, what did you expect in an opera? A happy ending?\n";
}
