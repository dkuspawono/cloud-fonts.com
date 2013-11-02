<?php

require_once './source/fontproxy.php';
require_once './source/fonttypes.php';

$proxy = new FontProxy();

$proxy->addFontTypes('Amatic-Regular', array(
	FontTypes::OTF => './fonts/Amatic/Amatic-Regular.otf',
	FontTypes::EOT => './fonts/Amatic/Amatic-Regular.eot',
	FontTypes::TTF => './fonts/Amatic/Amatic-Regular.ttf',
		FontTypes::WOFF => './fonts/Amatic/Amatic-Regular.woff'
))->addFontTypes('Amatic-Bold', array(
	FontTypes::OTF => './fonts/Amatic/Amatic-Bold.otf',
	FontTypes::EOT => './fonts/Amatic/Amatic-Bold.eot',
	FontTypes::TTF => './fonts/Amatic/Amatic-Bold.ttf',
	FontTypes::WOFF => './fonts/Amatic/Amatic-Bold.woff'

));


$proxy->addFontTypes('Oxygen-Regular', array(
	FontTypes::EOT => './fonts/oxygen/oxygen-regular.eot',
	FontTypes::TTF => './fonts/oxygen/oxygen-regular.ttf',
		FontTypes::WOFF => './fonts/oxygen/oxygen-regular.woff'
))->addFontTypes('Oxygen-Bold', array(
	FontTypes::EOT => './fonts/oxygen/oxygen-bold.eot',
	FontTypes::TTF => './fonts/oxygen/oxygen-bold.ttf',
	FontTypes::WOFF => './fonts/oxygen/oxygen-bold.woff'

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
