<?php

if ( isset( $_POST["submitform"] ) && $_POST["training_name"] != "" ) {
	
	global $wpdb;
	$name = trim($_POST['training_name']);
	
	$table_name1 = $wpdb->prefix . 'formation';
    $wpdb->insert( $table_name1, array(
    'titre' => $name
) );
 
	}

?>

<div class="container">  
<form id="contact" action="<?php $_SERVER['REQUEST_URI'] ?>" method="post">
    <h3 aligne ="center">Add Training Course to Database</h3>
	<?php if ( isset( $_POST["submitform"] ) && $_POST["training_name"] != "" ) { echo "The information was successfully registered..."; } ?>
    <fieldset>
      <input placeholder="Name of Training" type="text" name="training_name" tabindex="1" required autofocus>
    </fieldset>
    <fieldset>
      <button name="submitform" type="submit" id="submit-contactt" data-submit="...Sending">Submit</button>
    </fieldset>
    
  </form>';
</div>

<?php

?>