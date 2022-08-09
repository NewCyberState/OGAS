<?
if($_REQUEST[CID])
    $CID=intval($_REQUEST[CID]);

$aMenuLinks = Array(
	Array(
		"Заказы",
		"/ipp/".$CID."/orders/",
		Array(), 
		Array("icon"=>"<i class=\"icon-copy\"></i>"), 
		"" 
	),
);
?>