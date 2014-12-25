<form id="remove-form" class="selection-form">
<div class="row">
<div class="col-md-6">
	<label>
		<input type="radio" name="dev" value=0 checked/> Remove Main Packages
	</label>
	<select multiple size="3" name="packages" class="form-control" disabled>
		<?php
		$packages = array();
		if(isset($jsonComposer['require']))
			$packages = array_merge($jsonComposer['require'],$packages);
		?>
		@foreach($packages as $package => $version)
		<option value="{{{$package}}}">{{{$package}}}</option>
		@endforeach
	</select>
</div>
<div class="col-md-6">
	<label>
		<input type="radio" name="dev" value=1 /> Remove Dev Packages
	</label>
	<select multiple size="3" name="dev-packages" class="form-control" disabled>
		<?php
		$packages = array();
		if(isset($jsonComposer['require-dev']))
			$packages = array_merge($jsonComposer['require-dev'],$packages);
		?>
		@foreach($packages as $package => $version)
		<option value="{{{$package}}}">{{{$package}}}</option>
		@endforeach
	</select>
</div>
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