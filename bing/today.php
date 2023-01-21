<?php
$json_content = file_get_contents("https://cn.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1&mkt=zh-CN");
$json_content = json_decode($json_content, true);
$img_url = "https://cn.bing.com" . $json_content["images"][0]["url"];
header("Location: $img_url");
?>