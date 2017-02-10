<h1>Forum</h1>
<p>Forum</p>
<table class="table table-bordered">
    <thead>
        <tr>
            <td>Name</td>
            <td>Description</td>
        </tr>
    </thead>
    <tbody>
    {% for thread in threads %}
        <tr>
            <td><a href="/forum/view-thread/{{ thread.id }}">{{ thread.name }}</a></td>
            <td>W.I.P</td>
        </tr>
    {% endfor %}
    </tbody>
</table>