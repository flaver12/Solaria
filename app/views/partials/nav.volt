<nav class="navbar ls-navbar" role="navigation">
	<div class="container">
		<div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      {{ link_to('', 'LS-Project-2015', 'class':'navbar-brand') }}
	    </div>
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	    	<ul class="nav navbar-nav ">
	    		<li>{{ link_to('forum', 'Forum') }}</li>
	    		<li>{{ link_to('about', 'About') }}</li>
	    	</ul>
	    </div>
	</div>
</nav>
