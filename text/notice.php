<?php

/*
.*.@File：Notice
 * @PHP Program-Author: Abyss
 * @JSON File-Author：Abyss
 * @Date: 2022-05-11
 * @LastEditTime: 2022-05-11
 */
 
function notice($Content,$Time)
{
    #时间
    $Now_Time = date("Y-m-d");
    
    #时间判断和公告输出
    if($Now_Time == $Time)
    {
       return "TimeOut"; 
    }
    else
    {
        return '<p align="center">'.$Content.'</p>';
    }
}
?>