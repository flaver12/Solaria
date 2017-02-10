<h1>Forum</h1>
<script>
    $(document).ready(function() {
        var wbbOpt = {
            buttons: "bold,italic,underline,|,img,link,|,code,quote"
        }
        $("#editor").wysibb(wbbOpt);
    })
</script>
<p>Aktuller Thread: {{ thread.name }}</p>
{% if beFirst is defined %}
        <p>Sei der/die erste der hier ein Thema er&ouml;ffnet!</p>
{% else %}
    <table class="table table-bordered">
        <thead>
        <tr>
            <td>Name</td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        {% for post in posts %}
        <tr>
            <td><a href="/forum/view-post/{{ post.thread_id }}/{{ post.id }}/{{  post.title }}">{{ post.title }}</a></td>
            <td>
                Erstellt: {{ date('d F', post.created) }} um {{ date('G:i:s', post.created) }} von {{ post.getUser().username }}
            </td>
        </tr>
        {% endfor %}
        </tbody>
    </table>
{% endif %}
{% if session.has('auth') %}
    <form action="/forum/create/post/{{ thread.id }}" class="form-horizontal" method="post" role="form">
        <div class="form-group">
            <div class="col-sm-10">
                {{ text_field('title', 'class':'form-control', 'placeholder':'Title') }}
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-10">
                <div>
                    {{ text_area('body', 'class':'form-control', 'id':'editor') }}
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-ok"></span> Posten</button>
    </form>
{% else %}
    <p>Bitte logge dich ein</p>
{% endif %}