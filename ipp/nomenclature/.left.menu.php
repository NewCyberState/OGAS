<?
if($_REQUEST[CID])
    $CID=intval($_REQUEST[CID]);


$aMenuLinks = Array(
	Array(
		"Номенклатура",
		"/ipp/".$CID."/nomenclature/",
		Array(), 
		Array("icon"=>"<i class=\"icon-copy\"></i>"), 
		"" 
	),
);
?>