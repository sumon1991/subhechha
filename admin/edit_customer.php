<?php 
// FOLOWING CODE IS FOR FETCHING THE RECORD
if(!empty($_REQUEST['id']))
    $id = $_REQUEST['id'];
else
    $id = ''; 
 
//NOTIFICATION MESSAGE GENERATION ....
if(!empty($_SESSION['success']))
{
	$success_msg = $_SESSION['success'];
    unset($_SESSION['success']);
}	
else
{
	$success_msg = '';
}

if(isset($_SESSION['error']))
{
	$error_message = $_SESSION['error'];
	unset($_SESSION['error']);
}
else
{
	$error_message = '';
}

//FETCH THE CUSTOMER DATA FOR EDITING
$select_cust  = "SELECT * FROM ".CUSTOMER." WHERE id = '".$id."'";
$query_select = mysql_query($select_cust);
$select_fetch = mysql_fetch_assoc($query_select); 

//FOLLOWING CODE WILL ADD THE CUSTOMER INFORMATION
if(isset($_POST['submit']))
{
	$customer_id      = $_POST['customer_id'];
	$customer_name    = $_POST['customer_name'];
	$customer_phone   = $_POST['customer_phone'];
	$customer_email   = $_POST['customer_email'];
	$customer_address = $_POST['customer_address'];
	$status           = $_POST['status'];
	
	$sql_cust = "UPDATE ".CUSTOMER." 
	             SET
				         customer_name           = '".$customer_name."',  
						 customer_phone          = '".$customer_phone."',
						 customer_email          = '".$customer_email."',
						 customer_address        = '".$customer_address."',
						 status                  = '".$status."'
	             WHERE 
				         id                      = '".$customer_id."' 
				     					 
				 ";	 
	 $sql_insert = mysql_query($sql_cust);
	 if($sql_insert > 0){
		  $_SESSION['success'] = "Customer has been Update successfully";
        echo '<script>window.location="'.SITE_URL.'/?page=customer_list"</script>';
		}else{
			$_SESSION['error'] = "Customer has been Already Added or Not Properly added..";
        echo '<script>window.location="'.SITE_URL.'/?page=customer_list"</script>';
	 }	
}


// Following code is for Status fetching
$status_list_sql = "SELECT * 
					 FROM ".STATUS." 
					 WHERE 1";

$status_list_query = mysql_query($status_list_sql);
$status_list_num	= mysql_num_rows($status_list_query);

include('includes/header_after_login.php');

?>




    
      <!-- page content -->
      <div class="right_col" role="main">
        Customer Edit
        <!-- top tiles -->
        <div class="row tile_count">
          
           <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2> Customer Edit<small>For Customer Edit</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                  
                    </li>
                    <li class="dropdown">
                       <script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>
                        <script src="js/ajjquery.min"></script> 
                         <script type="text/javascript">
            $(document).ready(function() {
              $('#birthday').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_4"
              }, function(start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
              });
            });
          </script>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                   
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                
                </div>
                  <?php if(!empty($error_message)) { ?>
									<!-- BEGIN ERROR BOX -->
									<div class="alert alert-danger fade in" id="error">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<?php echo $error_message; ?>
									</div>
									<!-- END ERROR BOX -->	
									<?php } if(!empty($success_msg)) { ?>	
									<!-- BEGIN OF SUCCESS BOX -->
                                    <div class="alert alert-success fade in">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <strong>Well done!</strong> <?php echo $success_msg; ?>.
                                    </div>									
									<!-- END OF SUCCESS BOX -->
									<?php } ?>
                <div class="x_content">
                  <br />
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">

                   <input type="hidden" id="customer_id" placeholder="Customer Name" name="customer_id"  class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" value="<?php echo $id;?>" required />
                    <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Name</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="text" id="customer_name" placeholder="Customer Name" name="customer_name"  class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" value="<?php echo $select_fetch['customer_name'];?>" required />
                      </div>
                    </div>
                   
                    
                     <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Phone Number</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="text" id="customer_phone" placeholder="Customer Phone Number" name="customer_phone" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" value="<?php echo $select_fetch['customer_phone'];?>" required />
                      </div>
                    </div>
                    
                      <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email-ID</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="email" id="customer_email" placeholder="Customer Email" name="customer_email" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" value="<?php echo $select_fetch['customer_email'];?>" required />
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Customer Address</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <textarea  name="customer_address" id="customer_address" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12 col-md-7 col-xs-12" placeholder="Address" required><?php echo $select_fetch['customer_address'];?></textarea>
                      </div>
                    </div>
                    
                  
                     
                    
                  
                    <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="status" data-style="input-sm btn-default" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12">
											<?php
												if($status_list_num > 0) {
													while($status_list_array = mysql_fetch_assoc($status_list_query)) 
													{
											?>
			<option value="<?php echo $status_list_array['sts_id']; ?>" <?php if(!empty($select_fetch['status']) && $select_fetch['status'] == $status_list_array['sts_id']) { echo "selected"; } ?>><?php echo $status_list_array['sts_name']; ?></option>
											<?php	
													}
												}
												else {
											?>
												<option value="">No Status Available</option>
											<?php } ?>
											</select>
                      </div>
                    </div>
                    
                  
                   
                   
                    <div class="ln_solid"></div>
                    <div class="form-group">

                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                           
                        <button type="submit" class="btn btn-success" name="submit">Submit</button>
                        <button type="reset" class="btn btn-primary">Cancel</button>
                        
                      </div>
                    </div>

                  </form>
                </div>
              </div>
            </div>

        </div>
        <!-- /top tiles -->

        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">

              <div class="row x_title">
                
                
              </div>

             
              <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
                

                <div class="col-md-12 col-sm-12 col-xs-6">
                 
                  
                </div>
                
                  

              </div>

              <div class="clearfix"></div>
            </div>
          </div>

        </div>
        <br />

        <div class="row">


         

        <div class="row">
          
          </div>


          <div class="col-md-8 col-sm-8 col-xs-12">



            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                
              </div>

            </div>
            <div class="row">


             
              
              <!-- start of weather widget -->
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  

                </div>
              </div>

            </div>
              <!-- end of weather widget -->
          </div>
        </div>
      </div>
    </div>
      <!-- /page content -->

     

 <?php include('includes/footer_after_login.php'); ?>
