<!DOCTYPE html>
<html lang="de">
	<head>
		{{ get_title() }}
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--CSS-->
		{{ stylesheet_link("https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css", false) }}
		{{ stylesheet_link("https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css", false) }}
		{{ stylesheet_link("//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css", false) }}
        {{ stylesheet_link("http://cdn.wysibb.com/css/default/wbbtheme.css", false) }}
		{{ stylesheet_link("css/main.css") }}
        {{ stylesheet_link("css/forum.css") }}
		<!--JS-->
		{{ javascript_include("//code.jquery.com/jquery-1.10.2.js", false) }}
		{{ javascript_include("//code.jquery.com/ui/1.11.2/jquery-ui.js", false) }}
		{{ javascript_include("https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js", false) }}
        {{ javascript_include("http://cdn.wysibb.com/js/jquery.wysibb.min.js", false) }}
		{{ javascript_include("js/helper.js") }}
	</head>
	<body>
		<!--Nav Partial-->
		{{ partial("partials/nav") }}
		<div class="container">
		<!--Error MSG-->
		{{ flashSession.output() }}
		<div class="row">
		  <div class="col-xs-12 col-md-8">
		  		{{ content() }}
		  </div>
		  <div class="col-xs-6 col-md-4">
		  	{{ partial("partials/sidebar") }}
		  </div>
		</div>
		</div>
	</body>
</html>