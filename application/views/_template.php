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
            
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="glyphicon glyphicon-menu-hamburger"></span>
                        </button>
                        <a class="navbar-brand" href="/"><h3 id="pageHeader">{pagetitle}</h3></a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">{navLinks}</ul>
                        {loginForm}
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
            <!-- /.container-fluid -->
            </nav>
            <div id="body">
                <div id="header">
                    <h1 id="pageHeader">{pageheader}</h1>
                </div>
		<div id="content">
			{content}
		</div>
            <script type="text/javascript" src="{jQueryScript}"></script>
            <script type="text/javascript" src="{bootstrapScript}"></script>
            </div>
	</body>
</html>