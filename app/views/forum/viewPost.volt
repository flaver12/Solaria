<script>
    $(document).ready(function() {
        var wbbOpt = {
            buttons: "bold,italic,underline,|,img,link,|,code,quote"
        }
        $("#editor").wysibb(wbbOpt);
        $("#editor").val('');
        $("#editor").sync();
    })
</script>
<h1>Forum</h1>
<div>
    <div class="userinfos">
        <div class="userImg">
            <img src="https://upload.wikimedia.org/wikipedia/commons/5/57/Lorem_Ipsum_Helvetica.png" width="90px" height="90px"/>
        </div>
        <div class="username">
            <a href="/member/{{ user.username }}">{{ user.username }}</a>
            <br />
            Anzahl Posts: 2<br />
            Mitglied seit: {{ date('d.m.o', user.created) }}
            {% if user.group_id == 2 %}
            <br /> Devstorm-Team
            {% endif %}
        </div>
    </div>
    <div class="content">
        <div class="title">
            <h2>{{ post.title }}</h2>
            {{ parsedContent }}
        </div>
    </div>
</div>
<hr />

<?php
if(isset($replays)) {
    foreach($replays as $replay): ?>
        <div class="replay">
            <div class="userinfos">
                <div class="userImg">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/57/Lorem_Ipsum_Helvetica.png" width="90px" height="90px"/>
                </div>
                <div class="username">
                    <a href="/member/<?php echo $replay['userObj']['username']; ?>"><?php echo $replay['userObj']['username']; ?></a>
                    <br />
                    Anzahl Posts: 2<br />
                    Mitglied seit: <?= date('d.m.o',$replay['userObj']['created']); ?>
                    <?php if($replay['userObj']['group_id'] == 2): ?>
                        <br /> Devstorm-Team
                    <?php endif; ?>
                </div>
            </div>
            <div class="content">
                <?= $replay['body']; ?>
            </div>
        </div>
    <hr />
    <?php endforeach; ?>
<?php } ?>
<div class="editor">
    <h2>Antworten</h2>
    <form action="/forum/replay/{{ post.thread_id }}/{{ post.id }}" class="form-horizontal" method="post" role="form">
        <div class="form-group">
            <div class="col-sm-10">
                <div>
                    {{ text_area('body', 'class':'form-control', 'id':'editor') }}
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-ok"></span> Posten</button>
    </form>
</div>
