<?php

//7.0 面向对象
class guest_book
{
    public $comments;
    public $last_visitor;

    public function __construct($user)
    {
        $dbh = mysqli_connect('localhost', 'root', 'root', 'test');
        $user = mysqli_real_escape_string($dbh, $user);
        $sql = "SELECT comments, last_visitor FROM guest_books WHERE user='$user'";

        $r = mysqli_query($dbh, $sql);

        if ($obj = mysqli_fetch_object($r)) {
            $this->comments = $obj->comments;
            $this->last_visitor = $obj->last_visitor;
        }
    }
}

$comments = (new guest_book('lisi'))->comments;
$last_visitor = (new guest_book('lisi'))->last_visitor;
echo $comments, $last_visitor, "\n";

//7.7 要求多个类有类似的行为
interface NameInterface
{
    public function getName();

    public function setName($name);
}

class Book1 implements NameInterface
{
    private $name;

    public function abc()
    {
        return 123;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        return $this->name = $name;
    }
}

$book = new Book1();
echo $book->setName('slagga');
echo $book->getName(), "\n";

trait NameTrait
{
    private $name;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        return $this->name = $name;
    }
}

class Book
{
    use NameTrait;
}

class Child
{
    use NameTrait;
}

$book = new Book();
echo $book->setName('zhangsan');

$interfaces = class_implements('Book1');// 检测是否实现接口
if (isset($interfaces['NameInterface'])) {
    echo "true";
}

//7.8 创建抽象基类
abstract class Database
{
    abstract public function connect($server, $username, $password, $database);

    abstract public function query($sql);

    abstract public function fetch();

    abstract public function close();
}

class MySQL extends Database
{
    protected $dbh;
    protected $query;

    public function connect($server, $username, $password, $database)
    {
        $this->dbh = mysqli_connect($server, $username, $password, $database);
    }

    public function query($sql)
    {
        $this->query = mysqli_query($this->dbh, $sql);
    }

    public function fetch()
    {
        return mysqli_fetch_row($this->query);
    }

    public function close()
    {
        mysqli_close($this->dbh);
    }
}

//7.9 对象引用赋值
$mysql = new MySQL();
$dave = $mysql;
$dave->connect('localhost', 'root', 'root', 'test');
$dave->query('select * from user;');
print_r($dave->fetch());
$dave->close();

//7.10 克隆对象
$rasmus = $dave;
$rasmus = clone $dave;

//7.11 覆盖属性访问
class Person
{
    // 列出person 和 email 作为合法属性
    protected $data = ['person' => false, 'email' => false];

    public function __get($property)
    {
        if (isset($this->data[$property])) {
            return $this->data[$property];
        } else {
            return null;
        }
    }

    //限定只能设置    预定义的属性
    public function __set($property, $value)
    {
        if (isset($this->data[$property])) {
            $this->data[$property] = $value;
        }
    }

    public function __isset($property)
    {
        return isset($this->data[$property]);
    }

    public function __unset($property)
    {
        if (isset($this->data[$property])) {
            unset($this->data[$property]);
        }
    }
}

//7.12 在另一个方法返回的对象上调用方法
class Tweet
{
    protected $data;

    public function from($form)
    {
        $data['from'] = $form;
        return $this;
    }

    public function withStatus($status)
    {
        $data['status'] = $status;
        return $this;
    }

    public function inReplyToId($id)
    {
        $data['id'] = $id;
        return $this;
    }

    public function send()
    {
        return '888';
    }
}

$tweet = new Tweet();
$id = $tweet->from('@rasmus')->withStatus('PHP 6 released! #php')->send();
$reply = new Tweet();
$id2 = $reply->from('I <3 Unicode!')->from('@a')->inReplyToId($id)->send();
echo $id, $id2, "\n";

//7.13 聚合对象
class Address
{
    protected $city;

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getCity()
    {
        return $this->city;
    }
}

class Human
{
    protected $name;
    protected $address;

    public function __construct()
    {
        $this->address = new Address();
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function __call($method, $arguments)
    {
        if (method_exists($this->address, $method)) {
            return call_user_func_array([$this->address, $method], $arguments);
        }
    }
}

$rasmus = new Human();
$rasmus->setName('Rasmus Lerdorf');
$rasmus->setCity('Sunnyvale');
print $rasmus->getName() . ' lives in ' . $rasmus->getCity() . ".";

//7.14 访问被覆盖的方法
//访问父类被覆盖的方法，显式调用    parent：：draw();

//7.15 动态调用方法
//__call and __callStatic 魔术方法来拦截调用，并相应地转发处理

//7.16 使用方法多态
function combine($a, $b)
{
    if (is_int($a) && is_int($b)) {
        return $a + $b;
    }

    if (is_float($a) && is_float($b)) {
        return $a + $b;
    }

    if (is_string($a) && is_string($b)) {
        return "$a$b";
    }

    if (is_array($a) && is_array($b)) {
        return array_merge($a, $b);
    }

    if (is_bool($a) && is_bool($b)) {
        return $a & $b;
    }

    return false;
}

echo combine(true, false) . "\n";

//7.17 定义类变量
define('pi', 10);

class Math
{
    const pi = 3.14159;
    protected $radius;

    public function __construct($radius)
    {
        $this->radius = $radius;
    }

    public function circumference($bool = true)
    {
        if ($bool) {
            return 2 * self::pi * $this->radius;
        } else {
            return 2 * pi * $this->radius;
        }
    }
}

$c = new Math(1);
print $c->circumference(true) . "\n";
print $c->circumference(false) . "\n";

//7.18 定义静态属性和方法
class Format
{
    public static function number($number, $decimals = 2, $decimal = '.', $thousands = ',')
    {
        return number_format($number, $decimals, $decimal, $thousands);
    }

    public static function integer($number)
    {
        return self::number($number, 0);
    }
}

print Format::number(1234.567) . "\n";
print Format::integer(1234.567) . "\n";

// 控制对象串行化
class Logfile
{
    protected $filename;
    protected $handle;

    public function __construct($filename)
    {
        $this->filename = $filename;
        $this->open();
    }

    private function open()
    {
        $this->handle = fopen($this->filename, 'a');
    }

    public function __destruct()
    {
        fclose($this->handle);
    }

    // 串行化对象时调用
    // 应当返回要串行化的对象属性的一个数组
    public function __sleep()
    {
        return ['filename'];
    }

    // 逆串行化对象时调用
    public function __wakeup()
    {
        return $this->open();
    }
}

//7.20 对象自省
class Person1
{
    public $name;
    protected $spouse;
    private $password;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setSpouse(Person1 $spouse)
    {
        if (!isset($this->spouse)) {
            $this->spouse = $spouse;
        }
    }

    private function setPassword($password)
    {
        $this->password = $password;
    }
}

Reflection::export(new ReflectionClass('Person1'));

//7.21 检查对象是否是一个特定类的实例
class AddressBook
{
    public function add($person)
    {
        // 将$person增加到地址薄
        if (!$person instanceof Person) {
            die('Argument 1 must be an instance of Person.');
        }
    }
}

$book = new AddressBook();
$person = 'Rasmus Lerdorf';
$book->add($person);

//7.22 对象实例化时自动加载类文件
function __autoloade($class_name)
{
    include "$class_name";
}

$person = new Person();

//7.23 动态实例化对象
$language = $_REQUEST['language'];
$valid_langs = ['en_US' => 'US English', 'en_UK' => 'British English', 'en_US' => 'US Spanish', 'fr_CA' => 'Canadian French'];
if (isset($valid_langs[$language]) && class_exists($language)) {
    $language = new $language;
}

//7.24 程序 whereis
if ($argc < 2) {
    print "$argv[0]: classes1.php[, ...]\n";
    exit;
}

//包含文件
foreach (array_slice($argv, 1) as $filename) {
    include_once $filename;
}

// 得到所有方法和函数信息
// 从类开始
$methods = [];
foreach (get_declared_classes() as $class) {
    $r = new ReflectionClass($class);
    //不考虑内置类
    if ($r->isUserDefined()) {
        foreach ($r->getMethods() as $method) {
            // 不考虑继承的方法
            if ($method->getDeclaringClass()->getName() == $class) {
                $signature = "$class::" . $method->getName();
                $methods[$signature] = $method;
            }
        }
    }
}

//然后增加函数
$functions = [];
$defined_functions = get_defined_functions();
foreach ($defined_functions['user'] as $function) {
    $functions[$function] = new ReflectionFunction($function);
}

// 根据类按字符顺序对方法排序
function sort_methods($a, $b)
{
    list($a_class, $a_method) = explode('::', $a);
    list($b_class, $b_method) = explode('::', $b);

    if ($cmp = strcasecmp($a_class, $b_class)) {
        return $cmp;
    }

    return strcasecmp($a_method, $b_method);
}

uksort($methods, 'sort_methods');

// 按字母顺序对函数排序
// 这不太复杂， 不过不要忘记
// 从列表中去除方法排序函数
unset($functions['sort_methods']);
// 完成排序
ksort($functions);

// 输出信息
foreach (array_merge($functions, $methods) as $name => $reflect) {
    $file = $reflect->getFileName();
    $line = $reflect->getStartLine();

    printf("%-25s | %-40s | &6d\n", "$name()", $file, $line);
}