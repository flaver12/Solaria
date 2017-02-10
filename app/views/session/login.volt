<h2>Login</h2>
    {{ form("login", "method":"post", "class":'form-horizontal', 'role':'form') }}
        <div class="form-group">
            <div class="col-sm-10">
               {{ text_field('username', 'class':'form-control', 'placeholder':'Username') }}
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-10">
                {{ password_field('password', 'class':'form-control', 'placeholder':'Passwort') }}
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Login</button>
            </div>
        </div>
    </form>
