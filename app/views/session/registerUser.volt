<h1>Neuer Member</h1>
<p>Bitte fülle das Forumlar aus um dich zu registrieren.<br />
Alle Fleder mit einem * müssen ausgefüllt werden.</p>
<form role="form" method="POST">
	<div class="form-group">
		<label>Username</label>
		{{ form.render('username') }}
		{{ form.messages('username') }}
	</div>
	<div class="form-group">
		<label>Passwort</label>
		{{ form.render('password1') }}
		{{ form.messages('password1') }}
	</div>
	<div class="form-group">
		<label>Passwort best&auml;tigen</label>
		{{ form.render('password2') }}
		{{ form.messages('password2') }}
	</div>
	<div class="form-group">
		<label>Email</label>
		{{ form.render('email') }}
		{{ form.messages('email') }}
	</div>
	{{ form.render('Sign Up') }}
</from>