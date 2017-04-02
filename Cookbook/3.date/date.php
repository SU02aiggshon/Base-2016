<?php
//3-1 使用mttime() date()
$stamp = mktime(0, 0, 0, 1, 1, 1986);
print date('l', $stamp) . "\n";

//3-2 查找当前日期和时间
print date('r') . "\n";
$when = new DateTime();
print $when->format('r') . "\n";

//3-3
$now_1 = getdate();
$now_2 = localtime();
print "{$now_1['hours']}:{$now_1['minutes']}:{$now_1['seconds']}\n";
print "$now_2[2]:$now_2[1]:$now_2[0]\n";

//3-4 月日年
$a = getdate();
printf('%s %d, %d ', $a['month'], $a['mday'], $a['year']);

//3-5
$a = getdate(163727100);
printf('%s %d, %d', $a['month'], $a['mday'], $a['year']);

//3-6
$a = localtime();
$a[4] += 1;
$a[5] += 1900;
print "$a[4]/$a[3]/$a[5]\n";

//3-7 3-8 3-9   将时间和日期转换纪元时间戳
$then = mktime(19, 45, 3, 3, 10, 1975);
$then = gmmktime(19, 45, 3, 3, 10, 1975);
$then = DateTime::createFromFormat(DateTime::ATOM, "1975-03-10T19:45:03");
print $then . "\n";

//3-10 3-11 3-12    将时间戳转化为时间和日期
date_default_timezone_get('Asia/Shanghai');
$stamp_future = mktime(15, 25, 0, 12, 3, 2024);
$formatted = date('c', $stamp_future);
echo $formatted . "\n";

$stamp_future = gmmktime(15, 25, 0, 12, 3, 2024);
print $stamp_future . "\n";

$text = "Birthday: May 11, 1918.";
$when = DateTime::createFromFormat("*: F j, Y.|", $text);
$formatted = $when->format(DateTime::RFC850);
print $formatted . "\n";

//3-13  指定格式输出时间和日期
print date('d/m/y') . "\n";
$when = new DateTime();
print $when->format('d/m/y') . "\n";

//3-14  计算两个日期之差
$first = new DateTime("1965-05-10 7:32:56pm", new DateTimeZone('America/New_York'));
$second = new DateTime("1962-11-20 4:29:11am", new DateTimeZone('America/New_York'));
$diff = $second->diff($first);
printf("The two dates have %d weeks, %s days, " . "%d hours, %d minutes, and %d seconds " . "elapsed between them. \n",
    floor($diff->format('%a') / 7), $diff->format('%a') % 7, $diff->format('%h'), $diff->format('%i'), $diff->format('%s'));

//3-15 计算日期之间计算的时间差
$first_local = new DateTime("1965-05-10 7:32:56pm", new DateTimeZone('America/New_York'));
$second_local = new DateTime("1962-11-20 4:29:11am", new DateTimeZone('America/New_York'));
$first = new DateTime('@' . $first_local->getTimestamp());
$second = new DateTime('@' . $second_local->getTimestamp());

$diff = $second->diff($first);
printf("The two dates have %d weeks, %s days, " . "%d hours, %d minutes, and %d seconds " . "elapsed between them. \n",
    floor($diff->format('%a') / 7), $diff->format('%a') % 7, $diff->format('%h'), $diff->format('%i'), $diff->format('%s'));

//3-16 查找年 月 或者 周中的某一天
print "Today is day " . date('d') . ' of the month and ' . date('z') . ' of the year.';
print "\n";
$birthday = new DateTime('January 17, 1706', new DateTimeZone('America/New_York'));
print "Benjamin Franklin was born on a " . $birthday->format('l') . ", " . "day " . $birthday->format('N') . " of the week. \n";

//3-17 检查一周的一天
if (0 == date('w')) {
    print "Welcome to the beginning of your work week. \n";
}

//3-18 验证日期
function checkbirthday($month, $day, $year)
{
    $min_age = 18;
    $max_age = 122;
    if (!checkdate($month, $day, $year)) {
        return false;
    }

    $now = new DateTime();
    $then_formatted = sprintf("%d-%d-%d", $year, $month, $day);
    $then = DateTime::createFromFormat("Y-n-j|", $then_formatted);
    $age = $now->diff($then);
    if ($age->y < $min_age || $age->y > $max_age) {
        return false;
    } else {
        return true;
    }
}

if (checkbirthday(12, 3, 1974)) {
    print "You may use this Web site. \n";
} else {
    print "You are too young (or too old!!) to proceed. \n";
}

// 3-19 从字符串解析日期和时间
$a = strtotime('march 10');
$a = strtotime('last thursday');
$a = strtotime('now + 3 months');
print "$a \n";

// 3-20 解析制定格式的日期
$dates = ['01/02/2015', '03/06/2015', '09/08/2015'];
foreach ($dates as $date) {
    $default = new DateTime($date);
    $day_first = DateTime::createFromFormat('d/m/Y|', $date);
    printf("The default interpretation is %s\n but day-first is %s. \n",
        $default->format(DateTime::RFC850), $day_first->format(DateTime::RFC850));
}

// 3-21 日期加减
$birthday = new DateTime('March 10, 1975');
$human_gestation = new DateInterval('P40W');
$birthday->sub($human_gestation);
print $birthday->format(DateTime::RFC850);
print "\n";

$elephant_gestation = new DateInterval('P616D');
$birthday->add($elephant_gestation);
print $birthday->format(DateTime::RFC850) . "\n";

// 3-22 使用时区和日光 节省时间来计算时间
$nowInNewYork = new DateTime('now', new DateTimeZone('America/New_York'));
$nowInCalifornia = new DateTime('now', new DateTimeZone('America/Los_Angeles'));
printf("It's %s in New York but %s in California. \n", $nowInNewYork->format(DateTime::RFC850), $nowInCalifornia->format(DateTime::RFC850));

// 3-23 改变时区
$now = time();
date_default_timezone_set('America/New_York');
print date(DATE_RFC850, $now) . "\n";
date_default_timezone_set('Europe/Paris');
print date(DATE_RFC850, $now) . "\n";
date_default_timezone_set('Asia/Shanghai');
print date(DATE_RFC850, $now) . "\n";

// 3-24 生成高精度时间
$start = microtime(true);
for ($i = 0; $i < 1000; $i++) {
    preg_match('/age=\d{1,5}/', $_SERVER['QUERY_STRING']);
}
$end = microtime(true);
$elapsed = $end - $start;
print $elapsed . "\n";

// 3-25 用microtime 生成ID
list($microseconds, $second) = explode(' ', microtime());
print $second . $microseconds . getmygid() . "\n";

// 3-26 使用非公历日历
$jd = gregoriantojd(3,9,1876);
$gregorian = cal_from_jd($jd, CAL_GREGORIAN);
print_r($gregorian);

// 3-27 使用儒略历
$jd = cal_to_jd(CAL_JULIAN, 2, 29, 1900);
$julian = cal_from_jd($jd, CAL_JULIAN);
print_r($julian);
$gregorian = cal_from_jd($jd, CAL_GREGORIAN);
print_r($gregorian);

// 3-28 使用法国共和历
$jd = cal_to_jd(CAL_FRENCH, 8, 13, 11);
$french = cal_from_jd($jd, CAL_FRENCH);
print_r($french);
$gregorian = cal_from_jd($jd, CAL_GREGORIAN);
print_r($gregorian);

// 3-29 使用犹太历
$jd = cal_to_jd(CAL_JEWISH, 3, 25, 5774);
$jewish = cal_from_jd($jd, CAL_JEWISH);
print_r($jewish);
$gregorian = cal_from_jd($jd, CAL_GREGORIAN);
print_r($gregorian);

// 3-30 日历
$month = isset($_GET['month']) ? intval($_GET['month']) : date('m');
$year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');
$cal = new LittleCalendar($month, $year);
print $cal->html();

?>

<style type="text/css">
    .prev { text-align: left; }
    .next { text-align: right; }
    .day, .month, .weekday { text-align: center; }
    .today { background: yellow; }
    .blank {  }
</style>

<?php

class LittleCalendar{
    /** DateTime */
    protected $monthToUse;
    protected $prepared = false;
    protected $days = [];

    public function __construct($month, $year){
        /** 为要显示的月份建立一个 DateTime */
        $this->monthToUse = DateTime::createFromFormat('Y-m|', sprintf("%04d-%02d", $year, $month));
        $this->prepare();
    }

    protected function prepare(){
        // 建立一个数组， 包含一个月每天的信息
        // 会适当地填充
        // 开头和末尾
        // 首先， 第一行显示星期几
        foreach (['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'] as $dow){
            $endOfRow = ($dow == 'Sa');
            $this->days[] = ['type' => 'dow', 'label' => $dow, 'endOfRow' => $endOfRow];
        }

        // 接下来， 在一周的第一天之前放置占位符
        for ($i = 0, $j = $this->monthToUse->format('w'); $i < $j; $i++){
            $this->days[] = ['type' => 'blank'];
        }

        // 然后， 对于这个月的每一天分别有一项
        $today = date('Y-m-d');
        $days = new DatePeriod($this->monthToUse, new DateInterval('P1D'), $this->monthToUse->format('t') - 1);
        foreach ($days as $day){
            $isToday = ($day->format('Y-m-d') == $today);
            $endOfRow = ($day->format('w') == 6);
            $this->days[] = ['type' => 'day', 'label' => $day->format('j'), 'today' => $isToday, 'endOfRow' => $endOfRow];
        }

        // 最后， 如果 endOfWeek 不是这个月最后一天
        // 在末尾放置占位符
        if (! $endOfRow){
            for ($i = 0, $j = 6 - $day->format('w'); $i < $j; $i++){
                $this->days[] = ['type' => 'blank'];
            }
        }
    }

    public function html($opts = [])
    {
        if(! isset($opts['id'])){
            $opts['id'] = 'calendar';
        }
        if(! isset($opts['month_link'])){
            $opts['month_link'] = '<a href="'.htmlentities($_SERVER['PHP_SELF']).'?'.'month=%d&amp;year=%d>%s</a>';
        }
        $classes = [];
        foreach (['prev', 'month', 'next', 'weekday', 'blank', 'day', 'today'] as $class){
            if(isset($opts['class']) && isset($opts['class'][$class])){
                $classes[$class] = $opts['class'][$class];
            }else{
                $classes[$class] = $class;
            }
        }

        /** 为上个月建立一个DateTime */
        $prevMonth = clone $this->monthToUse;
        $prevMonth->modify("-1 month");
        $prevMonthLink = sprintf($opts['month_link'], $prevMonth->format('m'), $prevMonth->format('Y'), '&laquo;');

        /** 为下个月建立一个DateTime */
        $nexeMonth = clone $this->monthToUse;
        $nexeMonth->modify("+1 month");
        $nexeMonthLink = sprintf($opts['month_link'], $nexeMonth->format('m'), $nexeMonth->format('Y'), '&raquo;');

        $html = '<table id="'.htmlentities($opts['id']).'"><tr>
            <td class="'.htmlentities($classes['prev']).'">'.$prevMonthLink.'</td>
            <td class="'.htmlentities($classes['month']).'" colspan="5">'.$this->monthToUse->format('F Y').'</td>
            <td class="'.htmlentities($classes['next']).'">'.$nexeMonthLink.'</td>
        </tr>';
        $html .= '<tr>';

        $lastDayIndex = count($this->days) - 1;
        foreach ($this->days as $i => $day){
            switch ($day['type']) {
                case 'dow':
                    $class = 'weekday';
                    $label = htmlentities($day['label']);
                    break;
                case 'blank':
                    $class = 'blank';
                    $label = '&nbsp;';
                    break;
                case 'day':
                    $class = $day['today'] ? 'today' : 'day';
                    $label = htmlentities($day['label']);
                    break;
            }
                $html .= '<td class="'.htmlentities($classes[$class]).'">'.$label.'</td>';

            if(isset($day['endOfRow']) && $day['endOfRow']) {
                $html .= "</tr>\n";
                if ($i != $lastDayIndex) {
                    $html .= '<tr>';
                }
            }
        }
        $html .= '</table>';
        return $html;
    }

    public function text()
    {
        $lineLength = strlen('Su Mo Tu We Th Fr Sa');
        $header = $this->monthToUse->format('F Y');
        $headerSpacing = floor($lineLength - strlen($header))/2;

        $text = str_repeat(' ', $headerSpacing).$header."\n";
        foreach ($this->days as $i => $day){
            switch ($day['type']){
                case 'dow':
                    $text .= sprintf('% 2s', $day['label']);
                    break;
                case 'blank':
                    $text .= ' ';
                    break;
                case 'day':
                    $text .= sprintf('% 2d', $day['label']);
                    break;
            }
            $text .= (isset($day['endOfRow']) && $day['endOfRow']) ? "\n" : " ";
        }
        if($text[strlen($text) - 1] != "\n"){
            $text .= "\n";
        }
        return $text;
    }
}

