<div class='col-md-6'>
	<h3>{{$desc}}</h3>
	<table class="table table-hover">
	<thead>
		<tr>
			<th style="width:75%">Package</th>
			<th style="width:25%">Version</th>
		</tr>
	</thead>
	<tbody>
	@foreach($jsonComposer[$key] as $package => $version)
		<?php
			$stability = Composer\Package\Version\VersionParser::parseStability($version);
			if($stability == 'stable') 
				$class = 'btn-success';
			else 
				$class = 'btn-warning';
		?>
		<tr>
			<td><code>{{{$package}}}</code></td>
			<td><span class="btn btn-sm {{{$class}}} monospace">{{{$version}}}</span></td>
		</tr>
	@endforeach
	</tbody>
	</table>
</div>