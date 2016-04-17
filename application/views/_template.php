<!DOCTYPE html>
<!-- Template for pages -->
<html>
	<head>
		<title id="pageTitle">{pagetitle}</title>
		<meta charset="UTF-8" />
		<link type="text/css" rel="stylesheet" href="/assets/css/style.css" />
		<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
                <link rel="stylesheet" href="{bootstrapStyle}" />
                <meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
            <div id="navigation">
			{navigation}
		</div>
            <div id="body">
                <div id="header">
                    <div class="jumbotron"><h1>{pageheader}</h1></div>
                </div>
		<div id="content">
			{content}
		</div>
            <script type="text/javascript" src="{jQueryScript}"></script>
            <script type="text/javascript" src="{bootstrapScript}"></script>
            </div>
	</body>
</html>