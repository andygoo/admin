<?php

/*
 * @description   文件上传方法
 * @author widuu  http://www.widuu.com
 * @mktime 08/01/2014
 */
 
global $QINIU_ACCESS_KEY;
global $QINIU_SECRET_KEY;

$QINIU_UP_HOST	= 'http://up.qiniu.com';
$QINIU_RS_HOST	= 'http://rs.qbox.me';
$QINIU_RSF_HOST	= 'http://rsf.qbox.me';

//配置$QINIU_ACCESS_KEY和$QINIU_SECRET_KEY 为你自己的key
//$QINIU_ACCESS_KEY	= 'KUN6xYZlOAtid2MjHm90-6VFY2M7HC90ijDH4uOR';
//$QINIU_SECRET_KEY	= 'D-K57TE5hPe3krexftxLWFKmL2xbQEKA-mtkrUfB';
$QINIU_ACCESS_KEY = 'o10EI_XJGKSSWoD-Zn-qWw72saZB3DIxHnJ1ghJ1';
$QINIU_SECRET_KEY = 'cCN4kA-tu4oxz6cnoTIDvv-9XvwI2g6-mwoXe8et';

//配置bucket为你的bucket
$BUCKET = "jiesc-net";

//配置你的域名访问地址
$HOST  = "http://7xkkhh.com1.z0.glb.clouddn.com";

//上传超时时间
$TIMEOUT = "3600";

//保存规则
$SAVETYPE = "date";

//开启水印
$USEWATER = false;
$WATERIMAGEURL = "http://gitwiduu.u.qiniudn.com/ueditor-bg.png"; //七牛上的图片地址
//水印透明度
$DISSOLVE = 50;
//水印位置
$GRAVITY = "SouthEast";
//边距横向位置
$DX  = 10;
//边距纵向位置
$DY  = 10;

function urlsafe_base64_encode($data){
	$find = array('+', '/');
	$replace = array('-', '_');
	return str_replace($find, $replace, base64_encode($data));
}


