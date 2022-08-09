<?
if($_REQUEST[CID])
    $CID=intval($_REQUEST[CID]);
$aMenuLinks = Array(
	Array(
		"Цены",
		"/ipp/".$CID."/prices/",
		Array(), 
		Array("icon"=>"<i class=\"icon-copy\"></i>"), 
		"" 
	),
);
?>