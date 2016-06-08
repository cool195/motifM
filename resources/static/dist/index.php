<?php
$dir = dirname(__FILE__) . "/";//这里输入其它路径
//PHP遍历文件夹下所有文件
$handle = opendir($dir . ".");
//定义用于存储文件名的数组
$array_file = array();
while (false !== ($file = readdir($handle))) {
    if (strstr($file,'.html',true)){
        echo '<a href="'.$file.'">'.$file.'</a><br>';
    }
}
closedir($handle);
?>