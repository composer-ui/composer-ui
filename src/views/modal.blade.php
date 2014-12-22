<div id="{{{$action}}}" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
	    <button class="close" type="button" data-dismiss="modal"><i class="fa fa-remove"></i></button>
	    <h4 class="modal-title">{{{ucwords(implode(explode('-',$action),' '))}}}</h4>
    </div>
    <div class="modal-body">
    @include('ComposerUI::modals.'.$action)
    </div>
    <div class="modal-footer">
    <button data-dismiss="modal" class="btn"><i class="fa fa-remove"></i> Cancel</button>
    <button class="btn btn-primary" onclick="performAction()"><i class="fa fa-terminal"></i> Go</button>
    </div>
    <div class="modal-footer">
	    <pre id="{{{$action}}}-output" class="output">Output will appear here.<br/>
	    </pre>
    </div>
</div>
</div>
</div>