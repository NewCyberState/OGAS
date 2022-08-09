<?
if($_REQUEST[CID])
    $CID=intval($_REQUEST[CID]);

$aMenuLinks = Array(
	Array(
		"Складские остатки",
		"/ipp/".$CID."/sklad/",
		Array(), 
		Array("icon"=>"<i class=\"icon-copy\"></i>"), 
		"" 
	),
);
?>