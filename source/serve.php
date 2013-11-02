<?php

require_once 'fontproxy.php';
require_once 'fonttypes.php';

$proxy = new FontProxy();

$proxy->addFont('Amatic-Regular', FontTypes::WOFF, '../fonts/Amatic/Amatic-Regular.woff');
$proxy->addFont('Amatic-Bold', FontTypes::WOFF, '../fonts/Amatic/Amatic-Bold.woff');

$proxy->addFont('Amatic-Regular', FontTypes::EOT, '../fonts/Amatic/Amatic-Regular.eot');
$proxy->addFont('Amatic-Bold', FontTypes::EOT, '../fonts/Amatic/Amatic-Bold.eot');

));

$proxy->addTypeFonts(FontTypes::TTF, array(
	'Amatic-Regular' => '../fonts/Amatic/Amatic-Regular.ttf',
	'Amatic-Bold' => '../fonts/Amatic/Amatic-Bold.ttf'
));


$proxy->addFont('Oxygen-Regular', FontTypes::WOFF, '../fonts/Oxygen/Oxygen-Regular.woff');
$proxy->addFont('Oxygen-Bold', FontTypes::WOFF, '../fonts/Oxygen/Oxygen-Bold.woff');

$proxy->addFont('Oxygen-Regular', FontTypes::EOT, '../fonts/Oxygen/Oxygen-Regular.eot');
$proxy->addFont('Oxygen-Bold', FontTypes::EOT, '../fonts/Oxygen/Oxygen-Bold.eot');

));

$proxy->addTypeFonts(FontTypes::TTF, array(
	'Oxygen-Regular' => '../fonts/Oxygen/Oxygen-Regular.ttf',
	'Oxygen-Bold' => '../fonts/Oxygen/Oxygen-Bold.ttf'
));



print_r($proxy);

$font = $proxy->getFont('BoldOblique-Regular', FontTypes::OTF);
print_r($font);

$support = $proxy->detectSupport($_SERVER['HTTP_USER_AGENT']);
print_r($support);

$serve = $proxy->serve('BoldOblique-BoldOblique', $_SERVER['HTTP_USER_AGENT']);
print_r($serve);
