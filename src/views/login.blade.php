<!DOCTYPE html>
<html lang="en">
    <head>
        <title>ComposerUI - Web UI for Composer</title>
        <meta name="application-name" content="ComposerUI">
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    </head>
    <body>
        <div class='container container-fluid'>
            <h1>
                <code>ComposerUI</code> 
                <small>A Web UI for <code>composer</code></small>
            </h1>
            <hr />
            <div class='row'>
                <div class='col-md-6 col-md-offset-3'>
                    <form method='POST' class='form-inline'>
                        <legend>Login</legend>
                        @if(isset($loginError))
                        <div class="alert alert-danger" >Invalid Credentials</div>
                        @endif
                        <input class='form-control' type='text' name='username' placeholder='Username' />
                        <input class='form-control' type='password' name='password' placeholder='Password' />
                        <button type="submit" class="btn btn-success">Login</button>
                        {{Form::token()}}
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
