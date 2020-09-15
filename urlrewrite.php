<?php
$arUrlRewrite=array (
  1 => 
  array (
    'CONDITION' => '#^/online/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#',
    'RULE' => 'alias=$1',
    'ID' => NULL,
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  3 => 
  array (
    'CONDITION' => '#^\\/?\\/mobileapp/jn\\/(.*)\\/.*#',
    'RULE' => 'componentName=$1',
    'ID' => NULL,
    'PATH' => '/bitrix/services/mobileapp/jn.php',
    'SORT' => 100,
  ),
  5 => 
  array (
    'CONDITION' => '#^/bitrix/services/ymarket/#',
    'RULE' => '',
    'ID' => '',
    'PATH' => '/bitrix/services/ymarket/index.php',
    'SORT' => 100,
  ),
  29 => 
  array (
    'CONDITION' => '#^/lkg/gos/referendum/add/#',
    'RULE' => '',
    'ID' => 'bitrix:blog',
    'PATH' => '/lkg/gos/referendum/add/index.php',
    'SORT' => 100,
  ),
  30 => 
  array (
    'CONDITION' => '#^/lkg/gos/referendum/my/#',
    'RULE' => '',
    'ID' => 'bitrix:blog',
    'PATH' => '/lkg/gos/referendum/my/index.php',
    'SORT' => 100,
  ),
  27 => 
  array (
    'CONDITION' => '#^/lkg/gos/discussion/my/#',
    'RULE' => '',
    'ID' => 'bitrix:blog',
    'PATH' => '/lkg/gos/discussion/my/index.php',
    'SORT' => 100,
  ),
  36 => 
  array (
    'CONDITION' => '#^/lkg/gos/law/executed/#',
    'RULE' => '',
    'ID' => 'bitrix:blog',
    'PATH' => '/lkg/gos/law/executed/index.php',
    'SORT' => 100,
  ),
  22 => 
  array (
    'CONDITION' => '#^/lkg/gos/law/approved/#',
    'RULE' => '',
    'ID' => 'bitrix:blog',
    'PATH' => '/lkg/gos/law/approved/index.php',
    'SORT' => 100,
  ),
  35 => 
  array (
    'CONDITION' => '#^/lkg/gos/law/rejected/#',
    'RULE' => '',
    'ID' => 'bitrix:blog',
    'PATH' => '/lkg/gos/law/rejected/index.php',
    'SORT' => 100,
  ),
  24 => 
  array (
    'CONDITION' => '#^/lkg/gos/petition/my/#',
    'RULE' => '',
    'ID' => 'bitrix:blog',
    'PATH' => '/lkg/gos/petition/my/index.php',
    'SORT' => 100,
  ),
  28 => 
  array (
    'CONDITION' => '#^/lkg/gos/referendum/#',
    'RULE' => '',
    'ID' => 'bitrix:blog',
    'PATH' => '/lkg/gos/referendum/index.php',
    'SORT' => 100,
  ),
  26 => 
  array (
    'CONDITION' => '#^/lkg/gos/discussion/#',
    'RULE' => '',
    'ID' => 'bitrix:blog',
    'PATH' => '/lkg/gos/discussion/index.php',
    'SORT' => 100,
  ),
  2 => 
  array (
    'CONDITION' => '#^/online/(/?)([^/]*)#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  0 => 
  array (
    'CONDITION' => '#^/stssync/calendar/#',
    'RULE' => '',
    'ID' => 'bitrix:stssync.server',
    'PATH' => '/bitrix/services/stssync/calendar/index.php',
    'SORT' => 100,
  ),
  25 => 
  array (
    'CONDITION' => '#^/lkg/gos/petition/#',
    'RULE' => '',
    'ID' => 'bitrix:blog',
    'PATH' => '/lkg/gos/petition/index.php',
    'SORT' => 100,
  ),
  38 => 
  array (
    'CONDITION' => '#^/personal/groups/#',
    'RULE' => '',
    'ID' => 'bitrix:socialnetwork_group',
    'PATH' => '/personal/groups/index.php',
    'SORT' => 100,
  ),
  31 => 
  array (
    'CONDITION' => '#^/lkg/gos/law/my/#',
    'RULE' => '',
    'ID' => 'bitrix:blog',
    'PATH' => '/lkg/gos/law/my/index.php',
    'SORT' => 100,
  ),
  15 => 
  array (
    'CONDITION' => '#^/concept/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/concept/index.php',
    'SORT' => 100,
  ),
  6 => 
  array (
    'CONDITION' => '#^/groups/#',
    'RULE' => '',
    'ID' => 'bitrix:socialnetwork_group',
    'PATH' => '/groups/group.php',
    'SORT' => 100,
  ),
  11 => 
  array (
    'CONDITION' => '#^/people/#',
    'RULE' => '',
    'ID' => 'bitrix:socialnetwork_user',
    'PATH' => '/people/user.php',
    'SORT' => 100,
  ),
  9 => 
  array (
    'CONDITION' => '#^/photo/#',
    'RULE' => '',
    'ID' => 'bitrix:photogallery_user',
    'PATH' => '/photo/index.php',
    'SORT' => 100,
  ),
  10 => 
  array (
    'CONDITION' => '#^/about/#',
    'RULE' => '',
    'ID' => '',
    'PATH' => '/about.php',
    'SORT' => 100,
  ),
  17 => 
  array (
    'CONDITION' => '#^/users/#',
    'RULE' => '',
    'ID' => 'bitrix:socialnetwork_user',
    'PATH' => '/users/index.php',
    'SORT' => 100,
  ),
  39 => 
  array (
    'CONDITION' => '#^/forum/#',
    'RULE' => '',
    'ID' => 'bitrix:forum',
    'PATH' => '/forum/index.php',
    'SORT' => 100,
  ),
  4 => 
  array (
    'CONDITION' => '#^/rest/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/bitrix/services/rest/index.php',
    'SORT' => 100,
  ),
  37 => 
  array (
    'CONDITION' => '#^/work/#',
    'RULE' => '',
    'ID' => 'bitrix:socialnetwork_group',
    'PATH' => '/work/111.php',
    'SORT' => 100,
  ),
  20 => 
  array (
    'CONDITION' => '#^/faq/#',
    'RULE' => '',
    'ID' => 'bitrix:support.faq',
    'PATH' => '/faq/index.php',
    'SORT' => 100,
  ),
  33 => 
  array (
    'CONDITION' => '#^/#',
    'RULE' => '',
    'ID' => 'bitrix:socialnetwork_user',
    'PATH' => '/user/index.php',
    'SORT' => 100,
  ),
);
