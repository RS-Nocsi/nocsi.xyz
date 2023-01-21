<?php
$jokes=file("jokes.txt");//读取文本文件
 
$count=count($jokes);// 获取数组个数
 
$random_num=rand(1,$count);//生成 1到数组个数最大值的数字
 
$joke=$jokes[$random_num];

echo $joke;