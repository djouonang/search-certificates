<?php

function noiaa_form() {

		 // search form
    $url = "https://training.noiaa.com/search-certificates/";
	
	
	?>
	

<!------ Include the above in your HEAD tag ---------->

<section class="bg-light ">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                
                <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-brand" role="tabpanel" aria-labelledby="nav-brand-tab">
                      <div class="row py-5 my-4">
                    <div class="col-md-12">
                        <div class="card-body">
                                <div class="row pb-2">
                    <div class="col-md-12">
                        <h4 style="color:white">Verify Certificates</h4>
                    </div>
                </div>
            	<div class="row ">
            		<div class="col-md-3">
                       <div class="form-group">
					   <form role="search" method="get"  action="<?php echo $url; ?>">
					   <input type="text" value=""  class="form-control" placeholder="<?php _e( 'Name of Trainee', 'textdomain' ); ?>" name="trainee_title" />
                       </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                         <input type="text" value=""  class="form-control" placeholder="<?php _e( 'Certificate Number', 'textdomain' ); ?>" name="cert_title" />
                        </div>
                    </div>
                    <div class="col-md-3">
        	           
					   <input type="submit" name="submit" class="btn btn-primary btn-block"  value="Verify" />
        	        </div>
					 </form>
            	</div>
                            </div>
                    </div>
                </div>
                  </div>
             
                </div>
            </div>
        </div>
    </div>
</section>
<div class="my-3"></div>

<br />
<br />

<?php 


 $query = $_GET['trainee_title'];
 $query1 = $_GET['cert_title'];

 if(isset($_REQUEST['submit']) ){
	 
    // you can set minimum length of the query if you want
    
         
        $query = htmlspecialchars($query);
		$query1 = htmlspecialchars($query1);
        // changes characters used in html to their equivalents, for example: < to &gt;
         global $wpdb;
		 $table_name = $wpdb->prefix . 'certificat';   
		 $customPagHTML     = "";
         $queri             = "SELECT * FROM $table_name WHERE nom LIKE '%{$query}%' OR numero LIKE '{$query1}'";
         $total_query     = "SELECT COUNT(1) FROM (${queri}) AS combined_table";
         $total             = $wpdb->get_var( $total_query );
         $items_per_page = 10;
         $page             = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
         $offset         = ( $page * $items_per_page ) - $items_per_page;
         $result         = $wpdb->get_results( $queri."  LIMIT ${offset}, ${items_per_page}" );
         $totalPage         = ceil($total / $items_per_page);
		
	//  print_r($result);
	  if(!empty($result)){
		  ?>
		  <hgroup class="mb20">
		<h1>Database of Certified Trainees</h1>		
		</hr>
<?php

if($totalPage > 1){
$customPagHTML     =  '<div><span>Page '.$page.' of '.$totalPage.'</span>'.paginate_links( array(
'base' => add_query_arg( 'cpage', '%#%' ),
'format' => '',
'prev_text' => __('&laquo;'),
'next_text' => __('&raquo;'),
'total' => $totalPage,
'current' => $page
)).'</div>';
}

	  foreach($result as $new){
		   global $wpdb;
		  $getcompany = $new->idsociete;
		  $getcourse = $new->idformation;
		  $table_name1 = $wpdb->prefix . 'societe';
		  $table_name2 = $wpdb->prefix . 'formation';
		  $result1 = $wpdb->get_row("SELECT * FROM $table_name1 WHERE idsociete = '{$getcompany}' ");
		  $result2 = $wpdb->get_row("SELECT * FROM $table_name2 WHERE idformation = '{$getcourse}' ");
		  	?>
<section class="pt-2">
    <div class="container">
	
	<div class="row mb-3">
	    <div class="col-md-16">
	        <div class="card">
	            <div class="card-body">
	                <div class="row ">
                	    <div class="col-md-3">
                	        <img src="https://training.noiaa.com/wp-content/uploads/2018/11/NOIAA-Institute-Final-01.png" alt="">
                	    </div>
                	    <div class="col-md-3">
                	        <h5>Name of Trainee</h5>
                	        <a href="#"><?php echo $new->nom; ?></a>
                	        <ul class="list-unstyled list-inline">
                	            <li class="list-inline-item"><strong>Company:</strong></li>
                	            <li class="list-inline-item"><?php echo $result1->titre; ?></li>
                	            
                	        </ul>
                	    </div>
                	    <div class="col-md-3">
                	        <h5>Training Course</h5>
							 <a href="#"><?php echo $result2->titre; ?></a>
							 <ul class="list-unstyled list-inline">
                	            <li class="list-inline-item"><strong>Certificate ID:</strong></li>
                	           <li class="list-inline-item"><small><?php echo $new->numero; ?></small></li>
                	         
                	        </ul>
                	        
                	    </div>
						<div class="col-md-3">
                	        <h5>Issue/Expiration Date</h5>
                	         <div class="sub-row">
                	            <button type="button" class="btn btn-secondary btn-sm btn-block">Issued On: <?php echo $new->date_formation; ?></button>
                	        </div>
							</br>
							<div class="sub-row">
                	            <button type="button" class="btn btn-danger btn-sm btn-block">Expires On: <?php echo $new->date_expiration; ?></button>
                	        </div>
                	    </div>
                	</div>
	            </div>
	        </div>
	        
        	
	    </div>
	</div>	
	
</div>
</section>


	
	</hgroup>
		   

	
   <?php 

 }
      echo $customPagHTML;   // This includes pagination at bottom of the search results
}else{
	
	echo "No results found";
	  }
	
}
 
	}
	
	function esearch_shortcode() {
    ob_start();

    noiaa_form();
	

    return ob_get_clean();
}

add_shortcode( 'noiaa_form', 'esearch_shortcode' );

?>