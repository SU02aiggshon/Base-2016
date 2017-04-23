<?php
/**
 * Created by PhpStorm.
 * User: Slagga
 * Date: 2017/4/23
 * Time: 14:00
 */
// 安装 PSR-0 兼容的类自动加载工具
spl_autoload_register(function($class){
    require preg_replace('{\\\\|_(?!.*\\\\)}', DIRECTORY_SEPARATOR, trim($class, '\\')).'.php';
});

// 使用 Markdown 表示类　Wiki　的文本标记
// 位于 http://michelf.ca/projects/php-markdown/
use \Michelf\Markdown;

// 存储 Wiki 页面的目录
// 确保 Web 服务器用户可以写这个目录
define('PAGEDIR', dirname(__FILE__ . '.pages'));

// 得到页面名， 或者使用默认页面名
$page = isset($_GET['page']) ? $_GET['page'] : 'Home';

// 确定要做什么： 显示一个编辑表单     保存一个编辑表单    或者显示一个页面
if (isset($_GET['edit'])) {
    pageHeader($page);
    edit($page);
    pageFooter($page, false);
}else if(isset($_POST['edit'])){
    file_put_contents(pageToFile($_POST['page']), $_POST['contents']);
    header('Location: http://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'].'?page='.urlencode($_POST['page']));
    exit();
}else{
    pageHeader($page);
    if(is_readable(pageToFile($page))){
        // 获取内容
        $text = file_get_contents(pageToFile($page));
        // 转换 Markdown 语法 （使用上面加载的 Marddown 库）
        $text = Markdown::defaultTransform($text);
        // 使 【links】 链接到其他 wiki 页面
        $text = wikiLinks($text);
        // 显示这个页面
        echo $text;
        // 显示页脚
        pageFooter($page, false);
    }
}

// 页眉。 相当简单，只有标题和常见的 HTML 部件
function pageHeader($page) { ?>
<html>
<head>
    <title>Wiki <?php echo htmlentities($page) ?></title>
</head>
<body>
<h1><?php echo htmlentities($page) ?></h1>
<hr/>
<?php
}

// 页脚。有一个“最后一次修改”时间戳，一个可选的
// Edit 链接， 还有一个返回 Wiki 首页的链接
function pageFooter($page, $displayEditLink){
    $timestap = @filemtime(pageToFile($page));
    if ($timestap){
        $lastModified = strftime('%c', $timestap);
    } else {
        $lastModified = 'Never';
    }
    if($displayEditLink){
        $editLink = ' - <a href="?page='.urlencode($page).'&edit=true">Edit</a>';
    }else{
        $editLink = '';
    }
?>
<hr/>
<em>Last Modified: <?php echo $lastModified ?></em>
<?php echo $editLink ?> - <a href="<?php echo $_SERVER['SCRIPT_NAME'] ?>">Home</a>
</body>
</html>
<?php
}

// 显示一个编辑表单。如果页面已经存在
// 则在这个表单中包含页面的当前内容
function edit($page, $isNew = false){
    if($isNew){
        $contents = '';
?>
<p><b>This page doesn't exist yet.</b> To create it, enter its contents below and click the <b>Save</b> button.</p>
<?php
    } else {
        $contents = file_get_contents(pageToFile($page));
    }
?>
<form method="post" action="<?php echo htmlentities($_SERVER['SCRIPT_NAME']) ?>">
    <input type="hidden" name="edit" value="true">
    <input type="hidden" name="page" value="<?php echo htmlentities($page) ?>">
    <textarea name="contents" rows="20" cols="60"><?php echo htmlentities($contents) ?></textarea>
    <br/>
    <input type="submit" value="Save">
</form>
<?php
}

// 将提交的页面转换为一个文件名。这里使用 md5() 避免 $page 中的特殊字符带来安全问题
function pageToFile($page){
    return PAGEDIR.'/'.md5($page);
}

// 将页面中诸如 [something] 的文本转换为一个 HTML链接 指向 Wiki 页面 "something"
function wikiLinks($page){
    if(preg_match_all('/\[([^\]]+?)\]/', $page, $matches, PREG_SET_ORDER)){
        foreach ($matches as $match){
            $page = str_replace($match[0].'<a href="'.$_SERVER['SCRIPT_NAME'].'?page='.urlencode($match[1]).'">'.htmlentities($match[1]).'</a>', $page);
        }
    }
    return $page;
}
?>







