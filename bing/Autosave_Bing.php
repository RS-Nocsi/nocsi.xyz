<?php
/*
 php抓取bing每日图片并保存
 如在服务器上执行，推荐在宝塔面板中添加计划任务
 代码来源于：https://codess.cc/archives/72.html
 本人做了小部分修改
*/
$path = 'imgs';   //设置图片缓存文件夹
$filename = date("Y-m-d") . '.jpg';  //用年-月-日来命名新的文件名
if (!file_exists($path.'/'. $filename))    //如果文件不存在，则说明今天还没有进行缓存
{
    if(!file_exists($path)) //如果目录不存在
    {
        mkdir($path, 0777); //创建缓存目录
    }
    $str = file_get_contents('https://cn.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1&mkt=zh-CN'); //读取必应api，获得相应数据
 
    $str = json_decode($str,true);
    $imgurl = 'https://cn.bing.com'.$str['images'][0]['url'];    //获取图片url
    $img = grabImage($imgurl, $path.'/'.$filename); //读取并保存图片
}
/*
 远程抓取图片并保存
*/
function grabImage($url, $filename = "")
{
    if($url == "") return false; //如果$url地址为空，直接退出
    if ($filename == "") //如果没有指定新的文件名
    {
        $ext = strrchr($url, ".");  //得到$url的图片格式
        $filename = date("Y-m-d") . $ext;  //用天月面时分秒来命名新的文件名
    }
    ob_start();         //打开输出
    readfile($url);     //输出图片文件
    $img = ob_get_contents();   //得到浏览器输出
    ob_end_clean();             //清除输出并关闭
    $size = strlen($img);       //得到图片大小
    $fp2 = @fopen($filename, "a");
    fwrite($fp2, $img);         //向当前目录写入图片文件，并重新命名
    fclose($fp2);
    return $filename;           //返回新的文件名
}