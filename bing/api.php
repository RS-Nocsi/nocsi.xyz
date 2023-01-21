<?php
#通过GET获取网址中传递的参数
$mode = $_GET['mode'];
$format = $_GET['format'];
#定义today函数
function today(){
    $json_content = file_get_contents("https://cn.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1&mkt=zh-CN");
    $json_content = json_decode($json_content, true);
    $img_url = "https://cn.bing.com" . $json_content["images"][0]["url"];
    return $img_url;
}

#定义day7函数
function day7(){
    $date = mt_rand(0, 7);
    $json_content = file_get_contents('https://cn.bing.com/HPImageArchive.aspx?format=js&idx=' . $date . '&n=1&mkt=zh-CN'); 
    $json_content = json_decode($json_content, true);
    $imgurl = 'https://cn.bing.com' . $json_content['images'][0]['url']; 
    return $imgurl;
}

#定义info函数
function info(){
    $json_content = file_get_contents("https://cn.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1&mkt=zh-CN");
    $json_content = json_decode($json_content, true);
    $date = $json_content["images"][0]["enddate"];
    $year = substr($date,0,4);
    $month = substr($date,4,-2);
    $day = substr($date,6);
    $info = $json_content["images"][0]["copyright"];
    $today_info = "该图片是".$year."年".$month."月".$day."日的Bing壁纸，版权归微软必应所有。\n \n该图片的官方介绍（copyright信息）:".$info;
    return $today_info;
}

#直接输出今日壁纸
if($mode == "today" and $format == "photo")
{
    $img = today();
    header("Location: $img");
}

#直接输出7日随机壁纸
if ($mode == "7day" and $format == "photo")
{
    $img = day7();
    header("Location: $img");
}
    
#Json格式输出今日壁纸
if($mode == "today" and $format == "json")
{
    $img = today();
    $data = array(
    "code"     => "0",
    "msg"      => "success",
    "mode"     => $mode,
    "format"   => $format,
    "result"   => $img,
    "version"  => "The current API version is 1.2.1, last updated on 2022/4/18"
    );
    $data_json = json_encode($data);
    $data_json = stripslashes($data_json);
    echo($data_json);
}

#Json格式输出7日随机壁纸
if($mode == "7day" and $format == "json")
{
    $img = day7();
    $data = array(
    "code"     => "0",
    "msg"      => "success",
    "mode"     => $mode,
    "format"   => $format,
    "result"   => $img,
    "version"  => "The current API version is 1.2.1, last updated on 2022/4/18"
    );
    $data_json = json_encode($data);
    $data_json = stripslashes($data_json);
    echo($data_json);
}

#txt格式输出info
if($mode == "info" and $format == "txt")
{
    $img = info();
    echo($img);
}

#Json格式输出info
if($mode == "info" and $format == "json")
{
    $img = info();
    $data = array(
    "code"     => "0",
    "msg"      => "success",
    "mode"     => $mode,
    "format"   => $format,
    "result"   => $img,
    "version"  => "The current API version is 1.2.1, last updated on 2022/4/18"
    );
    $data_json = json_encode($data,JSON_UNESCAPED_UNICODE);
    $data_json = stripslashes($data_json);
    echo($data_json);
}

#错误
if($mode == "today" and $format == null){
    $data = array(
    "code"       => "101",
    "msg"        => "No-format-information",
    "why"        => "您传入的mode参数值为“today”，但仍然需要您传入format参数值，您可以查看下面的建议信息!",
    "Suggest-1"  => "You can use: https://nocsi.xyz/bing/api.php?mode=today&format=photo",
    "Suggest-2"  => "You can also use: https://nocsi.xyz/bing/api.php?mode=today&format=json",
    "version"    => "The current API version is 1.2.1, last updated on 2022/4/18"
    );
    $data_json = json_encode($data,JSON_UNESCAPED_UNICODE);
    $data_json = stripslashes($data_json);
    echo($data_json);
}

#错误
if($mode == "7day" and $format == null){
    $data = array(
    "code"       => "102",
    "msg"        => "No-format-information",
    "why"        => "您传入的mode参数值为“7day”，但仍然需要您传入format参数值，您可以查看下面的建议信息!",
    "Suggest-1"  => "You can use: https://nocsi.xyz/bing/api.php?mode=7day&format=photo",
    "Suggest-2"  => "You can also use: https://nocsi.xyz/bing/api.php?mode=7day&format=json",
    "version"    => "The current API version is 1.2.1, last updated on 2022/4/18"
    );
    $data_json = json_encode($data,JSON_UNESCAPED_UNICODE);
    $data_json = stripslashes($data_json);
    echo($data_json);
}

#错误
if($mode == "info" and $format == null){
    $data = array(
    "code"       => "103",
    "msg"        => "No-format-information",
    "why"        => "您传入的mode参数值为“info”，但仍然需要您传入format参数值，您可以查看下面的建议信息!",
    "Suggest-1"  => "You can use: https://nocsi.xyz/bing/api.php?mode=info&format=txt",
    "Suggest-2"  => "You can also use: https://nocsi.xyz/bing/api.php?mode=info&format=json",
    "version"    => "The current API version is 1.2.1, last updated on 2022/4/18"
    );
    $data_json = json_encode($data,JSON_UNESCAPED_UNICODE);
    $data_json = stripslashes($data_json);
    echo($data_json);
}

#错误
if($mode == null and $format == "photo"){
    $data = array(
    "code"       => "104",
    "msg"        => "No-mode-information",
    "why"        => "您传入的format参数值为“photo”，但仍然需要您传入mode参数值，您可以查看下面的建议信息!",
    "Suggest-1"  => "You can use: https://nocsi.xyz/bing/api.php?mode=today&format=photo",
    "Suggest-2"  => "You can also use: https://nocsi.xyz/bing/api.php?mode=7day&format=photo",
    "version"    => "The current API version is 1.2.1, last updated on 2022/4/18"
    );
    $data_json = json_encode($data,JSON_UNESCAPED_UNICODE);
    $data_json = stripslashes($data_json);
    echo($data_json);
}

#错误
if($mode == null and $format == "json"){
    $data = array(
    "code"       => "105",
    "msg"        => "No-mode-information",
    "why"        => "您传入的format参数值为“json”，但仍然需要您传入mode参数值，您可以查看下面的建议信息!",
    "Suggest-1"  => "You can use: https://nocsi.xyz/bing/api.php?mode=today&format=json",
    "Suggest-2"  => "You can use: https://nocsi.xyz/bing/api.php?mode=7day&format=json",
    "Suggest-3"  => "You can also use: https://nocsi.xyz/bing/api.php?mode=info&format=json",
    "version"    => "The current API version is 1.2.1, last updated on 2022/4/18"
    );
    $data_json = json_encode($data,JSON_UNESCAPED_UNICODE);
    $data_json = stripslashes($data_json);
    echo($data_json);
}

#错误
if($mode == null and $format == "txt"){
    $data = array(
    "code"       => "106",
    "msg"        => "No-mode-information",
    "why"        => "您传入的format参数值为“txt”，但仍然需要您传入mode参数值，您可以查看下面的建议信息!",
    "Suggest"    => "You can use: https://nocsi.xyz/bing/api.php?mode=info&format=txt",
    "version"    => "The current API version is 1.2.1, last updated on 2022/4/18"
    );
    $data_json = json_encode($data,JSON_UNESCAPED_UNICODE);
    $data_json = stripslashes($data_json);
    echo($data_json);
}

#错误
if($mode == null and $format == null){
    $data = array(
    "code"       => "107",
    "msg"        => "No-information",
    "why"        => "您没有传入任何参数，您可以查看下面的建议信息!",
    "Suggest-1"  => "You can use: https://nocsi.xyz/bing/api.php?mode=today&format=photo",
    "Suggest-2"  => "You can use: https://nocsi.xyz/bing/api.php?mode=today&format=json",
    "Suggest-3"  => "You can use: https://nocsi.xyz/bing/api.php?mode=7day&format=photo",
    "Suggest-4"  => "You can use: https://nocsi.xyz/bing/api.php?mode=7day&format=json",
    "Suggest-5"  => "You can use: https://nocsi.xyz/bing/api.php?mode=info&format=txt",
    "Suggest-6"  => "You can also use: https://nocsi.xyz/bing/api.php?mode=info&format=json",
    "version"    => "The current API version is 1.2.1, last updated on 2022/4/18"
    );
    $data_json = json_encode($data,JSON_UNESCAPED_UNICODE);
    $data_json = stripslashes($data_json);
    echo($data_json);
}
?>