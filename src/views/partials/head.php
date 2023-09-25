<?php

namespace Tags;

function head(string $title)
{
	echo "<head>
			<title>$title</title>
			<link rel='stylesheet' type='text/css' href='/public/style.css'>
			<link rel='preconnect' href='https://fonts.googleapis.com'>
			<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
			<link href='https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;700&display=swap' rel='stylesheet'>
			<script src='https://unpkg.com/htmx.org@1.9.5'></script>
	</head>";
}
