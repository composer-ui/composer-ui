<?php namespace ComposerUI\ComposerUI\Tests;

use Orchestra\Testbench\TestCase;

class ComposerUIServiceProviderTest extends TestCase
{
   protected function getPackageProviders()
   {
        return array('ComposerUI\ComposerUI\ComposerUIServiceProvider');
   }
   protected function loginTestSetUp()
   {
       $this->app['config']->set('ComposerUI::auth',array(
           'username'=>'testuser',
           'password'=>'testpass'
       ));
       $this->app['router']->enableFilters();
   }
   public function testUnauthorizedAjaxRequest()
   {
       $this->app['router']->enableFilters();
       $this->call('GET', 'composer',array(),array(),array('HTTP_X-Requested-With' => 'XMLHttpRequest'));
       
       $this->assertResponseStatus(401);
   }
   public function testLoginRedirect()
   {
       $this->app['router']->enableFilters();
       $this->call('GET', 'composer');
       
       $this->assertRedirectedTo('composer/login');
   }
   /**
    * @expectedException \Illuminate\Session\TokenMismatchException
    */
   public function testNoTokenLogin()
   {
       $this->loginTestSetUp();
       $this->call('GET', '/composer/login');
       
       $this->assertResponseOk();
       
       $this->call('POST','/composer/login',array(
           'username'=>'testuser',
           'password'=>'testpass',
           '_token' => 'fdgf'
           ));
       
       $this->assertFalse($this->app['session']->has('ComposerUIAuth'));
   }
   public function testInvalidCredentialLogin()
   {
       $this->loginTestSetUp();
       $crawler = $this->client->request('GET', '/composer/login');
       
       $this->assertResponseOk();
       
       $this->call('POST','/composer/login',array(
           'username'=>'wrong',
           'password'=>'wrong',
           '_token' => $crawler->filter("input[name='_token']")->attr('value')
           ));
       
       $this->assertFalse($this->app['session']->has('ComposerUIAuth'));
   }
   public function testPerfectLogin()
   {
       $this->loginTestSetUp();
       $this->app['router']->enableFilters();
       $crawler = $this->client->request('GET', '/composer/login');
       
       $this->assertResponseOk();
       
       $this->call('POST','/composer/login',array(
           'username'=>'testuser',
           'password'=>'testpass',
           '_token' => $crawler->filter("input[name='_token']")->attr('value')
           ));
       
       $this->assertSessionHas('ComposerUIAuth');
       $this->assertRedirectedTo('composer');
   }
}

?>
