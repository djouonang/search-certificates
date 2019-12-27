<?php
if ( isset( $_POST["submit_form"] ) ) {
	
	global $wpdb;
	$name = trim($_POST['company_name']);
	
	
	$table_name2 = $wpdb->prefix . 'societe';
    $wpdb->insert( $table_name2, array(
    'titre' => $name
) );
	}

?>

<div class="container">  
  <form id="contact" action="<?php $_SERVER['REQUEST_URI'] ?>" method="post">
    <h3 aligne ="center">Add Company name to Database</h3>
   <?php if ( isset( $_POST["submit_form"] ) && $_POST["company_name"] != "" ) { echo "The information was successfully registered..."; } ?>
    <fieldset>
      <input placeholder="Name of Company" type="text" name="company_name" tabindex="1" required autofocus>
    </fieldset>
    <fieldset>
      <button name="submit_form" type="submit" id="submit-contact" data-submit="...Sending">Submit</button>
    </fieldset>
    
  </form>
</div>