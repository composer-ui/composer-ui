<?php
namespace Illuminate\Support\Facades;

Route::filter('ComposerUIAuth',function(){
    if(!Session::has('ComposerUIAuth'))
    {
        if(Request::ajax())
        {
            return Response::make('Unauthorized',401);
        }
        else
        {
            return Redirect::to('composer/login');
        }
    }
});


Route::filter('ComposerUINoAuth',function(){
    if(Session::has('ComposerUIAuth'))
    {
        if(Request::ajax())
        {
            return Response::make('Unauthorized',401);
        }
        else
        {
            return Redirect::to('composer');
        }
    }
});

Route::filter('csrf', function()
{
	if (Session::token() !== Input::get('_token'))
	{
		throw new \Illuminate\Session\TokenMismatchException;
	}
});