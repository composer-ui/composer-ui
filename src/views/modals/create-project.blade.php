<form id="create-project-form">
	<label for="package">Project to create</label>
	<div class="input-group col-md-6">
		<input type="text" name="package" class="form-control" placeholder="vendor/package"/>
		<div class="input-group-addon">:</div>
		<input type="text" name="version" class="form-control" placeholder="1.0.0"/>
	</div>
	<div class="row">
	<div class="col-md-8">
		<label for="directory">Directory to install project</label>
		<input type="text" name="directory" class="form-control"/>
		<label for="repository-url">Custom repository to search for the package</label>
		<input type="text" name="repository-url" class="form-control"/>
	</div>
	<div class="col-md-4">
		<label for="stability">Minimum stability</label>
		<select name="stability" class="form-control">
			<option name="stable" selected>stable</option>
			<option name="RC">RC</option>
			<option name="beta">beta</option>
			<option name="alpha">alpha</option>
			<option name="dev">dev</option>
		</select>
	</div>
	</div>
	<br />
	<div class="radio-inline">
		<label>
			<input type="radio" name="prefer" value='dist' checked="checked" />Prefer dist.
		</label>
	</div>
	<div class="radio-inline">
		<label>
			<input type="radio" name="prefer" value='source'/>Prefer source (VCS)
		</label>
	</div>
	<div class="checkbox">
		<label>
			<input type="checkbox" name="dev" value='true'/>Install dev packages
		</label>
	</div>
	<div class="checkbox">
		<label>
			<input type="checkbox" name="no-install" value='true'/>Do not perform a vendor install
		</label>
	</div>
	<div class="checkbox">
		<label>
			<input type="checkbox" name="no-scripts" value='true'/>Skip execution of scripts defined in manifest
		</label>
	</div>
	<div class="checkbox">
		<label>
			<input type="checkbox" name="no-plugins" value='true'/>Disable plugins
		</label>
	</div>
	<div class="checkbox">
		<label>
			<input type="checkbox" name="keep-vcs" value='true'/>Keep VCS metadata
		</label>
	</div>
</form>