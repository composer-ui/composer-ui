<form id="require-form">
	<label for="package">Packages to add</label>
	<div class="input-group package-input col-md-6">
		<input type="text" name="package" class="form-control" placeholder="vendor/package"/>
		<div class="input-group-addon">:</div>
		<input type="text" name="version" class="form-control" placeholder="1.0.0"/>
	</div>
	<div class="checkbox">
		<label>
			<input type="checkbox" name="dev" value='true'/>Add package to dev
		</label>
	</div>
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
			<input type="checkbox" name="ignore-platform-reqs" value='true'/>Ignore platform requirements
		</label>
	</div>
	<div class="checkbox">
		<label>
			<input type="checkbox" name="update-no-dev" value='false' checked/>Update dependencies but not dev dependecies
		</label>
	</div>
	<div class="checkbox">
		<label>
			<input type="checkbox" name="no-update" value='true'/>Disable the automatic update of the dependencies
		</label>
	</div>
	<div class="checkbox">
		<label>
			<input type="checkbox" name="update-with-dependencies" value='true'/>update dependencies of the newly required packages
		</label>
	</div>
</form>