<?php
//2.0　PHP 中 表示 二进制 ， 八进制 , 十进制 ， 十六进制
echo 0b11111111, "\n";		//255
echo 0377, "\n";			//255
echo 255, "\n";				//255
echo 0xff, "\n";			//255

//PHP 进制转换
echo decbin(255), "\n";		//十进制转换二进制
echo decoct(255), "\n";		//十进制转换八进制
echo dechex(255), "\n";		//十进制转换十六进制

//e3表示10的三次方；7e-10表示7乘以10的负10次幂。这是科学计数法的方式。e就表示10，在科学计数法中，后面的表示幂数。
echo  1.2e3, "\n"; 			//1200		
echo  7E-10, "\n";			//7.0E-10
print "<hr />";

//2.1 检测变量是否包含一个合法数字
foreach ([5, '5', '05', 12.3, '16.7', 'five', 0xDECAFBAD, '10e200'] as $maybeNumber) {
	$actualType = gettype($maybeNumber);
	print "Is the $actualType $maybeNumber numeric? ";
	if (is_numeric($maybeNumber)) {
		print 'yes.';
	} else {
		print 'no.';
	}
	print "\n";
}
print "<hr />";

//2.2 比较浮点类型
$delta = 0.00001;
$a = 1.00000001;
$b = 1.00000000;
if (abs($a - $b) < $delta) {
	print '$a and $b are equal enough.';
}
print "<hr />";

//2.3 浮点数舍入 (四舍五入)
$number = round(2.4);
printf("2.4 rounds to the float %s \n", $number);
$number = ceil(2.4);
printf("2.4 rounds up to the float %s \n", $number);
$number = floor(2.4);
printf("2.4 rounds down to the float %s \n", $number);
$cart = 54.23;
$tax = $cart * .05;
$total = $cart + $tax;
$final = round($total, 2);
print "Tax calculation used all the digits is needs: $total, but ";
print "rounds() trims it to two decimal places: $final";
$number1 = floor(2.1);	//2.0
$number2 = floor(2.9);	//2.0
$number3 = floor(-2.1);	//-3.0
$number4 = floor(-2.9);	//-3.0

$number1 = ceil(2.1);	//3.0
$number2 = ceil(2.9);	//3.0
$number3 = ceil(-2.1);	//-2.0
$number4 = ceil(-2.9);	//-2.0
print "<hr />";

//2.4 使用 for 循环处理一系列整数
$start = 3;
$end = 7;
for ($i = $start; $i <= $end; $i++) {
	printf("%d squared is %d\n", $i, $i * $i);
}

$start = 3;
$end = 7;
for ($i = $start; $i <= $end; $i += 2) {
	printf("%d squared is %d\n", $i, $i * $i);
}
print "<hr />";

//使用 range() 处理整数
$numbers = range(3, 7);
foreach ($numbers as $n) {
	printf("%d squared is %d\n", $n, $n * $n);
}
foreach ($numbers as $n) {
	printf("%d cubed is %d\n", $n, $n * $n * $n);
}

print_r(range('l', 'p'));
print "<hr />";

//为减少　range() 占用太多内存　这里使用　yield　处理整数
function squares ($start, $stop) {
	if ($start < $stop) {
		for ($i=$start; $i <= $stop; $i++) { 
			yield $i => $i * $i;
		}
	}
	else 
	{
		for ($i=$start; $i >= $stop; $i--) { 
			yield $i => $i * $i;
		}
	}
}
foreach (squares(15, 3) as $n => $square) {
	printf("%d squared is %d\n", $n, $square);
}
print "<hr />";

//2.5 在指定范围内生成随机数	可以使用 rand() and　mt_rand()   后者更不可预测，而且速度较快
$lower = 65;
$upper = 97;
$random_number = mt_rand($lower, $upper);
printf('The random number is %d.', $random_number);
print "<hr />";

//2.6　生成可预测的随机数
function pick_color ()  {
	$colors = ['red', 'orange', 'yellow', 'blue', 'green', 'indigo', 'violet'];
	$i = mt_rand(0, count($colors) - 1);
	return $colors[$i];
}
mt_srand(34534);
$first = pick_color();
$second = pick_color();

//由于向 mt_srand() 传入一个特定的值　所以可以确定每次都会选择相同的颜色
print "$first is red and $second is yellow.";
print "<hr />";

//2.7 生成偏随机数	使用　rand_weighted()　函数
function rand_weighted ($numbers) {
	$total = 0;
	foreach ($numbers as $number => $weight) {
		$total += $weight;
		$distribution[$number] = $total;
	}
	$rand = mt_rand(0, $total -1);
	foreach ($distribution as $number => $weights) {
		if ($rand < $weights) {
			return $number;
		}
	}
}
$ads = ['ford' => 12234, 'att' => 33424, 'ibm' => 16823];
$ad = rand_weighted($ads);
print_r($ad);
print "<hr />";

//使用生成器，选择加权随机数  来指定随机数
function incrementa_total ($numbers) {
	$total = 0;
	foreach ($numbers as $number => $weight) {
		$total += $weight;
		yield $number => $total;
	}
}

//返回加权随机选择的键
function rand_weighted_generator ($numbers) {
	$total = array_sum($numbers);
	$rand = mt_rand(0, $total - 1);
	foreach (incrementa_total($numbers) as $number => $weight) {
		if ($rand < $weight) {
			return $number;
		}
	}
}
print_r(rand_weighted_generator($ads));
print "<hr />";

//2.8 取对数
echo log(10), "\n";				//对于以 e　为底的对数
echo log10(10), "\n";			//对于以10 为底的对数
echo log(10, 2);				//对于使用其他底数的对数
print "<hr />";

//2.9 计算指数
echo exp(2), "\n";					//计算 e 的幂
echo pow(2, M_E), "\n";				//计算某个数的幂
echo pow(2, 10), "\n";
echo pow(2, -2), "\n";
echo pow(2, 2.5), "\n";
echo pow(-2, 10), "\n";
echo pow(-2, -2.5), "\n";
echo exp(2), "\n", pow(M_E, 2);
print "<hr />";

//2.10 格式化数字
$number = 1234.56;
$formatted1 = number_format($number);
echo $formatted1, "\n";
$formatted2 = number_format($number, 2);
echo $formatted2, "\n";
$formatted3 = number_format($number, 2, ",", ".");
echo $formatted3, "\n";

$number = '31415.92653';
list($int, $dec) = explode('.', $number);
$formatted = number_format($number, strlen($dec));
echo $formatted, "\n";
print "<hr />";

//2.11 格式化货币值	(NumberFormatter　需要 PHP 开启 intl 扩展）
$number = 1234.56;
$usa = new NumberFormatter("en-US", NumberFormatter::CURRENCY);
$formatted1 = $usa->format($number);		//$ , .
echo $formatted1 , "\n";
$france = new NumberFormatter("fr-FR", NumberFormatter::CURRENCY);
$formatted2 = $france->format($number);		// , €
echo $formatted2 , "\n";
print "<hr />";

//2.12 正确输出复数
$number = 4;
print "Your search returned $number " . ($number == 1 ? 'hit' : 'hits') . '.' . "\n";

function may_pluralize ($sigular_word, $amount_of) {
	$plurals = ['fish' => 'fish', 'person' => 'people'];
	if (1 == $amount_of) {
		return $sigular_word;
	}

	if (isset($plurals[$sigular_word])) {
		return $plurals[$sigular_word];
	}
	return $sigular_word . 's';
}

$number_of_fish = 1;
$out1 = "I ate $number_of_fish " . may_pluralize('fish', $number_of_fish) . '.';

$number_of_people = 4;
$out2 = "Soylent Green is " . may_pluralize('person', $number_of_people) . '!';
echo $out1, "\n", $out2;
print "<hr />";

//2.13 讨论三角函数
