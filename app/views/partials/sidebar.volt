{% if session.has('auth') %}
        {% set auth = session.get('auth') %}
        <h2>Willkommen {{ auth['username'] }}</h2>
        <h4>ControllPanel</h4>
        <hr />
        <div>
            <a href="/logout"><button type="button" class="btn btn-default navbar-btn"><span class="glyphicon glyphicon-remove-sign"></span> Logout</button></a><br />
            <a href="/profile/edit/{{ auth['username'] }}"><button type="button" class="btn btn-default navbar-btn"><span class="glyphicon glyphicon-pencil"></span> Profile vearbeiten</button></a><br />
            {% if auth['group'] == 2 %}
                <a href="/backhand/addNews"><button type="button" class="btn btn-default navbar-btn"><span class="glyphicon glyphicon-remove-sign"></span> News erfassen</button></a><br />
            {% endif %}
        </div>
{% else %}
    <script>
        $(document).ready(function() {
            $('button.glyphicon-github').prop('disabled', true);
        });
    </script>
    <h2>Sidebar</h2>
    <!--<button onclick="alert('Diese Funktion ist W.I.P :(')" type="button" class="btn btn-default navbar-btn"><span class="glyphicon glyphicon-github"></span> Login mit Github</button></a><br />-->
    <button onclick="devstorm_Helper.loginBox();" type="button" class="btn btn-default navbar-btn"><span class="glyphicon glyphicon-asterisk"></span> Login</button>
    <ul>
        <li>{{ link_to('register', 'Registrieren') }}</li>
        <li>{{ link_to('lostpassword', 'Passwort vergsessen') }}</li>
    </ul>
    <br />
    <!--UI STUFF-->
    <div id="dialog-confirm" style="display:none"></div>
{% endif %}
<!--INFOS FOR ALL-->
<div>
    <b>User online</b><br />
    {% for user in onlineUser %}
        {% if loop.last %}
            {{ user.username }}
        {% else %}
            {{ user.username }},
        {% endif %}
    {% endfor %}
</div>
