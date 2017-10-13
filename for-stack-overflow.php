if ($_POST){
	// all the values are stored in $_POST array
    
    
	
    try{
	    ?>  <script>  </script>   <?php
           // This only returns an integer. I want the value from the referenced category field.  
           $value_from_selected_list = $_POST['uu center'];
           // This should copy the value from the selected list to the other textfield. 
           $_POST['organisation'] = $value_from_selected_list; 
			// set all the values in the Podio app	
           $podioform->set_values($_POST,$_FILES);
	       $podioform->save();
           $podioform = 'Kære '.$_POST['navn'].' Tak for din tilmelding';
		  
   }
   catch($e){
           echo $e;
    
   }