<form id="init-form">
<div class="row">
<div class="col-md-6">
	<label for="name">Package Name</label>
	<input type="text" name="name" class="form-control" placeholder="vendor/package"/>
	<label for="description">Description</label>
	<input type="text" name="description" class="form-control"/>
	<label for="author">Author</label>
	<input type="text" name="author" class="form-control"/>
	<label for="homepage">Homepage</label>
	<input type="text" name="homepage" class="form-control" placeholder="http://"/>
	<label for="stability">Minimum stability</label>
		<select name="stability" class="form-control">
			<option name="stable" selected>stable</option>
			<option name="RC">RC</option>
			<option name="beta">beta</option>
			<option name="alpha">alpha</option>
			<option name="dev">dev</option>
		</select>
</div>
<div class="col-md-6">
<label>Required packages</label>

	<div class="input-group package-input">
		<input type="text" name="package" class="form-control" placeholder="vendor/package"/>
		<div class="input-group-addon">:</div>
		<input type="text" name="value" class="form-control" placeholder="1.0.0"/>
	</div>

	<label>Required packages(dev)</label>
	<div class="input-group dev-package-input">
		<input type="text" name="package" class="form-control" placeholder="vendor/package"/>
		<div class="input-group-addon">:</div>
		<input type="text" name="value" class="form-control" placeholder="1.0.0"/>
	</div>
</div>
</div>
</form>