<?php namespace ComposerUI\ComposerUI;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Composer\Json\JsonFile;
use ComposerUI\Core as ComposerUI;
use Symfony\Component\Console\Output\StreamOutput;
use Composer\Console\HtmlOutputFormatter;

class ComposerUIController extends BaseController
{
    public function __construct()
    {
        $this->beforeFilter('ComposerUIAuth',array('except'=>array('getLogin','postLogin')));
        $this->beforeFilter('ComposerUINoAuth',array('only'=>array('getLogin','postLogin')));
        $this->beforeFilter('csrf',array('only'=>'postLogin'));
    }
    public function getIndex()
    {
        $defaults = Config::get('ComposerUI::defaults');
        $workingDir = Input::get('workingDir',$defaults['workingDir']);
        $realpath = realpath($workingDir);
        if($realpath != $workingDir && $realpath != false)
            return Redirect::to('composer?workingDir='.urlencode($realpath));
        else
        {
            $jsonComposer = null;
            if(file_exists($workingDir.DIRECTORY_SEPARATOR.'composer.json'))
            {
                try
                {
                    $jsonComposer = JsonFile::parseJson(file_get_contents($workingDir.DIRECTORY_SEPARATOR.'composer.json'));
                }
                catch(Exception $e)
                {
                    $jsonComposer = null;
                }
            }
            Session::put("ComposerUI.workingDir",$workingDir);
            return View::make('ComposerUI::home')->with(array(
                'workingDir'=>$workingDir,
                'jsonComposer' => $jsonComposer
                    ));
        }
    }
    public function postAction()
    {
        if(!Input::has('action') || !Input::has('fields') || !Input::has('actionID'))
            return Response::make('Improper Request',401);
        $action = Input::get('action');
        $fields = Input::get('fields');
        foreach ($fields as $key => $value) 
        {
            switch($key)
            {
                case 'prefer':
                    $fields['prefer-'.$value] = null;
                    unset($fields[$key]);
                    break;
                case 'packages':
                    $count = count($value);
                    $packages = null;
                    if($count == 1 && !in_array($action,array('require','remove')))
                    {
                        foreach ($value as $package) 
                        {
                            $fields['package'] = $package;
                        }
                    }
                    elseif($count)
                    {
                        foreach ($value as $package) 
                        {
                            $packages[] = $package;
                        }
                    }
                    $fields['packages'] = $packages;
                    break;
                case 'devPackages':
                    $count = count($value);
                    $packages = null;
                    if($count)
                    {
                        foreach ($value as $package => $version) 
                        {
                            $packages[] = $package.':'.$version;
                        }
                    }
                    unset($fields['devPackages']);
                    $fields['packages'] = $packages;
                    break;
            }
        }
        $logDirectory = storage_path().'/logs/ComposerUI';
        if(!File::exists($logDirectory))
            File::makeDirectory($logDirectory);
        else if(!File::isDirectory($logDirectory))
        {
            File::delete($logDirectory);
            File::makeDirectory($logDirectory);
        }
        $outputFile = $logDirectory.'/'.Input::get('actionID').'-output';
        $output = new StreamOutput(fopen($outputFile,'w'),StreamOutput::VERBOSITY_NORMAL,false, new HtmlOutputFormatter());
        $composer = new ComposerUI(Session::get("ComposerUI.workingDir"),$output);
        File::put($logDirectory.'/'.Input::get('actionID').'-status','working');
        $response = Response::json($composer->run($action,$fields));
        File::put($logDirectory.'/'.Input::get('actionID').'-status','complete');
        return $response;
    }
    public function getOutput()
    {
        if(!Input::has('actionID'))
            return Response::make('Improper Request',401);
        $outputFile = storage_path().'/logs/ComposerUI/'.Input::get('actionID').'-output';
        $statusFile = storage_path().'/logs/ComposerUI/'.Input::get('actionID').'-status';
        if(File::exists($statusFile))
            return Response::json(['status'=>File::get($statusFile),'output'=>File::get($outputFile)]);
        else 
            return Response::json(['status'=>'notStarted']);
    }
    public function getLogin()
    {
        return View::make('ComposerUI::login');
    }
    public function postLogin()
    {
        $auth = Config::get('ComposerUI::auth');
        if((!is_null($auth['username']) && Input::get('username') === $auth['username']) && (!is_null($auth['password']) && Input::get('password') === $auth['password']))
        {
            Session::put('ComposerUIAuth',true);
            return Redirect::to('composer');
        }
        else 
        {
            return View::make('ComposerUI::login')->with('loginError',true);
        }
    }
}

?>
