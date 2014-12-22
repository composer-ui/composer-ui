<h2>
	{{{$jsonComposer['type'] or 'library'}}}
	 : 
	<a href='{{{$jsonComposer["homepage"] or "#"}}}'><code>{{{$jsonComposer['name'] or ''}}}</code></a>
	@if (isset($jsonComposer['keywords'])) 
		@foreach($jsonComposer['keywords'] as $keyword)
			<span class='badge badge-info'>{{{$keyword}}}</span>
		@endforeach
	@endif
	<br />
	<small>
	{{{$jsonComposer['description'] or ''}}}
	</small>
</h2>
@if(isset($jsonComposer['license']))
<?php
	if(is_array($jsonComposer['license']))
		$license = implode($jsonComposer['license'],' or ');
	else
		$license = $jsonComposer['license'];
?>
<h4>
	<b>License:</b> 
	{{{trim($license,'()')}}}
</h4>
@endif
@if(isset($jsonComposer['authors']))
<h5>
	<b>Authors:</b> 
	@foreach($jsonComposer['authors'] as $index => $author)
		@if($index != 0)
		 | 
		@endif
		<b>{{{$author['name'] or ''}}}</b> 
		<small>
		<b>{{{$author['role'] or ''}}}</b>
		<a href="mailto:{{$author['email']}}">{{$author['email'] or ''}}</a>
		@if(isset($author['homepage']))
		<a href="{{{$author['homepage']}}}">{{{$author['homepage']}}}</a>
		@endif
		</small>
	@endforeach
</h5>
@endif
<div class='row'>
@if(isset($jsonComposer['require']))
	@include('ComposerUI::packageLinks',array('key'=>'require','desc'=>'Requires'))
@endif
@if(isset($jsonComposer['require-dev']))
	@include('ComposerUI::packageLinks',array('key'=>'require-dev','desc'=>'Development Requires'))
@endif
@if(isset($jsonComposer['conflict']))
	@include('ComposerUI::packageLinks',array('key'=>'conflict','desc'=>'Conflicts With'))
@endif
@if(isset($jsonComposer['replace']))
	@include('ComposerUI::packageLinks',array('key'=>'replace','desc'=>'Replaces'))
@endif
@if(isset($jsonComposer['provide']))
	@include('ComposerUI::packageLinks',array('key'=>'provide','desc'=>'Provides'))
@endif
@if(isset($jsonComposer['suggest']))
	<div class='col-md-6'>
		<h3>Suggested Packages</h3>
		@foreach($jsonComposer['suggest'] as $package => $desc)
		<p>
		<code>{{{$package}}}</code> : {{{$desc}}}
		</p>
		@endforeach
	</div>
@endif
</div>
