<?php
ob_start();
error_reporting(0);
include('includes/function.php');
require_once("dompdf/dompdf_config.inc.php");

//user name 												 
$sql_user = "SELECT company_name,company_address,contact_person, email,phone FROM ".COMPANY_MASTER." WHERE company_type = '1'";
$query_user = mysql_query($sql_user);
$sql_fetch_user = mysql_fetch_assoc($query_user);
  

// FOLOWING CODE IS FOR FETCHING THE RECORD
if(!empty($_REQUEST['oid']))
    $order_id = $_REQUEST['oid'];
else
    $order_id = '';


$user_id = $_SESSION['login_id'];

//CODE TO GET COUSTOMER ORDER DETAILS ...
$cust_sql = "SELECT * FROM ".CUSTOMER_ORDER." WHERE order_id = '".$order_id."'"; 
$cust_query = mysql_query($cust_sql); 
$cust_fetch = mysql_fetch_assoc($cust_query); 

//CODE TO GET COUSTOMER ITEM ORDER DETAILS ...
$cust_ite_sql = "SELECT * FROM ".ORDER_ITEM." WHERE order_id = '".$order_id."'"; 
$cust_ite_query = mysql_query($cust_ite_sql); 
$cust_ite_fetch = mysql_fetch_assoc($cust_ite_query);  

                      $custo_id = $cust_fetch['customer_id'];

                      $odcust_sql = "SELECT * FROM ".CUSTOMER." WHERE id = '".$custo_id."'";
					  $odcust_query = mysql_query($odcust_sql); 
                      $odcust_fetch = mysql_fetch_assoc($odcust_query);     

$sys_date = date("d-m-Y");

?>


	<link rel='stylesheet' type='text/css' href='css/style1.css' />
	<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery-latest.min.js"></script>


	<div id="page-wrap">
		
			<div>	
			<div style="margin-left: 10px; display: inline-block;  margin-top:2px;">
				<h1 align="center"><b><?php echo $sql_fetch_user['company_name'] ?></b></h1>
			</div>
            
              <div align="center">  
				<b><?php echo $sql_fetch_user['company_address'] ?></b>
              </div>
              <div align="center">  
				Contact Person :-<b><?php echo $sql_fetch_user['contact_person'] ?></b>
              </div>
               <div align="center">  
				Phone Number :-<b><?php echo $sql_fetch_user['phone'] ?></b> 
                Email ID :- <b><?php echo $sql_fetch_user['email'] ?></b>
              </div>
                  
                  <br />
                 
            
	    
	 
		
         <table width="100%" border="0">
           <tr>
                <td>Customer Name -: <u><b><?php echo $odcust_fetch['customer_name'] ?></b></u></td>
                <td>Mobile Number -: <u><b><?php echo $odcust_fetch['customer_phone'] ?></b></u></td>
                <td>Date -: <u><b><?php echo $sys_date; ?></b></u></td>
           </tr> 
            <tr >
                <td colspan="2">Address-: <u><b><?php echo $odcust_fetch['customer_address']; ?></b></u></td>
                <td>Invitation:- <u><b><?php echo $cust_fetch['invitaion_person']; ?></b></u></td>
              
           </tr> 
           <tr>
                <td>Working Address-: <u><b><?php echo $odcust_fetch['customer_address']; ?></b></u></td>
                <td>Date:- <u><b><?php echo $cust_fetch['date']; ?></b></u></td>
                <td>Time:- <u><b><?php echo $cust_fetch['time']; ?></b></u></td>
           </tr> 
                          
        </table> 
    <br />
     <table width="100%" border="2">
            <tr> 
                  <th width="30%"> MENU</th>
                  <th width="70%"> Amount Describtion</th>
            </tr>
            <tr>
                 <td>1.<b><?php echo $cust_ite_fetch['item_1'];?></b></td>
                 <td rowspan="16"><?php echo $cust_ite_fetch['extra'];?></td>
            </tr>
            <tr>     
                 <td>2.<b><?php echo $cust_ite_fetch['item_2'];?></b></td>
            </tr>
            <tr>     
                 <td>3.<b><?php echo $cust_ite_fetch['item_3'];?></b></td>
           </tr>
            <tr>      
                 <td>4.<b><?php echo $cust_ite_fetch['item_4'];?></b></td>
           </tr>
            <tr>     
                 <td>5.<b><?php echo $cust_ite_fetch['item_5'];?></b></td>
                </tr>
            <tr>
                 <td>6.<b><?php echo $cust_ite_fetch['item_6'];?></b></td>
                </tr>
            <tr>
                 <td>7.<b><?php echo $cust_ite_fetch['item_7'];?></b></td>
                
                </tr>
            <tr> 
                 <td>8.<b><?php echo $cust_ite_fetch['item_8'];?></b></td>
                </tr>
            <tr>
                 <td>9.<b><?php echo $cust_ite_fetch['item_9'];?></b></td>
                </tr>
            <tr>
                 <td>10.<b><?php echo $cust_ite_fetch['item_10'];?></b></td>
                </tr>
            <tr>
                 <td>11.<b><?php echo $cust_ite_fetch['item_11'];?></b></td>
                </tr>
            <tr>
                 <td>12.<b><?php echo $cust_ite_fetch['item_12'];?></b></td>
                </tr>
            <tr>
                 <td>13.<b><?php echo $cust_ite_fetch['item_13'];?></b></td>
                </tr>
            <tr>
                 <td>14.<b><?php echo $cust_ite_fetch['item_14'];?></b></td>
                </tr>
            <tr>
                 <td>15.<b><?php echo $cust_ite_fetch['item_15'];?></b></td>
                </tr>
            <tr>
                 <td>16.<b><?php echo $cust_ite_fetch['item_16'];?></b></td>
                </tr>               
            </tr>
      </table> 
      <table width="100%" border="2">
            
                   <tr style="padding-bottom:10px; padding-top:10px;"> 
                  <td rowspan="4">Signature:___________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Customer Signature:__________________ </td>
                  
                  
                  
            </tr>
                <tr> 
                </tr>
                <tr> 
                </tr>
                <tr> 
                  
                  </tr>         
      </table> 
      

     
    </div>
	
     
<?php
$html = ob_get_clean();
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->set_paper('A4','potrait');
$dompdf->render();
$dompdf->stream("invoice_pi.pdf", array("Attachment" => 0));
?>