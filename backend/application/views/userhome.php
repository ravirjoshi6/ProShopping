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
					<li class="active treeview"><a href="#"> <i class="fa fa-dashboard"></i>
							<span>Dashboard</span> 
<!-- 							<span class="pull-right-container"> <i -->
<!-- 								class="fa fa-angle-left pull-right"></i> -->
<!-- 						</span> -->
					</a>
						</li>
					<li class="treeview"><a href="/admin/userhome"> <i class="fa fa-files-o"></i> <span>Product Management</span> 
<!-- 					<span class="pull-right-container"> <span -->
<!-- 								class="label label-primary pull-right">4</span> -->
<!-- 						</span> -->
					</a>
						<ul class="treeview-menu">
							<li><a href="/admin/addproduct"><i class="fa fa-circle-o"></i>
									Add New Product</a></li>
							<li><a href="/admin/manageproduct"><i class="fa fa-circle-o"></i>
									Manage Products</a></li>
							
						</ul>
					</li>
					<li class="treeview"><a href="/admin/manageorder"> <i class="fa fa-files-o"></i> <span>Order Management</span> 
<!-- 					<span class="pull-right-container"> <span -->
<!-- 								class="label label-primary pull-right">4</span> -->
<!-- 						</span> -->
					</a>
						<ul class="treeview-menu">
							<li><a href="/admin/manageorder"><i class="fa fa-circle-o"></i>
									Manage Orders</a></li>
							
						</ul>
					</li>
					<li class="treeview"><a href="#"> <i class="fa fa-files-o"></i> <span>User Management</span> 
<!-- 					<span class="pull-right-container"> <span -->
<!-- 								class="label label-primary pull-right">4</span> -->
<!-- 						</span> -->
					</a>
						<ul class="treeview-menu">
							<li><a href="/admin/manageuser"><i class="fa fa-circle-o"></i>
									Manage User</a></li>
							
						</ul>
					</li>
					
					
					
					
					
					
				</ul>
			</section>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					Welcome to Proshop Admin panel<small>Version 1.0</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Dashboard</li>
				</ol>
			</section>

			<!-- Main content -->
			<section class="content">
				<!-- Info boxes -->
				<div class="row">
					


					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="info-box">
							<span class="info-box-icon bg-green"><i
								class="ion ion-ios-cart-outline"></i></span>

							<div class="info-box-content">
								<span class="info-box-text">Pending Orders</span> <span
									class="info-box-number"><?php echo $orders?></span>
							</div>
							<!-- /.info-box-content -->
						</div>
						<!-- /.info-box -->
					</div>
					<!-- /.col -->
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="info-box">
							<span class="info-box-icon bg-yellow"><i
								class="ion ion-ios-people-outline"></i></span>

							<div class="info-box-content">
								<span class="info-box-text">Members</span> <span
									class="info-box-number"><?php echo $members;?></span>
							</div>
							<!-- /.info-box-content -->
						</div>
						<!-- /.info-box -->
					</div>
					<!-- /.col -->
				</div>
				<!-- /.row -->

				
				<!-- /.row -->

				<!-- Main row -->
				<div class="row">
					<!-- Left col -->
					<div class="col-md-8 col-lg-6">
						<!-- MAP & BOX PANE -->
						
						<!-- /.box -->
						<div class="row">
							
							<!-- /.col -->

							<div class="col-md-6 col-lg-12">
								<!-- USERS LIST -->
								<div class="box box-danger">
									<div class="box-header with-border">
										<h3 class="box-title">Latest Members</h3>

										<div class="box-tools pull-right">
											<span class="label label-danger">8 New Members</span>
											<button type="button" class="btn btn-box-tool"
												data-widget="collapse">
												<i class="fa fa-minus"></i>
											</button>
											<button type="button" class="btn btn-box-tool"
												data-widget="remove">
												<i class="fa fa-times"></i>
											</button>
										</div>
									</div>
									<!-- /.box-header -->
									<div class="box-body no-padding">
										<ul class="users-list clearfix manage-box">
										<?php 
											foreach($user as $u){
												?>
												<li><img src="../assets/img/user1-128x128.jpg"
												alt="User Image"> <a class="users-list-name" href="#"><?php echo $u['firstname'].' '.$u['lastname']?></a> <span class="users-list-date"><?php echo $u['time']?></span></li>	
												<?php 
											}
										?>
											
<!-- 											<li><img src="../assets/img/user8-128x128.jpg" -->
<!-- 												alt="User Image"> <a class="users-list-name" href="#">Norman</a> -->
<!-- 												<span class="users-list-date">Yesterday</span></li> -->
<!-- 											<li><img src="../assets/img/user7-128x128.jpg" -->
<!-- 												alt="User Image"> <a class="users-list-name" href="#">Jane</a> -->
<!-- 												<span class="users-list-date">12 Jan</span></li> -->
<!-- 											<li><img src="../assets/img/user6-128x128.jpg" -->
<!-- 												alt="User Image"> <a class="users-list-name" href="#">John</a> -->
<!-- 												<span class="users-list-date">12 Jan</span></li> -->
<!-- 											<li><img src="../assets/img/user2-160x160.jpg" -->
<!-- 												alt="User Image"> <a class="users-list-name" href="#">Alexander</a> -->
<!-- 												<span class="users-list-date">13 Jan</span></li> -->
<!-- 											<li><img src="../assets/img/user5-128x128.jpg" -->
<!-- 												alt="User Image"> <a class="users-list-name" href="#">Sarah</a> -->
<!-- 												<span class="users-list-date">14 Jan</span></li> -->
<!-- 											<li><img src="../assets/img/user4-128x128.jpg" -->
<!-- 												alt="User Image"> <a class="users-list-name" href="#">Nora</a> -->
<!-- 												<span class="users-list-date">15 Jan</span></li> -->
<!-- 											<li><img src="../assets/img/user3-128x128.jpg" -->
<!-- 												alt="User Image"> <a class="users-list-name" href="#">Nadia</a> -->
<!-- 												<span class="users-list-date">15 Jan</span></li> -->
										</ul>
										<!-- /.users-list -->
									</div>
									<!-- /.box-body -->
									<div class="box-footer text-center">
										<a href="javascript:void(0)" class="uppercase">View All Users</a>
									</div>
									<!-- /.box-footer -->
								</div>
								<!--/.box -->
							</div>
							<!-- /.col -->
						</div>
						<!-- /.row -->

						<!-- TABLE: LATEST ORDERS -->
						<div class="box box-info">
							<div class="box-header with-border">
								<h3 class="box-title">Latest Orders</h3>

								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool"
										data-widget="collapse">
										<i class="fa fa-minus"></i>
									</button>
									<button type="button" class="btn btn-box-tool"
										data-widget="remove">
										<i class="fa fa-times"></i>
									</button>
								</div>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<div class="table-responsive">
									<table class="table no-margin">
										<thead>
											<tr>
												<th>Order ID</th>
												<th>Item</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
										
										<?php if(empty($recent_orders)){ ?>
											<tr><td>No Orders Found</td></tr>
										<?php 	
										} else {foreach($recent_orders as $order){
											?>
											<tr>
												<td><a href="pages/examples/invoice.html"><?php echo $order['order_id']; ?></a></td>
												<td><?php echo $order['product_name']; ?></td>
												<?php if($order['orderStatus'] == 'Shipped') {
													?>
													<td><span class="label label-success">Shipped</span></td>
													<?php 
												}else if($order['orderStatus'] == 'Pending'){
													?>
														<td><span class="label label-warning">Pending</span></td>
													<?php 
												}else if($order['orderStatus'] == 'Delivered'){
													?>
											<td><span class="label label-danger">Delivered</span></td>
											<?php 
												}else if($order['orderStatus'] == 'Processing'){
													?>
													<td><span class="label label-info">Processing</span></td>
													<?php 
												}?>
												
												
											</tr>
											<?php 
										}}?>
											
										</tbody>
									</table>
								</div>
								<!-- /.table-responsive -->
							</div>
							<!-- /.box-body -->
							<div class="box-footer clearfix">
<!-- 								<a href="javascript:void(0)" -->
<!-- 									class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a> -->
								<a href="javascript:void(0)"
									class="btn btn-sm btn-default btn-flat pull-right">View All
									Orders</a>
							</div>
							<!-- /.box-footer -->
						</div>
						<!-- /.box -->
					</div>
					<!-- /.col -->

					<div class="col-md-4 col-lg-5">
						<!-- PRODUCT LIST -->
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Recently Added Products</h3>

								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool"
										data-widget="collapse">
										<i class="fa fa-minus"></i>
									</button>
									<button type="button" class="btn btn-box-tool"
										data-widget="remove">
										<i class="fa fa-times"></i>
									</button>
								</div>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<ul class="products-list product-list-in-box">
									<?php 
										foreach($products as $product){
											?>
												<li class="item">
										<div class="product-img">
											<img src=<?php echo '"../uploads/'.$product['productImage'].'"'; ?>
												alt="Product Image">
										</div>
										<div class="product-info">
											<a href="javascript:void(0)" class="product-title"><?php echo $product['name'];?>
												<span class="label label-warning pull-right"><?php echo $product['price'];?></span>
											</a> <span class="product-description"> <?php echo $product['desc'];?></span>
										</div>
									</li>		
											<?php 
										}
									?>
									
								</ul>
							</div>
							<!-- /.box-body -->
							<div class="box-footer text-center">
								<a href="javascript:void(0)" class="uppercase">View All Products</a>
							</div>
							<!-- /.box-footer -->
						</div>
						<!-- /.box -->
					</div>
					<!-- /.col -->
				</div>
				<!-- /.row -->
			</section>
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
</body>
</html>
