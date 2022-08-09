<?
if($_REQUEST[CID])
    $CID=intval($_REQUEST[CID]);

$aMenuLinks = Array(
	Array(
		"Профиль",
		"/ipp/".$CID."/company/",
		Array(), 
		Array("icon"=>"<i class=\"icon-copy\"></i>"), 
		"" 
	),
);
?>