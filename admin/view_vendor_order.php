
<?php
$vendorId = base64_decode($_GET['vendor_id']);

$where = 1;
if (isset($_GET['vendor_id']) && $_GET['vendor_id'] != '') {
    $where = " vendor_orders.vendor_id = '" . $vendorId . "'";
}

$sql = "SELECT vendor_orders.order_id as orderId , vendor_orders.*,subhecha_vendor_master.name,
       (SELECT SUM(price) FROM vendor_order_details WHERE vendor_order_id = orderId) as totalCost,
       (SELECT coalesce(SUM(paid_amount),'0.00') FROM vendor_payment_history WHERE vendor_order_id = orderId) AS totalPaid
       FROM vendor_orders INNER JOIN subhecha_vendor_master ON
       vendor_orders.vendor_id = subhecha_vendor_master.id
       where $where
        ";
$qry = mysql_query($sql);

include('includes/header_after_login.php');
?>
<script type="text/javascript">
    try {
        ace.settings.check('breadcrumbs', 'fixed')
    } catch (e) {
    }
</script>

<script src="js/ajjquery.min.js"></script>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>

                    <small>
                        <a href="?page=list_vendor"> Vendor list</a>&nbsp;&nbsp;  Vendor Order List
                    </small>
                </h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <?php if (!empty($error_message)) { ?>
        <!-- BEGIN ERROR BOX -->
        <div class="alert alert-danger fade in" id="error">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo $error_message; ?>
        </div>
        <!-- END ERROR BOX -->	
    <?php } if (!empty($success_msg)) { ?>	
        <!-- BEGIN OF SUCCESS BOX -->
        <div class="alert alert-success fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Well done!</strong> <?php echo $success_msg; ?>.
        </div>									
        <!-- END OF SUCCESS BOX -->
    <?php } ?>
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Vendor Order <small>List</small></h2>
                    <div align="left">
                        <?php
                        if($vendorId!='')
                        {
                            $link = '?page=new_vendor_order&vendor_id='.  base64_encode($vendorId);
                        }
                        else $link = '?page=new_vendor_order';
                        ?>
                        <a href="<?php echo $link;?>" title="New Order">&nbsp;<img src="images/add.png" height="25" width="25"/></a></div>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                        </code>
                    </p>
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr role="row">
                                <th>SL.No.</th>
                                <th>Order Id</th>
                                <th>Oder Date</th>
                                <th>Vendor Name </th>
                                <th>Total Cost </th>
                                <th>Paid </th>
                                <th>Due </th>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php
                            if (mysql_num_rows($qry) > 0) {
                                $c = 1;
                                while ($col_list_array = mysql_fetch_assoc($qry)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $c++; ?></td>

                                        <td><?php echo $col_list_array['order_no']; ?></td>
                                        <td><?php echo date('F j,Y', strtotime($col_list_array['order_date'])); ?></td>
                                        <td><?php echo $col_list_array['name']; ?></td>
                                        
                                        <td><?php echo $col_list_array['totalCost']; ?></td>
                                        <td><?php echo $col_list_array['totalPaid']; ?></td>
                                        <td><?php echo number_format(($col_list_array['totalCost'] - $col_list_array['totalPaid']),2); ?></td>
                                        <td class="text-center">
                                            <a class="btn btn-dark" title="View Order in detail" href="?page=view_vendor_order_detail&orderid=<?php echo $col_list_array['order_id']; ?>">View</a>
                                            <!--                                            <a class="btn btn-dark" title="Place Order" href="#">Due</a>-->
                                            <a class="btn btn-dark" title="Pay due" href="?page=pay_to_vendor&orderid=<?php echo base64_encode($col_list_array['order_id']); ?>&vendorid=<?php echo base64_encode($col_list_array['vendor_id']); ?>">Pay</a>

                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            <tr role="row">
                                <th>SL.No.</th>
                                <th>Order Id</th>
                                <th>Oder Date</th>
                                <th> Vendor Name </th>
                                <th>Total Cost </th>
                                <th>Paid </th>
                                <th>Due </th>
                                <th>Action</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>   
</div>
</div>
<!-- /page content 
 <script src="js/bootstrap.min.js"></script>-->

<!-- bootstrap progress js 
<script src="js/progressbar/bootstrap-progressbar.min.js"></script>-->
<!-- icheck 
<script src="js/icheck/icheck.min.js"></script>

<script src="js/custom.js"></script>-->


<!-- Datatables -->
<!-- <script src="js/datatables/js/jquery.dataTables.js"></script>
<script src="js/datatables/tools/js/dataTables.tableTools.js"></script> -->

<!-- Datatables-->
<script src="js/datatables/jquery.dataTables.min.js"></script>
<script src="js/datatables/dataTables.bootstrap.js"></script>
<script src="js/datatables/dataTables.buttons.min.js"></script>
<script src="js/datatables/buttons.bootstrap.min.js"></script>
<script src="js/datatables/jszip.min.js"></script>
<script src="js/datatables/pdfmake.min.js"></script>
<script src="js/datatables/vfs_fonts.js"></script>
<script src="js/datatables/buttons.html5.min.js"></script>
<script src="js/datatables/buttons.print.min.js"></script>
<script src="js/datatables/dataTables.fixedHeader.min.js"></script>
<script src="js/datatables/dataTables.keyTable.min.js"></script>
<script src="js/datatables/dataTables.responsive.min.js"></script>
<script src="js/datatables/responsive.bootstrap.min.js"></script>
<script src="js/datatables/dataTables.scroller.min.js"></script>

<!-- pace -->
<script src="js/pace/pace.min.js"></script>
<script>
    var handleDataTableButtons = function () {
        "use strict";
        0 !== $("#datatable-buttons").length && $("#datatable-buttons").DataTable({
            dom: "Bfrtip",
            buttons: [{
                    extend: "copy",
                    className: "btn-sm"
                }, {
                    extend: "csv",
                    className: "btn-sm"
                }, {
                    extend: "excel",
                    className: "btn-sm"
                }, {
                    extend: "pdf",
                    className: "btn-sm"
                }, {
                    extend: "print",
                    className: "btn-sm"
                }],
            responsive: !0
        })
    },
            TableManageButtons = function () {
                "use strict";
                return {
                    init: function () {
                        handleDataTableButtons()
                    }
                }
            }();
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable').dataTable();
        $('#datatable-keytable').DataTable({
            keys: true
        });
        $('#datatable-responsive').DataTable();
        $('#datatable-scroller').DataTable({
            ajax: "js/datatables/json/scroller-demo.json",
            deferRender: true,
            scrollY: 380,
            scrollCollapse: true,
            scroller: true
        });
        var table = $('#datatable-fixed-header').DataTable({
            fixedHeader: true
        });
    });
    TableManageButtons.init();
</script>



<?php include('includes/footer_after_login.php'); ?>
