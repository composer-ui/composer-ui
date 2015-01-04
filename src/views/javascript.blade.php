<script type="text/javascript">
$(document).ready(function(){
	$(".actionButtons > button").tooltip({placement:"top",html:true});
	$(".package-input , .dev-package-input").each(function(index,item){
		$(item).children().attr('onclick','newPackageField(this)');
	});
	$("#remove-form input[name=dev]").change(removeDevHandler);
	removeDevHandler();
});
function removeDevHandler()
{
	var dev = $("#remove-form input[name=dev]:checked").val();
	if(dev == 1)
	{
		$("#remove-form select[name=packages]").attr('disabled','disabled');
		$("#remove-form select[name=dev-packages]").removeAttr('disabled');
	}
	else
	{
		$("#remove-form select[name=dev-packages]").attr('disabled','disabled');
		$("#remove-form select[name=packages]").removeAttr('disabled');
	}
}
function packageName(name,version)
{
	return name+':'+version;
}
function newPackageField(that)
{
	html = $(that).parent().clone();
	$(that).parent().after(html);
	$(that).parent().after("<br/>");
	$(that).removeAttr('onclick');
	$(that).siblings().removeAttr('onclick');
}
function url(path)
{
	return "{{url('composer')}}/"+path;
}
function startListening()
{
	time = new Date().getTime();
	window.ComposerUI = {
		listener:setInterval(fetchOutput,3000),
		actionID:time
	};
}
function fetchOutput()
{
	action = $(".modal:visible").attr('id');
	$.get(url("output"),
		{actionID:window.ComposerUI.actionID},
		function(data){
		if(data.status == 'complete')
		{
			$("#"+action+"-output").html(data.output);
			stopListening();
		}
		else if (data.status == 'working')
			$("#"+action+"-output").html(data.output);
	});
}
function stopListening()
{
	clearInterval(window.ComposerUI.listener);
	window.ComposerUI = null;
	$(".modal:visible button").removeClass('disabled');
}
function formProcess(form)
{
	fields = {"packages":[],"devPackages":[]};
	if($(form).attr('id')  ==  'update-form' || $(form).attr('id') == 'remove-form')
	{
		var packages = $(form).find("[name=packages]").val();
		if(packages != '' && packages != undefined)
			fields.packages = packages;
	}
	else if($(form).attr('id') == 'create-project-form')
	{
		fields["package"] = packageName($(form).find("[name=package]").val(),$(form).find("[name=version]").val())
	}
	else
	{
		packages = $(form).find('.package-input');
		if(packages.length)
		{
			packages.each(function(index,item){
				if(item !== undefined && item !== '')
				{
					var _package = $(item).find('[name=package]').val();
					var version = $(item).find('[name=version]').val();
					if(_package != "" && _package != undefined &&  version != undefined && version != "")
					{
						fields.packages.push(packageName(_package,version));
					}
				}	
			});
		}
		devPackages = $(form).find('.dev-package-input');
		if(devPackages.length)
		{
			devPackages.each(function(index,item){
				if(item !== undefined && item !== '')
				{
					var _package = $(item).find('[name=package]').val();
					var version = $(item).find('[name=version]').val();
					if(_package != "" && _package != undefined &&  version != undefined && version != "")
					{
						fields.devPackages.push(packageName(_package,version));
					}
				}	
			});
		}
	}
	serialized = $(form).serializeArray();
	for(i = 0; i < serialized.length; i++)
	{
		item = serialized[i];
		if(item.name == 'packages' || item.name == 'package' || item.name == 'version')
			continue;
		else if(item.value !== null && item.value !== "")
			fields[item.name] = item.value;
	}
	if(fields.packages.length == 0)
		delete fields['packages'];
	if(fields.devPackages.length == 0)
		delete fields['devPackages'];
	if($(form).attr('id') == "init-form")
	{
		fields["require"] = fields["packages"];
		delete fields['packages'];
		fields["require-dev"] = fields['devPackages'];
		delete fields['devPackages'];
	}
	return fields;
}
function performAction()
{
	action = $(".modal:visible").attr('id');
	startListening();
	fields = {
			'action' : action,
			'actionID': window.ComposerUI.actionID,
			'fields' : formProcess($("#"+action+"-form"))
			};	
	$(".modal:visible button").addClass('disabled');
	$.post(url('action'),fields);
	/*
	var xhr = new XMLHttpRequest();
	xhr.open("POST",url("action"));
	xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
	xhr.onreadystatechange = function()
	{
		if(xhr.readyState > 2)
			xhr.abort();
	}
	xhr.send(JSON.stringify(fields));
	*/
}
</script>