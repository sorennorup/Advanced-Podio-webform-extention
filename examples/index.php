<?php


require '../src/AdvancedWebform.php';
require '../src/CSRF.php';
require '../src/Error.php';
require '../src/CSRFError.php';
require '../src/ElementError.php';
require '../PodioConnect.php';
include 'elements.php';

/*if(!session_id()) {
    session_start();
}

Podio::setup(CLIENT_ID, CLIENT_SECRET);
Podio::$debug = true;

// Just for testing, you don't really want to reset the auth_token everytime.
Podio::$oauth = new PodioOAuth();

if (!Podio::is_authenticated()) {
  Podio::authenticate('password', array('username' => USERNAME, 'password' => PASSWORD));
}
*/
$podio_connection = new PodioConnect(7105812);
// Make sure errors are output to the screen in development environment
ini_set('display_errors', '1');
error_reporting(E_ALL | E_STRICT);
$podioform = new \AdvancedWebform\AdvancedWebform(array(
	'app_id' => 7105812,
	'lock_default' => true,
	'method' => 'post',
	'action' => '',
	'submit_value' => 'Send',
));

// If you don't want to enable file upload
$podioform->get_element('files')->set_attribute('hidden', true);

if ($_POST){
    try{
		   // test if emailfield is an email
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  
           $podioform->set_values($_POST,$_FILES);
	       $podioform->save();
           $podioform = 'Kære '.$_POST['navn'].' Tak for din tilmelding';

   }
        else {
     
          ?><script>alert('Du skal indtaste en emailadresse')</script><?php 
}
		
    } catch (\AdvancedWebform\ElementError $e){
        $error_message = 'There\'s an error with the element.';
    } catch (\AdvancedWebform\CSRFError $e){
		
        $error_message = 'There\'s an error with the submission. Please revisit the form and submit again.';
        $podioform = '';
    } catch(\Exception $e){
        $error_message = 'There\'s an unknown error with the submission. Please revisit the form and submit again.';
        $podioform = '';
    }
}
		require 'header.php';
		require 'content.php';
		require 'footer.php';