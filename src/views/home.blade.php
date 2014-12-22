<!DOCTYPE html>
<html lang="en">
    <head>
        <title>ComposerUI - Web UI for Composer</title>
        <meta name="application-name" content="ComposerUI">
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        <script src='https://code.jquery.com/jquery-2.1.1.min.js'></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        @include('ComposerUI::javascript')
        @include('ComposerUI::css')
    </head>
    <body>
    <div class='container container-fluid'>
            <h1>
                <code>ComposerUI</code> 
                <small>A Web UI for <code>composer</code></small>
            </h1>
            <hr />
            <div class='row'>
                <div class="col-md-7">
                    <form id='directoryForm' method='GET'>
                        <label for="directory">Project Directory</label>
                        <input type="text" name='workingDir' class="form-control" value="{{$workingDir}}"/>
                    </form>
                </div>
                <div class='col-md-5'>
                    <label>Options</label><br />
                    <button class='btn btn-success' onclick='$("#directoryForm").submit()'>Load</button>
                    <button class='btn btn-warning' onclick='window.location = "{{url('composer')}}"'>Reset</button>
                </div>
            </div>
            <hr />
            <div class="actionButtons">
                <button data-toggle="modal" data-target="#install" class='btn btn-success' title="Install project dependencies<br/><code>composer install</code>">
                    <i class="fa fa-fw fa-anchor"></i> Install
                </button>
                <button data-toggle="modal" data-target="#update" class='btn btn-info' title="Update project dependencies<br/><code>composer update</code>">
                    <i class="fa fa-fw fa-bolt"></i> Update
                </button>
                <button data-toggle="modal" data-target="#require" class='btn btn-info' title="Add new project dependencies<br/><code>composer require</code>">
                    <i class="fa fa-fw fa-plus"></i> Require
                </button>
                <button data-toggle="modal" data-target="#remove" class='btn btn-danger' title="Remove project dependencies<br/><code>composer remove</code>">
                    <i class="fa fa-fw fa-minus"></i> Remove
                </button>
                <button data-toggle="modal" data-target="#validate" class='btn btn-warning' title="Validate the manifest file<br/><code>composer validate</code>">
                    <i class="fa fa-fw fa-eye"></i> Validate
                </button>
                <button data-toggle="modal" data-target="#dump-autoload" class='btn btn-primary' title="Dump autoload files<br/><code>composer dump-autoload</code>">
                    <i class="fa fa-fw fa-rocket"></i> Dump Autoload
                </button>
                <button data-toggle="modal" data-target="#create-project" class='btn btn-success' title="Create new project from existing package<br/><code>composer create-project</code>">
                    <i class="fa fa-fw fa-code-fork"></i> Create Project
                </button>
                <button data-toggle="modal" data-target="#init" class='btn btn-success' title="Create new blank project<br/><code>composer init</code>">
                    <i class="fa fa-fw fa-terminal"></i> Initialize New Project
                </button>
            </div>
            <hr />
            @if(!file_exists($workingDir))
                <h2>Oops! The directory seems to not exist. Please try again.</h2>
            @elseif(!file_exists($workingDir.'/composer.json'))
                <h2>Oops! Couldn't find the <code>composer.json</code> file.</h2>
            @else
            <div class='row'>
                <div class='col-md-12'>
                    @include('ComposerUI::details')
                </div>
            </div>
            <?php 
            $actions = array('install','update','require','remove','validate','dump-autoload','create-project','init');
            ?>
            @foreach($actions as $action)
                @include('ComposerUI::modal',array('action'=>$action))
            @endforeach
            @endif
        </div>
    </body>
</html>
