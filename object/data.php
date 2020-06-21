<?php if (!defined('OFFDIRECT')) include '../error404.php';?>
<body class="nav-md">
<div class="container body">
<div class="main_container">
		
<?php
include_once "library/inc.seslogin.php";
include_once "library/inc.library.php";
include "menu.php";
include "base_template_topnav.php";
?>
<!--HEADER TITLE-->
<link href="<?php echo $baseURL;?>assets/other/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $baseURL;?>assets/other/datables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
	<div class="right_col" role="main">
	<div class="">
	<div class="page-title">
	<div class="title_left">
		<h3>General<small>Barang</small></h3>
	</div>
	</div>
	<div class="clearfix"></div>
	<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	<div class="x_title">
		<h2>Data Barang<small></small></h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
<!-- BATAS HEADER TITLE-->
<!-- DIGUNAKAN UNTUK PROSES PENCARIAN BERDASARKAN KATEGORI (DISESUAIKAN DENGAN PENCARIAN) -->
<?php
$filterSQL="";
// SETELAH TOMBOL GO DI KLIK AKAN PROSES SCRIPT SEPERTI INI
$Kat 			= isset($_GET['Kat']) ? $_GET['Kat'] : 'semua';//dari URL
$dataBagian 	= $_SESSION['SES_BAGIAN']; //isset($_POST['cmbBagian']) ? $_POST['cmbBagian'] : $Kat; //dari form
if (trim($dataBagian)=="semua") {
		$filterSQL ="";		
	}
	else {
		$filterSQL="WHERE a.kd_bagian='$dataBagian' ";
}
?>
<!--BATAS DIGUNAKAN UNTUK PROSES PENCARIAN
	BERDASARKAN KATEGORI (DISESUAIKAN DENGAN PENCARIAN) -->
	
<!-- FORM PENCARIAN BERDASARKAN KATEGORI-->
<form class="form-horizontal form-label-left" action="<?php $_server['PHP_SELF'];?>"method="post" name="form1" target="_self">
	<div class="form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="aaa">Stock bagian</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<select id="aaa" class="form-control" name="cmbBagian" disabled>
				<option value="semua"></option>
				<?php
				
				$dataSql ="SELECT * FROM bagian ORDER BY kd_bagian";
				$dataQry = mysqli_query($koneksidb, $dataSql);
				while ($dataRow = mysqli_fetch_array($dataQry)) {
					if ($dataRow['kd_bagian']== $dataBagian){
						$cek ="selected";

					} else {$cek="";}
					echo "<option value='$dataRow[kd_bagian]' $cek>$dataRow[nm_bagian]</option>";
				}
				
				?>
				
			</select>
		</div>
		<!-- <input type="submit" class ="btn btn-default" name="btnTampil" value="GO"/> -->
	</div>
</form>
<!-- BATAS FORM PENCARIAN BERDASARKAN KATEGORI -->
<div class="ln_solid"></div>
<!--DATAGRID BERDASARKAN DATA YANG AKAN KITA TAMPILKAN-->
<table id="datatable" class="table table-striped table-bordered">
	<thead>
		<tr>
			<th width="23" align="center"><strong>No</strong></th>
			<th width="51"><strong>Kode</strong></th>
			<th width="417"><strong>Model Piano</strong></th>
			<th width="132">Nama Barang</th>
			<th width="70" align="center"><strong>Jumlah</strong></th>
			<th width="100" align="center"><a href="<?php echo $baseURL;?>object/add" target"_self">
				<span class="fa fa-plus-circle"></span> Add Data</a></th>
		</tr>
	</thead>
	<?php
	/* PENCARIAN BERDASARKA DATA DI TABEL*/

	$mySql ="SELECT a.kd_barang, c.nm_barang, a.jumlah, b.nm_bagian, d.nm_model FROM st_barang a LEFT JOIN bagian b ON b.kd_bagian=a.kd_bagian LEFT JOIN barang c on a.kd_barang=c.kd_barang LEFT JOIN model d on c.kd_model=d.kd_model $filterSQL";	

	
	//$mySql ="SELECT * FROM st_barang $filterSQL ORDER BY timestamp DESC, kd_barang DESC";
	$myQry = mysqli_query($koneksidb, $mySql);
	$nomor = $hal;
	//PERULANGAN DATA
	while ($myData = mysqli_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData ['kd_barang'];
		?>
		
	<!--MENAMPILKAN HASIL PENCARIAN DATABASE-->
	<tr>
		<td align="center"><?php echo $nomor;?></td>
		<td><?php echo $myData['kd_barang']?></td>
		<td><?php echo $myData['nm_model']?></td>
		<td><?php echo $myData['nm_barang']?></td>
		<td align="center"><?php echo $myData['jumlah'];?></td>

		<td align="center">
			<?php if (!$_SESSION['SES_PENGGUNA']):?>
				<a href="<?php echo $baseURL;?>object/edit?kode=<?php echo $Kode; ?>">
					<span class="fa fa-pencil"></span></a>
				<a href="<?php echo $baseURL;?>object/delete?kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('Apakah anda yakin ingin menghapus data <?php echo $Kode; ?>')">
					<span class="fa fa-trash"></span></a>
				</td>
				<?php endif;?>
	</tr>              
<?php }?>
<!--BATAS PERULANGAN DATA-->
</table>
<!--BATAS DATAGRID BERDASARKA DATA YANG AKAN KITA TAMPILKAN-->
</div>
</div>
</div>
</div>
</div>
</div>

<?php include "base_template_footer.php";?>
</div>
</div>
<!--Datatables PEMBENTUKAN TABLE BERDASARKAN DATABASE-->
<script src="<?php echo $baseURL;?>assets/others/datables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $baseURL;?>assets/others/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo $baseURL;?>assets/others/dataTables.net-buttons/js/dataTables.bootstrap.buttons.min.js"></script>

<!-- Datatables-->
<script>
	pagename='object/data';
	$(document).ready(function(){
		$('#datatable').dataTables({
			"columnDefs": [
			{"orderable": false, "targets": 3}]
		});
	});
</script>
</body>
</form>
</body>
