<?php

require_once 'fontproxy.php';
require_once 'fonttypes.php';

$proxy = new FontProxy();

$proxy->addFontTypes('Amatic-Regular', array(
	FontTypes::OTF => 'fonts/amatic/amatic-regular.otf',
	FontTypes::EOT => 'fonts/amatic/amatic-regular.eot',
	FontTypes::TTF => 'fonts/amatic/amatic-regular.ttf'
))->addFontTypes('LuxiSans-Bold', array(
	FontTypes::OTF => 'fonts/amatic/amatic-bold.otf',
	FontTypes::EOT => 'fonts/amatic/amatic-bold',
	FontTypes::TTF => 'fonts/amatic/amatic-bold.ttf'
));


$proxy->addFontTypes('Oxygen-Regular', array(
	FontTypes::OTF => 'fonts/oxygen/oxygen-regular.otf',
	FontTypes::EOT => 'fonts/oxygen/oxygen-regular.eot',
	FontTypes::TTF => 'fonts/oxygen/oxygen-regular.ttf'
))->addFontTypes('Oxygen-Bold', array(
	FontTypes::OTF => 'fonts/oxygen/oxygen-bold.otf',
	FontTypes::EOT => 'fonts/oxygen/oxygen-bold',
	FontTypes::TTF => 'fonts/oxygen/oxygen-bold.ttf'
));

$declarations = '';
$sniff = $proxy->sniff($_SERVER['HTTP_USER_AGENT']);
$fonts = isset($_GET['font']) ? explode('|', urldecode($_GET['font'])) : array();

if (sizeof($fonts) > 0)
{
	foreach ($fonts as $font)
	{
		$extra = '-Regular';
		$weight = '';
		$style = '';
		$font = explode(':', $font);

		if (sizeof($font) > 1)
		{
			switch (strtolower($font[1]))
			{
				case 'b':
				case 'bold':
					$weight = 'bold';
					$extra = '-Bold';
					break;
				case 'i':
				case 'italic':
				case 'o':
				case 'oblique':
					$style = 'oblique';
					$extra = '-Oblique';
					break;
				case 'bi':
				case 'bold italic':
					$weight = 'bold';
					$style = 'oblique';
					$extra = '-BoldOblique';
					break;
			}
		}

		$font = $font[0];
		$served = $proxy->serve($font . $extra, $_SERVER['HTTP_USER_AGENT']);
		if (sizeof($served) > 0)
		{
			$keys = array_keys($served);
			$declarations .= '@font-face {';
			$declarations .= 'font-family: "' . $font . '";';

			if ($weight)
			{
				$declarations .= 'font-weight: ' . $weight . ';';
			}
			if ($style)
			{
				$declarations .= 'font-style: ' . $style . ';';
			}

			if ($sniff && strtolower($sniff['browser']) == 'ie')
			{
				$declarations .= 'src: url("' . $served[$keys[0]] . '");';
			}
			else
			{
				$declarations .= 'src: url("' . $served[$keys[0]] . '") format("' . $keys[0] . '");';
			}

			$declarations .= '}';
		}
	}
}

// Menno van Slooten (http://mennovanslooten.nl)
header('Content-type: text/css');

if ($declarations)
{
	echo $declarations;
}
else
{
	echo '/* no fonts to show */';
}