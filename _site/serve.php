<?php

require_once './fontproxy.php';
require_once './fonttypes.php';

$proxy = new FontProxy();

$proxy->addFont('LuxiSans-Regular', FontTypes::OTF, './assets/fonts/LuxiSans/LuxiSans-Regular.otf');
$proxy->addFont('LuxiSans-Bold', FontTypes::OTF, './assets/fonts/LuxiSans/LuxiSans-Bold.otf');
$proxy->addFont('LuxiSans-BoldOblique', FontTypes::OTF, './assets/fonts/LuxiSans/LuxiSans-BoldOblique.otf');

$proxy->addFont('LuxiSans-Regular', FontTypes::EOT, './assets/fonts/LuxiSans/LuxiSans-Regular.eot');
$proxy->addFont('LuxiSans-Bold', FontTypes::EOT, './assets/fonts/LuxiSans/LuxiSans-Bold.eot');
$proxy->addFont('LuxiSans-BoldOblique', FontTypes::EOT, './assets/fonts/LuxiSans/LuxiSans-BoldOblique.eot');

$proxy->addFontTypes('LuxiSans - Bold Italic', array(
	FontTypes::OTF => './assets/fonts/LuxiSans/LuxiSans-BoldIt.otf',
	FontTypes::EOT => './assets/fonts/LuxiSans/LuxiSans-BoldIt.eot'
));

$proxy->addTypeFonts(FontTypes::TTF, array(
	'LuxiSans-Regular' => './assets/fonts/LuxiSans/LuxiSans-Regular.ttf',
	'LuxiSans-Bold' => './assets/fonts/LuxiSans/LuxiSans-Bold.ttf',
	'LuxiSans-Oblique' => './assets/fonts/LuxiSans/LuxiSans-Oblique.ttf',
	'LuxiSans-BoldOblique' => './assets/fonts/LuxiSans/LuxiSans-BoldOblique.ttf'
));

print_r($proxy);

$font = $proxy->getFont('BoldOblique-Regular', FontTypes::OTF);
print_r($font);

$support = $proxy->detectSupport($_SERVER['HTTP_USER_AGENT']);
print_r($support);

$serve = $proxy->serve('BoldOblique-BoldOblique', $_SERVER['HTTP_USER_AGENT']);
print_r($serve);