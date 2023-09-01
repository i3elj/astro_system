<?php

namespace Tags;

function head(string $title, array $styles)
{
	$style_tags = '';
	foreach ($styles as $style)
		$style_tags = $style_tags . "<link rel='stylesheet' type='text/css' href='$style'>";

	echo "<head>
			<title>$title</title>
			<link rel='stylesheet' type='text/css' href='/public/style.css'>
			$style_tags
			<link rel='preconnect' href='https://fonts.googleapis.com'>
			<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
			<link href='https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;700&display=swap' rel='stylesheet'>
	</head>";
}
