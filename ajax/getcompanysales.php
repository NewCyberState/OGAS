<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main;
use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
use Bitrix\Blog;

Loader::includeModule('main');
Loader::includeModule('blog');
Loader::includeModule('socialnetwork');
Loader::includeModule('vote');

$sales=new \OGAS\Economy\Company($_REQUEST[ID]);
$sales->GetSales();
$sales->GetAjaxData();