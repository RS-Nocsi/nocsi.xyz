<?php

/*
.*.@File：Main
 * @Author: Abyss
 * @Date: 2022-05-11
 * @LastEditTime: 2022-05-21
 */
 
#读取必要信息
$Json = file_get_contents("state.json");
$array = json_decode($Json, true);

#读取必要信息并存进变量内
$State = $array["State"];
$Content = $array["Content"];
$Time = $array["End_Time"];

#Main
if($State == "Notice") 
{
    require "notice.php";
    $Notice_State = notice($Content,$Time);
    if($Notice_State == "TimeOut")
    {
        $file = fopen("state.json", "w") or die("Unable to open file!");
        $txt = '{"State": "None","Content": "None","End_Time": "None"}';
        fwrite($file, $txt);
        fclose($file);
    }
    else
    {
        echo(notice($Content,$Time));
    }
}
else
{
    require "text.php";
    text();
}
?>