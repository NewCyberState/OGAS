<?
if($_REQUEST[CID])
    $CID=intval($_REQUEST[CID]);


$aMenuLinks = Array(
	Array(
		"Производственные планы",
		"/ipp/".$CID."/plan/",
		Array(), 
		Array("icon"=>"<i class=\"icon-copy\"></i>"), 
		"" 
	),
);
?>