<?php

/*
.*.@File：TEXT
 * @PHP Program-Author: Abyss
 * @JSON File-Author：Abyss and July
 * @Date: 2022-04-22
 * @LastEditTime: 2022-05-12
 */
 
function text(){
    #时间
    $time = date('m-d');
    $this_year = date('Y');
    
    #读取JSON文件
    $Json = file_get_contents("list.json");
    $array = json_decode($Json, true);
    
    if (array_key_exists($time,$array))
    {
        #读取对应年份以及计算差值
        $year = $array[$time]["year"];
        $year_difference = $this_year - $year;
        #读取对应的纪念文本信息并与年份差值进行拼接
        $part1 = $array[$time]["part1"];
        $part2 = $array[$time]["part2"];
        $sentence = $part1.$year_difference.$part2;
        #输出文本
        echo('<h4 align="center">'.$sentence.'</h4>');
    }
    else
    {
        #读取默认的文本信息并进行拼接
        $part1 = $array["default"]["part1"];
        $part2 = $array["default"]["part2"];
        $sentence = $part1.$part2;
        #输出文本
        echo('<p align="center">'.$sentence.'</p>');
    }
}
?>