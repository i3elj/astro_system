<?php

namespace Tags;

function head(string $title, array $styles)
{
	$style_tags = "";
	foreach ($styles as $style)
		$style_tags = $style_tags . "<link rel='stylesheet' type='text/css' href='$style'>";

	echo "<head>
			<title>$title</title>
			<link rel='stylesheet' type='text/css' href='public/style.css'>
			$style_tags
		</head>";
}
