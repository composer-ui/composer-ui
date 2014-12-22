<form id="update-form">
	<label>Packages to update</label>
	<select multiple size="3" name="packages" class="form-control">
		<option value="***" selected>All Packages</option>
		<?php
		$packages = array();
		if(isset($jsonComposer['require']))
			$packages = array_merge($jsonComposer['require'],$packages);
		if(isset($jsonComposer['require-dev']))
			$packages = array_merge($jsonComposer['require-dev'],$packages);
		?>
		@foreach($packages as $package => $version)
		<option value="{{{$package}}}">{{{$package}}}</option>
		@endforeach
	</select>
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
			<input type="checkbox" name="dry-run" value='true'/>Dry run
		</label>
	</div>
	<div class="checkbox">
		<label>
			<input type="checkbox" name="no-dev" value='false' checked/>Install dev. requirements
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
			<input type="checkbox" name="optimize-autoloader" value='true'/>Optimize autoloader
		</label>
	</div>
	<div class="checkbox">
		<label>
			<input type="checkbox" name="with-dependencies" value='true'/>Update dependencies recursively
		</label>
	</div>
	<div class="checkbox">
		<label>
			<input type="checkbox" name="lock" value='true'/>Only update the lock file hash to suppress warning about the lock file being out of date.
		</label>
	</div>
</form>