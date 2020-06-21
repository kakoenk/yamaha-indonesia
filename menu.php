<?php
if(!defined('OFFDIRECT')) include 'error404.php';
?>
<div class="col-md-3 left_col">
	<div class="left_col scroll-view">
		<div class="navbar nav_title" style="border: 0;">
		  <a href="" class="site_title">
			<img src="<?php echo $baseURL; ?>assets/images/logo.png" alt="Logo" 
			style="margin-top:-50px;width:200px;height:170px;">
		  </a>
		</div>
		<div class="clearfix"></div>
		<br />
		<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
		  <div class="menu_section">
			<h3>General</h3>
			<ul class="nav side-menu">
			  <li><a href='<?php echo $baseURL; ?>main' title='Homepage'><i class="fa fa-home"></i> Home </a>
			  </li>
			   <li><a href='<?php echo $baseURL; ?>object/data'><i class="fa fa-cubes"></i> Stok Barang </a>
			  </li>			 
			  <li><a><i class="glyphicon"></i> Action <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
				  <li><a href="<?php echo $baseURL; ?>procurement/pengiriman">Pengiriman</a></li>
				  <li><a href="<?php echo $baseURL; ?>procurement/terima1">Penerimaan</a></li>
				</ul>
			  </li>
			   <li><a><i class="glyphicon"></i> History <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
				  <li><a href="<?php echo $baseURL; ?>procurement/pengiriman">Pengiriman</a></li>
				   <li><a href="<?php echo $baseURL; ?>procurement/pengiriman">Penerimaan</a></li>
				</ul>
			</li>
			 
			</ul>
		  </div>
		</div>
	</div>
</div>
