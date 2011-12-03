<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>最新ツイート5件をスライドさせて表示</title>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" charset="utf-8"></script>
<script src="js/jquery.totemticker.min.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('#vertical-ticker').totemticker({
		row_height: '90px',
		speed: 1000,
		interval: 3000,
		mousestop: true,
		direction:'down'
	});
});
</script>

<style>
#tweet{
	padding:0 0 60px;
	background:url('twitter.gif') no-repeat 0 100%;
}

#vertical-ticker{
	width: 600px;
	height: 90px;
	overflow: hidden;
	margin:0;
	padding-left: 10px;
	background: #eee;
	border-radius: 3px;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
}

#vertical-ticker a{
	text-decoration:none;
}

#vertical-ticker li{
	display: block;
	font-size:0.85em;
	height: 70px;
	padding: 10px;
	line-height: 1.6;
}

#vertical-ticker li .time{
	font-size:0.7em;
	color:#999;
}
</style>

</head>

<body>
<div id="tweet">
	<?php  
    $username = 'shirokuro331';  
    $url = "http://twitter.com/statuses/user_timeline.xml?id=" . $username . "&count=5";  
    $rss = simplexml_load_file($url);  
    
    echo "<ul id='vertical-ticker'>"; 
    foreach ($rss->status as $i) {  
        $val = $i->text;  
        $val = ereg_replace("(http)(://[[:alnum:]\S\$\+\?\.-=_%,:@!#~*/&]+)","<a href=\"\\1\\2\" target=\"_blank\">\\1\\2</a>",$val);  
        $val = ereg_replace("(@)([[:alnum:]\S\$\+\?\.-=_%,:@!#~*/&]+)","<a href=\"http://twitter.com/\\2\" target=\"_blank\">\\1\\2</a>",$val); 
        
        echo "<li>" . $val . "<br />";  
        echo "<a href=\"http://twitter.com/" . $i->user->screen_name . "/status/" . $i->id ."\" class='time'>";  
        echo date( "Y年m月d日H時i分", strtotime( $i->created_at ) );  
        echo "</a>";  
        echo "</li>";
    }
    echo "</ul>";
    ?> 
</div>
</body>
</html>
