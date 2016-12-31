<?php

//PHP 程序调试函数
function dd($str = 0){
    if(is_array($str)){
        echo "<pre>";        var_dump($str);        echo "</pre>";
        die;
    }else{
        echo "<pre>{$str}</pre>";
        exit;
    }
}

//JS 代码调试函数，由于js函数冲突，使用ds
function ds($str = 0)
{
    echo '<script>console.log("' . ($str) . '");</script>';
}

/**
 * debug调试打印
 */
function debug()
{
    $args = func_get_args();
    header('Content-type: text/html; charset=utf-8');
    echo "\n<pre>---------------------------------debug调试信息.---------------------------------\n";
    foreach ($args as $value) {
        if (is_null($value)) {
            echo '[is_null]';
        } elseif (is_bool($value) || empty ($value)) {
            var_dump($value);
        } else {
            print_r($value);
        }
        echo "\n";
    }
    $trace = debug_backtrace();
    $next = array_merge(
        array(
            'line' => '??',
            'file' => '[internal]',
            'class' => null,
            'function' => '[main]'
        ), $trace[0]
    );
    $path = dirname(realpath(__DIR__));
    if (stripos($next['file'], $path) !== false) {
        $next['file'] = str_replace($path, '>DOCROOT', $next['file']);
    }
    echo "\n---------------------------------debug调试结束.---------------------------------\n\n文件位置:";
    echo $next['file']."\t第".$next['line']."行.\n";
    if(in_array('debug', $args)){
        echo "\n<pre>";
        print_r($trace);
    }
    //运行时间
    $TimeSpent = runtime();
    echo "页面执行时间: {$TimeSpent} 毫秒.";
    echo "</pre>";
    exit;
}

/**
 * 程序运行时间计算
 * @return string
 */
function runtime(){
    $StopTime = microtime(true);
    $TimeSpent = $StopTime - StartTime;
    return number_format($TimeSpent*1000, 4);
}
