<form id="install-form">
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
</form>