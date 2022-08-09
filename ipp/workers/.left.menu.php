<?
if($_REQUEST[CID])
    $CID=intval($_REQUEST[CID]);

$aMenuLinks = Array(
	Array(
		"Сотрудники",
		"/ipp/".$CID."/workers/",
		Array(), 
		Array("icon"=>"<i class=\"icon-people\"></i>"),
		"" 
	),
);
?>