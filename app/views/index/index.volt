<h1>Youtube News und Artikel</h1>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="http://static1.gamespot.com/uploads/original/1197/11970954/2662342-farmingsimulator15-09.jpg" alt="Some Text">
      <div class="carousel-caption">
      </div>
    </div>
    <div class="item">
      <img src="http://vignette2.wikia.nocookie.net/farmingsimulator/images/f/f3/Farming-simulator-15_screen2.jpg/revision/latest?cb=20141029173146" alt="Test">
      <div class="carousel-caption">
      </div>
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div>
<h2>Willkommen</h2>
<p class="welcome">
	Willkommen beim LS-Project 2015!<br />
	Hier findest du alle Informationen, zum LS-Project 2015 und noch vieles mehr.
	<br />
	<h2>Wie registriere ich mich ?</h2>
	<p>
		Du kannst dich über die Funktion Registrieren in der Sidebar registrieren,
        danach kannst du das Forum und alle weitern Feautures der Seite nutzen!
	</p>
	<br />
	Bitte denke daran das wir auch nur <strike>Nerds</strike> Menschen, deswegen Teilt uns doch bitte mit wenn ihr entweder<br />
	<ul>
		<li>Einen Bug findet</li>
		<li>Unsauberkeit beim Styling</li>
		<li>Neue Ideen</li>
	</ul>

	<br /><br />
	Euer LS-Project Devteam
</p>
<h2 class="newsetPosts">Neuste Posts</h2>
{% if posts is defined %}
    {% for post in posts %}
        <p>{{ post.title }} von Muster!</p>
    {% endfor %}
{% endif %}
