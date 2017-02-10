<h1>Profile bearbeiten</h1>
<p>Username: {{ auth['username'] }}</p>
<form method="post" action="/profile/upload}}">
  <div class="form-group">
    <label for="exampleInputFile">File input</label>
    <input type="file" id="exampleInputFile">
    <p class="help-block">Example block-level help text here.</p>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
