 <!-- Begin Page Content -->
 <div class="container-fluid">
 	<div class="row">
 		<div class="col-lg-10">
 			<!-- Page Heading -->
 			<h1 class="h3 mb-4 text-gray-800">web List</h1>
 		</div>

 		<div class="col-lg-2">
 			<!-- Button trigger modal -->
 			<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#web_modal">
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
				<table class="table table-borderless table-hover" id="web_table">
					<thead class="table-secondary text-dark font-weight-bold">
						<tr class="bg-secondary text-white">
							<th>ID</th>
							<th>Image</th>
							<th>Name</th>
							<th>Action</th>
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
 <div class="modal fade" id="web_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
 	<div class="modal-dialog">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h5 class="modal-title" id="exampleModalLabel">Add Data </h5>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">

 				<form action="" method="post" id="web_add_form" accept-charset="utf-8">

					<div class="custom-file my-4">
						<input type="file" name="file" class="custom-file-input" id="web_img">
						<label class="custom-file-label" for="customFile"> Choose File </label>
					</div>

 					<div class="form-group">
 						<label for="web_name">Header</label>
 						<input type="text" name="name" class="form-control" id="web_name">
 					</div>

 					<!-- <div class="form-group">
 						<label for="about_content">Content</label>
 						<input type="text" name="content" class="form-control" id="about_content">
 					</div> -->

					<div class="modal-footer">
		 				<button type="button" class="btn btn-primary" id="web_add">Add</button>
		 				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 					</div>
 				</form>
 			</div>
 			
 		</div>
 	</div>
 </div>

<!---------------------------------------- edit modal  -------------------------------------->

 <!-- Modal -->
 <div class="modal fade" id="edit_web_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
 	<div class="modal-dialog">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h5 class="modal-title" id="exampleModalLabel">Edit Data </h5>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">

 				<div class="row text-center">
					<div class="col-md-12 my-3">
						<div id="show_web_img"></div>
					</div>
				</div>

 				<form action="" method="post" id="web_edit_form" accept-charset="utf-8">
 					<input type="hidden" id="edit_web_id">

					<div class="custom-file my-4">
						<input type="file" class="custom-file-input" id="edit_web_img">
						<label class="custom-file-label" for="customFile"> Choose File </label>
					</div>

 					<div class="form-group">
 						<label for="edit_web_name">Header</label>
 						<input type="text" name="name" class="form-control" id="edit_web_name">
 					</div>

 					<!-- <div class="form-group">
 						<label for="edit_about_content">Content</label>
 						<input type="text" name="content" class="form-control" id="edit_about_content">
 					</div> -->

					<div class="modal-footer">
		 				<button type="button" class="btn btn-outline-primary" id="web_update"> Update</button>
		 				<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
		 			</div>
 				</form>
 			</div>
 		</div>
 	</div>
 </div>




	<!-- base_url  -->
	<input type="hidden" value="<?php echo base_url(); ?>" id="base_url" />