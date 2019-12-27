<?php
if ( isset( $_POST["form_submit"] ) ) {
	
	global $wpdb;
	$name = trim($_POST['delegate_name']);
	$certificateid = trim($_POST['certificate_id']);
	$trainingcourse = trim($_POST['training_course']);
	$company = trim($_POST['company']);
	$issuedate = $_POST['issuedate'];
	$expirationdate = $_POST['expirationdate'];
	
	$table_name = $wpdb->prefix . 'certificat';
    $wpdb->insert( $table_name, array(
    'nom' => $name,
    'numero' => $certificateid,
	'idformation' => $trainingcourse,
	'idsociete' => $company,
	'date_formation' => $issuedate,
	'date_expiration' => $expirationdate
) );
	}
	

?>

<div class="container">  
  <form id="contact" action="<?php $_SERVER['REQUEST_URI'] ?>" method="post">
    <h3 aligne ="center">Add Certificates to Database</h3>
   <?php if ( isset( $_POST["form_submit"] ) ) { echo "The information was successfully registered..."; } ?>
    <fieldset>
      <input placeholder="Name of Delegate" type="text" name="delegate_name" tabindex="1" required autofocus>
    </fieldset>
    <fieldset>
      <input placeholder="Certificate ID" type="text" name="certificate_id" tabindex="2" required>
    </fieldset>
    <fieldset>
	<select  name="training_course" tabindex="1" required>
	<option disabled selected value="">Please select Course</option>
	<?php
	
	global $wpdb;
	$results = $wpdb->get_results("SELECT titre, idformation FROM wp_formation");
    foreach ($results as $value) {
            echo '<option value="' .$value->idformation . '">' .$value->titre. '</option>';
    }
    ?>
    </select>
    </fieldset>
    <fieldset>
	<select  name="company"  tabindex="1" required>
	<option disabled selected value="">Please select Company</option>
	<?php
	
	global $wpdb;
	$results = $wpdb->get_results("SELECT titre, idsociete FROM wp_societe");
    foreach ($results as $value) {
            echo '<option value="' .$value->idsociete . '">' .$value->titre. '</option>';
    }
    ?>
    </select>
    
    </fieldset>
     <fieldset>
      <input placeholder="Date of Issue" type="text" name="issuedate" tabindex="4" required>
    </fieldset>
	 <fieldset>
      <input placeholder="Date of Expiration" type="text" name="expirationdate" tabindex="4" required>
    </fieldset>
    <fieldset>
      <button name="form_submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
    </fieldset>
    
  </form>
</div>