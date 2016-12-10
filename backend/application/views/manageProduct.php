<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>AdminLTE 2 | Dashboard</title>
<!-- Tell the browser to be responsive to screen width -->
<meta
	content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"
	name="viewport">
<!-- Bootstrap 3.3.6 -->
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<!-- jvectormap -->
<link rel="stylesheet" href="../assets/css/jquery-jvectormap-1.2.2.css">
<!-- Theme style -->
<link rel="stylesheet" href="../assets/css/AdminLTE.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="../assets/css/_all-skins.min.css">
<link rel="stylesheet" href="../assets/css/style.css">

<link rel="stylesheet" href="../assets/css/daterangepicker.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="../assets/css/datepicker3.css">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="../assets/css/all.css">
<!-- Bootstrap Color Picker -->
<link rel="stylesheet"
	href="../assets/css/bootstrap-colorpicker.min.css">
<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="../assets/css/bootstrap-timepicker.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="../assets/css/select2.min.css">



<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<?php

?>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

		<header class="main-header">

			<!-- Logo -->
			<a href="index2.html" class="logo"> <!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini"><b>A</b>LT</span> <!-- logo for regular state and mobile devices -->
				<span class="logo-lg"><b>Proshopping</b></span>
			</a>

			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas"
					role="button"> <span class="sr-only">Toggle navigation</span>
				</a>
				<!-- Navbar Right Menu -->
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<!-- Messages: style can be found in dropdown.less-->



						<!-- User Account: style can be found in dropdown.less -->
						
						 <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../assets/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $admin_user['firstName'].' '.$admin_user['lastName'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../assets/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php echo $admin_user['firstName'].' '.$admin_user['lastName'];?>
                  
                </p>
              </li>
              <!-- Menu Body -->
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="/admin/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>

					</ul>
				</div>

			</nav>
		</header>
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<!-- Sidebar user panel -->
				<div class="user-panel">
					<div class="pull-left image">
						<img src="../assets/img/user2-160x160.jpg" class="img-circle"
							alt="User Image">
					</div>
					<div class="pull-left info">
						<p><?php echo $admin_user['firstName'].' '.$admin_user['lastName'];?></p>
					</div>
				</div>
				<!-- search form -->
				<!-- 				<form action="#" method="get" class="sidebar-form"> -->
				<!-- 					<div class="input-group"> -->
				<!-- 						<input type="text" name="q" class="form-control" -->
				<!-- 							placeholder="Search..."> <span class="input-group-btn"> -->
				<!-- 							<button type="submit" name="search" id="search-btn" -->
				<!-- 								class="btn btn-flat"> -->
				<!-- 								<i class="fa fa-search"></i> -->
				<!-- 							</button> -->
				<!-- 						</span> -->
				<!-- 					</div> -->
				<!-- 				</form> -->
				<!-- /.search form -->
				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu">
					<li class="header">MAIN NAVIGATION</li>
					<li class="active treeview"><a href="/admin/userhome"> <i class="fa fa-dashboard"></i>
							<span>Dashboard</span> <!-- 							<span class="pull-right-container"> <i -->
							<!-- 								class="fa fa-angle-left pull-right"></i> --> <!-- 						</span> -->
					</a></li>
					<li class="treeview"><a href="#"> <i class="fa fa-files-o"></i> <span>Product
								Management</span> <!-- 					<span class="pull-right-container"> <span -->
							<!-- 								class="label label-primary pull-right">4</span> -->
							<!-- 						</span> -->
					</a>
						<ul class="treeview-menu">
							<li><a href="/admin/addproduct"><i class="fa fa-circle-o"></i>
									Add New Product</a></li>
							<li><a href="/admin/manageproduct"><i class="fa fa-circle-o"></i>
									Manage Products</a></li>

						</ul></li>
					<li class="treeview"><a href="/admin/manageorder"> <i class="fa fa-files-o"></i> <span>Order
								Management</span> <!-- 					<span class="pull-right-container"> <span -->
							<!-- 								class="label label-primary pull-right">4</span> -->
							<!-- 						</span> -->
					</a>
						<ul class="treeview-menu">
<li><a href="/admin/manageorder"><i class="fa fa-circle-o"></i>
									Manage Orders</a></li>

						</ul></li>
					<li class="treeview"><a href="#"> <i class="fa fa-files-o"></i> <span>User
								Management</span> <!-- 					<span class="pull-right-container"> <span -->
							<!-- 								class="label label-primary pull-right">4</span> -->
							<!-- 						</span> -->
					</a>
						<ul class="treeview-menu">
							<li><a href="/admin/manageuser"><i class="fa fa-circle-o"></i>
									Manage User</a></li>

						</ul></li>






				</ul>
			</section>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>Product Management</h1>

			</section>
			<?php if(!empty($result) && $result->status){ ?>
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert"
						aria-hidden="true">&times;</button>
					<h4>
						<i class="icon fa fa-check"></i> Success!
					</h4>
				</div>
				<?php }else if(!empty($result) && empty($result->status)){
					?>
					<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Fail!</h4>
						<?php echo isset($result->msg) ? $result->msg:  "An error occured. Please contact system admin.";?>
					</div>
					<?php 
				}?>
			<!-- Main content -->
			<div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Product Name</th>
                  <th>Product Description</th>
                  <th>Product Image</th>
                  <th>price</th>
                  <th>Color</th>
                  <th>Brand</th>
                  <th>Type</th>
                  <th>Gender</th>
                  <th>Active?</th>
                  <th>Rating</th>
                  <th>Update</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($products as $product){
                	?>
                	<tr>
                	<form method="post" action="/admin/manageproduct">
                	<input type="hidden" name="id" value="<?php echo $product->productid; ?>">
                  <td><?php echo $product->name;?></td>
                  <td><?php echo $product->desc->details;?></td>
                  <td><img src = "<?php echo '/uploads/'.$product->img;?>" /></td>
                   <td><?php echo $product->price;?></td>
                   
                   <td><?php echo $product->desc->color;?></td>
                   <td><?php echo $product->desc->brand;?></td>
                   <td><?php echo $product->desc->type;?></td>
                   <td><?php echo $product->desc->gender;?></td>
                   <td><input type="checkbox" name="isActive" <?php echo ($product->isactive== 'y')? 'checked': '' ?>> </td>
                  <td><?php echo $product->rating;?></td>
                  <td><input type="submit" value="Update" name="update"></td>
                  <td><input type="submit" value="Delete" name="delete"></td>
                  </form>
                </tr>
                	<?php 
                }?>
                
                
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<footer class="main-footer">
			<div class="pull-right hidden-xs">
				<b>Version</b> 2.3.7
			</div>
			<strong>Copyright &copy; 2014-2016 <a
				href="http://almsaeedstudio.com">Almsaeed Studio</a>.
			</strong> All rights reserved.
		</footer>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Create the tabs -->
			<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
				<li><a href="#control-sidebar-home-tab" data-toggle="tab"><i
						class="fa fa-home"></i></a></li>
				<li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i
						class="fa fa-gears"></i></a></li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
				<!-- Home tab content -->
				<div class="tab-pane" id="control-sidebar-home-tab">
					<h3 class="control-sidebar-heading">Recent Activity</h3>
					<ul class="control-sidebar-menu">
						<li><a href="javascript:void(0)"> <i
								class="menu-icon fa fa-birthday-cake bg-red"></i>

								<div class="menu-info">
									<h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

									<p>Will be 23 on April 24th</p>
								</div>
						</a></li>
						<li><a href="javascript:void(0)"> <i
								class="menu-icon fa fa-user bg-yellow"></i>

								<div class="menu-info">
									<h4 class="control-sidebar-subheading">Frodo Updated His
										Profile</h4>

									<p>New phone +1(800)555-1234</p>
								</div>
						</a></li>
						<li><a href="javascript:void(0)"> <i
								class="menu-icon fa fa-envelope-o bg-light-blue"></i>

								<div class="menu-info">
									<h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

									<p>nora@example.com</p>
								</div>
						</a></li>
						<li><a href="javascript:void(0)"> <i
								class="menu-icon fa fa-file-code-o bg-green"></i>

								<div class="menu-info">
									<h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

									<p>Execution time 5 seconds</p>
								</div>
						</a></li>
					</ul>
					<!-- /.control-sidebar-menu -->

					<h3 class="control-sidebar-heading">Tasks Progress</h3>
					<ul class="control-sidebar-menu">
						<li><a href="javascript:void(0)">
								<h4 class="control-sidebar-subheading">
									Custom Template Design <span
										class="label label-danger pull-right">70%</span>
								</h4>

								<div class="progress progress-xxs">
									<div class="progress-bar progress-bar-danger"
										style="width: 70%"></div>
								</div>
						</a></li>
						<li><a href="javascript:void(0)">
								<h4 class="control-sidebar-subheading">
									Update Resume <span class="label label-success pull-right">95%</span>
								</h4>

								<div class="progress progress-xxs">
									<div class="progress-bar progress-bar-success"
										style="width: 95%"></div>
								</div>
						</a></li>
						<li><a href="javascript:void(0)">
								<h4 class="control-sidebar-subheading">
									Laravel Integration <span
										class="label label-warning pull-right">50%</span>
								</h4>

								<div class="progress progress-xxs">
									<div class="progress-bar progress-bar-warning"
										style="width: 50%"></div>
								</div>
						</a></li>
						<li><a href="javascript:void(0)">
								<h4 class="control-sidebar-subheading">
									Back End Framework <span class="label label-primary pull-right">68%</span>
								</h4>

								<div class="progress progress-xxs">
									<div class="progress-bar progress-bar-primary"
										style="width: 68%"></div>
								</div>
						</a></li>
					</ul>
					<!-- /.control-sidebar-menu -->

				</div>
				<!-- /.tab-pane -->

				<!-- Settings tab content -->
				<div class="tab-pane" id="control-sidebar-settings-tab">
					<form method="post">
						<h3 class="control-sidebar-heading">General Settings</h3>

						<div class="form-group">
							<label class="control-sidebar-subheading"> Report panel usage <input
								type="checkbox" class="pull-right" checked>
							</label>

							<p>Some information about this general settings option</p>
						</div>
						<!-- /.form-group -->

						<div class="form-group">
							<label class="control-sidebar-subheading"> Allow mail redirect <input
								type="checkbox" class="pull-right" checked>
							</label>

							<p>Other sets of options are available</p>
						</div>
						<!-- /.form-group -->

						<div class="form-group">
							<label class="control-sidebar-subheading"> Expose author name in
								posts <input type="checkbox" class="pull-right" checked>
							</label>

							<p>Allow the user to show his name in blog posts</p>
						</div>
						<!-- /.form-group -->

						<h3 class="control-sidebar-heading">Chat Settings</h3>

						<div class="form-group">
							<label class="control-sidebar-subheading"> Show me as online <input
								type="checkbox" class="pull-right" checked>
							</label>
						</div>
						<!-- /.form-group -->

						<div class="form-group">
							<label class="control-sidebar-subheading"> Turn off notifications
								<input type="checkbox" class="pull-right">
							</label>
						</div>
						<!-- /.form-group -->

						<div class="form-group">
							<label class="control-sidebar-subheading"> Delete chat history <a
								href="javascript:void(0)" class="text-red pull-right"><i
									class="fa fa-trash-o"></i></a>
							</label>
						</div>
						<!-- /.form-group -->
					</form>
				</div>
				<!-- /.tab-pane -->
			</div>
		</aside>
		<!-- /.control-sidebar -->
		<!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
		<div class="control-sidebar-bg"></div>

	</div>
	<!-- ./wrapper -->

	<!-- jQuery 2.2.3 -->
	<script src="../assets/js/jquery-2.2.3.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="../assets/js/bootstrap.min.js"></script>
	<!-- FastClick -->
	<script src="../assets/js/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="../assets/js/app.min.js"></script>
	<!-- Sparkline -->
	<script src="../assets/js/jquery.sparkline.min.js"></script>
	<!-- jvectormap -->
	<script src="../assets/js/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="../assets/js/jquery-jvectormap-world-mill-en.js"></script>
	<!-- SlimScroll 1.3.0 -->
	<script src="../assets/js/jquery.slimscroll.min.js"></script>
	<!-- ChartJS 1.0.1 -->
	<script src="../assets/js/Chart.min.js"></script>
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<script src="../assets/js/dashboard2.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="../assets/js/demo.js"></script>


	<script src="../assets/js/select2.full.min.js"></script>
	<!-- InputMask -->
	<script src="../assets/js/jquery.inputmask.js"></script>
	<script src="../assets/js/jquery.inputmask.date.extensions.js"></script>
	<script src="../assets/js/jquery.inputmask.extensions.js"></script>
	<!-- date-range-picker -->
	<script
		src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
	<script src="../assets/js/daterangepicker.js"></script>
	<!-- bootstrap datepicker -->
	<script src="../assets/js/bootstrap-datepicker.js"></script>
	<!-- bootstrap color picker -->
	<script src="../assets/js/bootstrap-colorpicker.min.js"></script>
	<!-- bootstrap time picker -->
	<script src="../assets/js/bootstrap-timepicker.min.js"></script>
	<!-- SlimScroll 1.3.0 -->
	<!-- iCheck 1.0.1 -->
	<script src="../assets/js/icheck.min.js"></script>
	<!-- FastClick -->
	<script src="../assets/js/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="../assets/js/app.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<!-- Page script -->
</body>

<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
</script>
</html>
