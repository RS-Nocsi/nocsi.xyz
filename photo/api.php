<?php
#五大导师诞生及逝世
$marx    = array("05-05","03-14");
$engels  = array("11-28","08-05");
$lenin   = array("04-22","01-21");
$stalin  = array("12-21","03-05");
$mao     = array("12-26","09-09");

#时间
$time = date('m-d');

#判断
if(in_array($time,$marx))
{
    $img = "img/marx.jpg";
    header("Location: $img");
}
elseif(in_array($time,$engels))
{
    $img = "img/engels.jpg";
    header("Location: $img");
}
elseif(in_array($time,$lenin))
{
    $img = "img/lenin.jpg";
    header("Location: $img");
}
elseif(in_array($time,$stalin))
{
    $img = "img/stalin.jpg";
    header("Location: $img");
}
elseif(in_array($time,$mao))
{
    $img = "img/mao.jpg";
    header("Location: $img");
}
else
{
    $img_array = glob("img/*.{gif,jpg,png}",GLOB_BRACE);
    $img = array_rand($img_array);
    $img = $img_array[$img];
    header("Location: $img");
}
?>