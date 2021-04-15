 <!-- Begin Page Content -->
 <div class="container-fluid">
 	<div class="row">
 		<div class="col-lg-10">
 			<!-- Page Heading -->
 			<h1 class="h3 mb-4 text-gray-800">All Product List</h1>
 		</div>

 		<div class="col-lg-2">
 			<!-- Button trigger modal -->
 			<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#product_modal">
 				Add New
 			</button>
 		</div>
 	</div>
 </div>

 <hr>
 <!-- /.container-fluid -->


<!-- data table -->

<div class="container-fluid my-5">
	<div class="row">
		<div class="col-md-12 mx-auto">
			<div class="table-responsive">
				<table class="table table-borderless table-hover" id="product_table">
					<thead class="table-secondary text-dark font-weight-bold">
						<tr class="bg-secondary text-white">
							<th>Product ID</th>
							<th>Product Name</th>
							<th>App Image</th>
							<th>Card Image</th>
							<th>Web Image</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- end table -->



<!---------------------------------------- add modal  -------------------------------------->

 <!-- Modal -->
 <div class="modal fade" id="product_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
 	<div class="modal-dialog">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h5 class="modal-title" id="exampleModalLabel">Add Data </h5>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">

 				<form action="" method="post" id="product_add_form" accept-charset="utf-8">

 					<div class="form-group">
 						<label for="product_name">Name</label>
 						<input type="text" name="name" class="form-control" id="product_name">
 					</div>

					<div class="form-group">
						<label for="app_id"> Select App Name </label>
						<select name="app_id" id="app_id" class="form-control">
							<?php foreach ($all_apps as $key => $value) {
								echo 	'<option value="'. $value->app_id . '" >' .  $value->name .'</option>' ;
							}
							?>
						</select>
					</div>

					<div class="form-group">
						<label for="card_id"> Select Card Name </label>
						<select name="card_id" id="card_id" class="form-control">
								<?php foreach ($all_cards as $key => $value) {
								echo 	'<option value="'. $value->card_id . '" >' . $value->name .'</option>' ;
							}
							?>
						</select>
					</div>

					<div class="form-group">
						<label for="web_id"> Select Web Name </label>
						<select name="web_id" id="web_id" class="form-control">
								<?php foreach ($all_webs as $key => $value) {
								echo 	'<option value="'. $value->web_id . '" >' . $value->name .'</option>' ;
							}
							?>
						</select>
					</div>

					<div class="modal-footer">
		 				<button type="button" class="btn btn-primary" id="product_add">Add</button>
		 				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 					</div>
 				</form>
 			</div>
 			
 		</div>
 	</div>
 </div>



	<!-- base_url  -->
	<input type="hidden" value="<?php echo base_url(); ?>" id="base_url" />



					