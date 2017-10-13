<?php

require '../src/AdvancedWebform.php';
require '../src/CSRF.php';
require '../src/Error.php';
require '../src/CSRFError.php';
require '../src/ElementError.php';
require '../PodioConnect.php';
include 'elements.php';

$podio_connection = new PodioConnect(19412331);
// Make sure errors are output to the screen in development environment
ini_set('display_errors', '1');
error_reporting(E_ALL | E_STRICT);
$podioform = new \AdvancedWebform\AdvancedWebform(array(
	'app_id' => 19412331,
	'lock_default' => true,
	'method' => 'post',
	'action' => '',
	'submit_value' => 'Send',
	
));

require 'header.php';
// If you don't want to enable file upload
$podioform->get_element('files')->set_attribute('hidden', true);

if ($_POST){
	$item_id = $_POST['uu-center'];
	$field_id = 154492804;
	$uucenter = PodioItem::get_field_value($_POST['uu-center'],154492804); 		 
	
    try{
	  
	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			
            if ( $_POST['kategori']== 2){
		$_POST['uu-center'] = " ";
	  }
	     else if ($_POST['kategori'] == 1){			
		$_POST['organisation-2'] = $uucenter[0]['value'];
	      }
				
           $podioform->set_values($_POST,$_FILES);
	 $podioform->save();
	 $message_after = '<h4> Kære '.$_POST['navn'].'</h4>'.
		        'Tak for din tilmelding. <br/>'.
		        '<a class = "btn btn-primary btn-lg" href = "index.php"> Udfyld en ny tilmelding? </a>';
           $podioform = $message_after;
	 
	
	 }
        
	else {
     
          ?>
	<script>
	alert('Du skal indtaste en emailadresse');
	</script>
	<?php
		  
	}    
       
	}
    
    catch (\AdvancedWebform\ElementError $e){
          $error_message = 'There\'s an error with the element.';
    }
    catch (\AdvancedWebform\CSRFError $e){
          $error_message = 'There\'s an error with the submission. Please revisit the form and submit again.';
          $podioform = '';
    }
    
    catch(\Exception $e){
         $error_message = 'There\'s an unknown error with the submission. Please revisit the form and submit again.';
         $podioform = '';
    }
}
	require 'content.php';
?>
	<script>
	$('.btn').addClass('enableOnInput');
	$('.enableOnInput').prop('disabled', true);
          $('input[name=email]').on('input', function() {
	var input=$(this);
	
	var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
	var is_email=re.test(input.val());
	if(is_email){input.removeClass("invalid").addClass("valid");
	 $('.enableOnInput').prop('disabled', false);
	}
	else{input.removeClass("valid").addClass("invalid");
	 $('.enableOnInput').prop('disabled', true);
	
	}
	});
	
	displayErrorTextforEmailField();
	$("#154285327").hide();
	$("label[for='uu-center']").hide();
	
	$('input[name=organisation-2]').hide();
	$("label[for=organisation-2]").hide();
	// Tjek if the answer is yes og no
	$('input[name=kategori]').click(function(){
	var res = $('input[name=kategori]:checked').val();
	if(res == 1){
		  
	      $("#154285327").show();
		   $("#154285327").slideDown("slow");
	      $("label[for='uu-center']").show();
	      $("label[for = organisation-2]").hide();
	      $('input[name=organisation-2]').hide();
	      $('input[name=organisation-2]').val("tomt felt");
	}
	else{
	      $('input[name=organisation-2]').show();
	      $('label[for="organisation-2"]').show();
	      $("label[for= uu-center]").hide();
	      $("#154285327").hide();
				
			
	}
	});
	
	 
  


    
 </script>
<?php
require 'footer.php';