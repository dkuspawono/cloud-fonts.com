<?php

require_once 'fontproxy.php';
require_once 'fonttypes.php';

$proxy = new FontProxy();

$proxy->addFont('Amatic-Regular', FontTypes::OTF, 'fonts/Amatic/Amatic-regular.otf');
$proxy->addFont('Amatic-Bold', FontTypes::OTF, 'fonts/Amatic/Amatic-bold.otf');

$proxy->addFont('Amatic-Regular', FontTypes::EOT, 'fonts/Amatic/Amatic-regular.eot');
$proxy->addFont('Amatic-Bold', FontTypes::EOT, 'fonts/Amatic/Amatic-bold.eot')
));

$proxy->addTypeFonts(FontTypes::TTF, array(
	'Amatic-Regular' => 'fonts/Amatic/Amatic-regular.ttf',
	'Amatic-Bold' => 'fonts/Amatic/Amatic-bold.ttf'
));

print_r($proxy);

$font = $proxy->getFont('BoldOblique-Regular', FontTypes::OTF);
print_r($font);

$support = $proxy->detectSupport($_SERVER['HTTP_USER_AGENT']);
print_r($support);

$serve = $proxy->serve('BoldOblique-BoldOblique', $_SERVER['HTTP_USER_AGENT']);
print_r($serve);