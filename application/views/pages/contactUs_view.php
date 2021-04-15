 <!-- Begin Page Content -->
 <div class="container-fluid">
 	<div class="row">
 		<div class="col-lg-10">
 			<!-- Page Heading -->
 			<h1 class="h3 mb-4 text-gray-800">Customer Feedback</h1>
 		</div>

 		<!-- <div class="col-lg-2"> -->
 			<!-- Button trigger modal -->
 		<!-- 	<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#customer_feedback">
 				Add New
 			</button>
 		</div> -->
 	</div>
 </div>

 <hr>
 <!-- /.container-fluid -->


<!-- data table -->

<div class="container-fluid my-5">
	<div class="row">
		<div class="col-md-12 mx-auto">
			<div class="table-responsive">
				<table class="table table-borderless table-hover" id="contactUs_table">
					<thead class="table-secondary text-dark font-weight-bold">
						<tr class="bg-secondary text-white">
							<th>ID</th>
							<th>Customer Name</th>
							<th>Customer Email</th>
							<th>Subject</th>
							<th>Message</th>
							<th>Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- end table -->


	<!-- base_url  -->
	<input type="hidden" value="<?php echo base_url(); ?>" id="base_url" />

<!-- end -->