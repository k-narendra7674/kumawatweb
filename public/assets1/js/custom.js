
/*----------------------------------------------------------------------------*/
/* -------------------- Bootstrap Custom File Input Label ------------------- */
/*----------------------------------------------------------------------------*/


$('.custom-file-input').on('change', function(){
	let fileName = $(this).val().split('\\').pop();
	let label = $(this).siblings('.custom-file-label');

	if (label.data('default-title') === undefined) {
		label.data('default-title', label.html());
	}

	if (fileName === '') {
		label.removeClass('selected').html(label.data('default-title'));
	}else{
		label.addClass('selected').html(fileName);
	}
});


/*--------------------------- Add Record Modal ---------------------------------------*/

$('#mobileModal').on('hide.bs.modal', function(e){
	$('#mobileAddForm')[0].reset();
	$('.custom-file-label').html('Choose file');
});


/* ---------------------------- Edit Record Modal --------------------------- */

$("#editRecords").on("hide.bs.modal", function (e) {
    // do something...
    $("#edit_category")[0].reset();
    $(".custom-file-label").html("Choose file");
});


/* --------------------------------- Baseurl -------------------------------- */

var baseUrl = $("#base_url").val();


/*----------------------------------------------------------------------------*/
/* -------------------- Mobile function ----------------------------------- */
/*                        Insert Records           		                      */
/* -------------------------------------------------------------------------- */



$(document).on('click', '#mobileAdd', function(e){
	e.preventDefault();







	var img = $('#mobileImg')[0].files[0];
	var name = $('#mobileHeader').val();
	var content = $('#mobileContent').val();

	if(name == "" || content == ""){
		toastr["success"]('all field are required');
	}
	else
	{
		var fd = new FormData();

		fd.append("img", img);
		fd.append("name", name);
		fd.append("content", content);

		$.ajax({
			type: 'POST',
			url: baseUrl + 'addMobile',
			contentType: false,
			processData: false,
			dataType: 'json',
			data: fd,
			async: true,
			success:function(data){
				if (data.result == 'success') 
				{
					toastr["success"](data.message);
					$('#mobileModal').modal('hide');
					$('#mobileAddForm')[0].reset();
					$('.add-file-lable').html('Choose file');
					$('#mobileTable').DataTable().destroy();
					fetchMobile();
				}
				else
				{
					toastr["error"](data.message);
				}

			},

		});
	}
});

/* -------------------------------------------------------------------------- */
/*                                Fetch Records                               */
/* -------------------------------------------------------------------------- */

function fetchMobile(){
	
	$.ajax({
		url: baseUrl + 'fetchMobile',
		type: 'get',
		dataType: 'json',
		processData: false,
		contentType:  "application/json; charset=utf-8",
		async: true,
		cache: false,
		success: function(response){

			var i = '1';
			$('#mobileTable').DataTable({
				data: response,
				responsive: true,
				// dom:"<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B> col-sm-12 col-md-4'f>" +
				// 	"<'row'<'col-sm-12'tr>>" +
				// 	"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
				// buttons: ['copy', 'excel', 'pdf'],
				columns: [{
					data: 'id',
					render: function( data, type, row, meta ){
						return i++;
					},
				},
				{data: 'img',
				render: function(data, type, row, meta){
					var a = `
					<img src="${baseUrl}public/uploads/${row.img}"
					width="50" height="50" />
					`;
					return a;
				},
			},
			{data: 'name',},
			{data: 'content',},
			{
				orderable: false,
				searchable: false,
				data: function(row, type, set){
					return `
					<a href="#" value="${row.id}" id="mobileEdit" class="btn btn-sm btn-outline-info">
					<i class="fas fa-pen-alt"></i></a>
					<a href="#" value="${row.id}" id="mobileDel" class="btn btn-sm btn-outline-danger">
					<i class="fas fa-eraser"></i></a>
					`;
				},
			},
			],
		});		
		},
	});
}

fetchMobile();


/* -------------------------------------------------------------------------- */
/*                               Delete Records                               */
/* -------------------------------------------------------------------------- */

$(document).on('click', '#mobileDel', function(e){
	e.preventDefault();

	var del_id = $(this).attr('value');

	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger mr-2'
		},
		buttonsStyling: false
	});

	Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		reverseButtons: true,
		confirmButtonText: 'Yes, delete it!',

	}).then((result) => {
		if (result.isConfirmed) {

			$.ajax({
				type: 'post',
				url: baseUrl + 'delMobile',
				dataType: 'json',
				data: {del_id: del_id,},
				success: function(data){
					if (data.result == 'success') {
						Swal.fire(
							'Deleted!',
							'Your file has been deleted.',
							'success'
							);
						$('#mobileTable').DataTable().destroy();
						fetchMobile();
					}
				},
			});
		}
	});
});


/* -------------------------------------------------------------------------- */
/*                                Edit Records                                */
/* -------------------------------------------------------------------------- */

$(document).on('click', '#mobileEdit', function(e){
	e.preventDefault();

	var edit_id = $(this).attr('value');
	$.ajax({
		type: 'get',
		url: baseUrl + 'editMobile',
		dataType: 'json',
		data: {edit_id: edit_id},
		success: function(data){
			if (data.result === 'success')
			{
				$('#editMobileModal').modal('show');
				$('#editMobileId').val(data.post.id);
				$("#showMobileImg").html(`
					<img src="${baseUrl}public/uploads/${data.post.img}"
					width="100" height="100" class="rounded img-thumbnail">
					`);
				$('#editMobileName').val(data.post.name);
				$('#editMobileContent').val(data.post.content);
			}
			else
			{
				toastr["error"](data.message, 'Error');
			}
		},
	});
});


/* -------------------------------------------------------------------------- */
/*                               Update Records                               */
/* -------------------------------------------------------------------------- */

$(document).on('click', '#mobileUpdate', function(e){
	e.preventDefault();

	var edit_id = $('#editMobileId').val();
	var name = $('#editMobileName').val();
	var content = $('#editMobileContent').val();
	var editMobileImg = $('#editMobileImg')[0].files[0];

	if (name == "" || content == "") {
		toastr["error"]('All field are required');
	}
	else
	{
		var fd = new FormData();

		fd.append('edit_id', edit_id);
		if ($('#editMobileImg')[0].files.length > 0) 
		{
			fd.append('editMobileImg', editMobileImg);
		}
		fd.append('name', name);
		fd.append('content', content);

		$.ajax({
			type: 'POST',
			url: baseUrl + 'updateMobile',
			dataType: 'json',
			contentType: false,
			processData: false,
			data: fd,
			async: true,
			success: function(response){
				if (response.result === 'success') 
				{
					toastr["success"](response.message);
					$('#editMobileModal').modal('hide');
					$('#editMobileForm')[0].reset();
					$('.edit_file_label').html('Choose file');
					$('#mobileTable').DataTable().destroy();
					fetchMobile();
				}
				else
				{
					toastr["error"](response.message);
				}
			},

		});
	}
});

// end of 


/*--------------------------- Add Record Modal ---------------------------------------*/

$('#about_modal').on('hide.bs.modal', function(e){
	$('#about_add_form')[0].reset();
	$('.custom-file-label').html('Choose file');
});


/* ---------------------------- Edit Record Modal --------------------------- */

$("#edit_about_modal").on("hide.bs.modal", function (e) {
    // do something...
    $("#about_edit_form")[0].reset();
    $(".custom-file-label").html("Choose file");
});


/* --------------------------------- Baseurl -------------------------------- */

var baseUrl = $("#base_url").val();


/*----------------------------------------------------------------------------*/
/* -------------------- About function ----------------------------------- */
/*                        Insert Records           		                      */
/* -------------------------------------------------------------------------- */


$(document).on('click', '#about_add', function(e){
	e.preventDefault();

	var img = $('#about_img')[0].files[0];
	var name = $('#about_header').val();
	var content = $('#about_content').val();

	if(name == "" || content == ""){
		toastr["error"]('all field are required');
	}
	else
	{
		var fd = new FormData();

		fd.append("img", img);
		fd.append("name", name);
		fd.append("content", content);

		$.ajax({
			type: 'POST',
			url: baseUrl + 'addAbout',
			contentType: false,
			processData: false,
			dataType: 'json',
			data: fd,
			async: true,
			success:function(data){
				if (data.result == 'success') 
				{
					toastr["success"](data.message);
					$('#about_modal').modal('hide');
					$('#about_add_form')[0].reset();
					$('.add-file-lable').html('Choose file');
					$('#about_table').DataTable().destroy();
					fetchAbout();
				}
				else
				{
					toastr["error"](data.message);
				}

			},

		});
	}
});

/* -------------------------------------------------------------------------- */
/*                                Fetch Records                               */
/* -------------------------------------------------------------------------- */

function fetchAbout(){
	
	$.ajax({
		url: baseUrl + 'fetchAbout',
		type: 'get',
		dataType: 'json',
		processData: false,
		contentType:  "application/json; charset=utf-8",
		async: true,
		cache: false,
		success: function(response){

			var i = '1';
			$('#about_table').DataTable({
				data: response,
				responsive: true,
				// dom:"<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B> col-sm-12 col-md-4'f>" +
				// 	"<'row'<'col-sm-12'tr>>" +
				// 	"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
				// buttons: ['copy', 'excel', 'pdf'],
				columns: [{
					data: 'id',
					render: function( data, type, row, meta ){
						return i++;
					},
				},
				{data: 'img',
				render: function(data, type, row, meta){
					var a = `
					<img src="${baseUrl}public/uploads/${row.img}"
					width="50" height="50" />
					`;
					return a;
				},
			},
			{data: 'name',},
			{data: 'content',},
			{
				orderable: false,
				searchable: false,
				data: function(row, type, set){
					return `
					<a href="#" value="${row.id}" id="aboutEdit" class="btn btn-sm btn-outline-info">
					<i class="fas fa-pen-alt"></i></a>
					<a href="#" value="${row.id}" id="aboutDel" class="btn btn-sm btn-outline-danger">
					<i class="fas fa-eraser"></i></a>
					`;
				},
			},
			],
		});		
		},
	});
}

fetchAbout();


/* -------------------------------------------------------------------------- */
/*                               Delete Records                               */
/* -------------------------------------------------------------------------- */

$(document).on('click', '#aboutDel', function(e){
	e.preventDefault();

	var del_id = $(this).attr('value');

	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger mr-2'
		},
		buttonsStyling: false
	});

	Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		reverseButtons: true,
		confirmButtonText: 'Yes, delete it!',

	}).then((result) => {
		if (result.isConfirmed) {

			$.ajax({
				type: 'post',
				url: baseUrl + 'delAbout',
				dataType: 'json',
				data: {del_id: del_id,},
				success: function(data){
					if (data.result == 'success') {
						Swal.fire(
							'Deleted!',
							'Your file has been deleted.',
							'success'
							);
						$('#about_table').DataTable().destroy();
						fetchAbout();
					}
				},
			});
		}
	});
});


/* -------------------------------------------------------------------------- */
/*                                Edit Records                                */
/* -------------------------------------------------------------------------- */

$(document).on('click', '#aboutEdit', function(e){
	e.preventDefault();

	var edit_id = $(this).attr('value');
	$.ajax({
		type: 'get',
		url: baseUrl + 'editAbout',
		dataType: 'json',
		data: {edit_id: edit_id},
		success: function(data){
			if (data.result === 'success')
			{
				$('#edit_about_modal').modal('show');
				$('#edit_about_id').val(data.post.id);
				$("#show_about_img").html(`
					<img src="${baseUrl}public/uploads/${data.post.img}"
					width="100" height="100" class="rounded img-thumbnail">
					`);
				$('#edit_about_header').val(data.post.name);
				$('#edit_about_content').val(data.post.content);
			}
			else
			{
				toastr["error"](data.message, 'Error');
			}
		},
	});
});


/* -------------------------------------------------------------------------- */
/*                               Update Records                               */
/* -------------------------------------------------------------------------- */

$(document).on('click', '#about_update', function(e){
	e.preventDefault();


	var edit_id = $('#edit_about_id').val();
	var edit_about_img = $('#edit_about_img')[0].files[0];
	var name = $('#edit_about_header').val();
	var content = $('#edit_about_content').val();

	if (name == "" || content == "") {
		toastr["error"]('All field are required');
	}
	else
	{
		var fd = new FormData();

		fd.append('edit_id', edit_id);
		if ($('#edit_about_img')[0].files.length > 0) 
		{
			fd.append('edit_about_img', edit_about_img);
		}
		fd.append('name', name);
		fd.append('content', content);

		$.ajax({
			type: 'POST',
			url: baseUrl + 'updateAbout',
			dataType: 'json',
			contentType: false,
			processData: false,
			data: fd,
			async: true,
			success: function(response){
				if (response.result === 'success') 
				{
					toastr["success"](response.message);
					$('#edit_about_modal').modal('hide');
					$('#about_edit_form')[0].reset();
					$('.edit_file_label').html('Choose file');
					$('#about_table').DataTable().destroy();
					fetchAbout();
				}
				else
				{
					toastr["error"](response.message);
				}
			},

		});
	}
});

// end of 


/*--------------------------- Add Record Modal ---------------------------------------*/

$('#service_modal').on('hide.bs.modal', function(e){
	$('#service_add_form')[0].reset();
	$('.custom-file-label').html('Choose file');
});


/* ---------------------------- Edit Record Modal --------------------------- */

$("#edit_service_modal").on("hide.bs.modal", function (e) {
    // do something...
    $("#service_edit_form")[0].reset();
    $(".custom-file-label").html("Choose file");
});


/* --------------------------------- Baseurl -------------------------------- */

var baseUrl = $("#base_url").val();


/*----------------------------------------------------------------------------*/
/* 						 Service function 									  */
/*                        Insert Records           		                      */
/* -------------------------------------------------------------------------- */

function addService(){
	$(document).on('click', '#service_add', function(e){
		e.preventDefault();

		var name = $('#service_header').val();
		var content = $('#service_content').val();

		if (name == '' || content == '') {
			toastr['error']('all field are required');
		}
		else
		{
			var fd = new FormData();

			fd.append('name', name);
			fd.append('content', content);


			$.ajax({
				type: 'POST',
				url: baseUrl + 'addService',
				contentType: false,
				processData: false,
				dataType: 'json',
				data: fd,
				async: true,
				success:function(data){
					if (data.result == 'success') {
						toastr['success'](data.message);
						$('#service_modal').modal('hide');
						$('#service_add_form')[0].reset();
						$('#service_table').DataTable().destroy();
						fetchService();
					}else{
						toastr['error'](data.message);
					}			
				}
			});
		}

	});
}
addService();

/* -------------------------------------------------------------------------- */
/*                                Fetch Records                               */
/* -------------------------------------------------------------------------- */

function fetchService(){
	$.ajax({
		type: 'get',
		url: baseUrl + 'fetchService',
		dataType: 'json',
		processData: false,
		contentType:  "application/json; charset=utf-8",
		async: true,
		cache: false,
		success: function(response){
			var i = '1';
			$('#service_table').DataTable({
				data: response,
				responsive: true,
				columns: [{
					data: 'id',
					render: function(data, type, row, meta){
						return i++;
					},
				},
				{data: 'name'},
				{data: 'content'},
				{
					orderable:false,
					searchable: false,
					data: function(row, type, set){
						return `
						<a href="#" value="${row.id}" id="service_edit" class="btn btn-outline-info">
						<i class="fas fa-pen-alt"></i></a>
						<a href="#" value="${row.id}" id="service_del" class="btn btn-outline-danger">
						<i class="fas fa-eraser"></i></a>
						`;
					},
				},
				],
			});
		}
	})
}
fetchService();

/* -------------------------------------------------------------------------- */
/*                               Delete Records                               */
/* -------------------------------------------------------------------------- */

$(document).on('click', '#service_del', function(e){
	e.preventDefault();
	var del_id = $(this).attr('value');

	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger mr-2'
		},
		buttonsStyling: false
	});

	Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		reverseButtons: true,
		confirmButtonText: 'Yes, delete it!',

	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				type: 'POST',
				url: baseUrl + 'delService',
				dataType: 'JSON',
				data: {del_id: del_id,},
				success: function(data){
					if (data.result == 'success') {
						Swal.fire(
							'Deleted!',
							'Your file has been deleted.',
							'success'
							);
						$('#service_table').DataTable().destroy();
						fetchService();
					}
				},
			});
		}
	});
});

/* -------------------------------------------------------------------------- */
/*                                Edit Records                                */
/* -------------------------------------------------------------------------- */

$(document).on('click', '#service_edit', function(e){
	e.preventDefault();

	var edit_id = $(this).attr('value');

	$.ajax({
		type: 'get',
		url: baseUrl + 'editService',
		dataType: 'json',
		data: {edit_id: edit_id},
		success: function(data){
			if (data.result == 'success')
			{
				$('#edit_service_modal').modal('show');
				$('#edit_service_id').val(data.post.id);
				$('#edit_service_header').val(data.post.name);
				$('#edit_service_content').val(data.post.content);
			}
			else
			{
				toastr["error"](data.message, 'Error');
			}
		}
	});
});

/* -------------------------------------------------------------------------- */
/*                               Update Records                               */
/* -------------------------------------------------------------------------- */

$(document).on('click', '#service_update', function(e){
	e.preventDefault();

	var edit_id = $('#edit_service_id').val();
	var name = $('#edit_service_header').val();
	var content = $('#edit_service_content').val();

	if (name == "" || content == "")
	{
		toastr["error"]('All field are required');
	}
	else
	{
		var fd = new FormData();

		fd.append('edit_id', edit_id);
		fd.append('name', name)
		fd.append('content', content)

		$.ajax({
			type: 'post',
			url: baseUrl + 'updateService',
			dataType: 'json',
			processData: false,
			contentType: false,
			data: fd,
			async: true,
			success: function(data){
				if (data.result === 'success') 
				{
					toastr["success"](data.message);
					$('#edit_service_modal').modal('hide');
					$('#service_edit_form')[0].reset();
					$('#service_table').DataTable().destroy();
					fetchService();
				}
				else
				{
					toastr["error"](data.message);
				}
			}
		});
	}
});

// end of


/*--------------------------- Add Record Modal ---------------------------------------*/

$('#app_modal').on('hide.bs.modal', function(e){
	$('#app_add_form')[0].reset();
	$('.custom-file-label').html('Choose file');
});


/* ---------------------------- Edit Record Modal --------------------------- */

$("#edit_app_modal").on("hide.bs.modal", function (e) {
    // do something...
    $("#app_edit_form")[0].reset();
    $(".custom-file-label").html("Choose file");
});


/* --------------------------------- Baseurl -------------------------------- */

var baseUrl = $("#base_url").val();


/*----------------------------------------------------------------------------*/
/* -------------------- app function ----------------------------------- */
/*                        Insert Records           		                      */
/* -------------------------------------------------------------------------- */


$(document).on('click', '#app_add', function(e){
	e.preventDefault();

	var img = $('#app_img')[0].files[0];
	var name = $('#app_name').val();

	if(name == "" || img == ""){
		toastr["error"]('all field are required');
	}
	else
	{
		var fd = new FormData();
		fd.append("img", img);
		fd.append("name", name);

		$.ajax({
			type: 'POST',
			url: baseUrl + 'addApp',
			contentType: false,
			processData: false,
			dataType: 'json',
			data: fd,
			async: true,
			success:function(data){
				if (data.result == 'success') 
				{
					toastr["success"](data.message);
					$('#app_modal').modal('hide');
					$('#app_add_form')[0].reset();
					$('.add-file-lable').html('Choose file');
					$('#app_table').DataTable().destroy();
					fetchApp();
				}
				else
				{
					toastr["error"](data.message);
				}

			},

		});
	}
});

/* -------------------------------------------------------------------------- */
/*                                Fetch Records                               */
/* -------------------------------------------------------------------------- */

function fetchApp(){
	
	$.ajax({
		url: baseUrl + 'fetchApp',
		type: 'get',
		dataType: 'json',
		processData: false,
		contentType:  "application/json; charset=utf-8",
		async: true,
		cache: false,
		success: function(response){

			var i = '1';
			$('#app_table').DataTable({
				data: response,
				responsive: true,
				// dom:"<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B> col-sm-12 col-md-4'f>" +
				// 	"<'row'<'col-sm-12'tr>>" +
				// 	"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
				// buttons: ['copy', 'excel', 'pdf'],
				columns: [{
					data: 'app_id',
					render: function( data, type, row, meta ){
						return i++;
					},
				},
				{data: 'img',
				render: function(data, type, row, meta){
					var a = `
					<img src="${baseUrl}public/uploads/apps/${row.img}"
					width="50" height="50" />
					`;
					return a;
				},
			},
			{data: 'name',},
			{
				orderable: false,
				searchable: false,
				data: function(row, type, set){
					return `
					<a href="#" value="${row.app_id}" id="appEdit" class="btn btn-sm btn-outline-info">
					<i class="fas fa-pen-alt"></i></a>
					<a href="#" value="${row.app_id}" id="appDel" class="btn btn-sm btn-outline-danger">
					<i class="fas fa-eraser"></i></a>
					`;
				},
			},
			],
		});		
		},
	});
}

fetchApp();


/* -------------------------------------------------------------------------- */
/*                               Delete Records                               */
/* -------------------------------------------------------------------------- */

$(document).on('click', '#appDel', function(e){
	e.preventDefault();

	var del_id = $(this).attr('value');

	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger mr-2'
		},
		buttonsStyling: false
	});

	Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		reverseButtons: true,
		confirmButtonText: 'Yes, delete it!',

	}).then((result) => {
		if (result.isConfirmed) {

			$.ajax({
				type: 'post',
				url: baseUrl + 'delApp',
				dataType: 'json',
				data: {del_id: del_id,},
				success: function(data){
					if (data.result == 'success') {
						Swal.fire(
							'Deleted!',
							'Your file has been deleted.',
							'success'
							);
						$('#app_table').DataTable().destroy();
						fetchApp();
					}
				},
			});
		}
	});
});


/* -------------------------------------------------------------------------- */
/*                                Edit Records                                */
/* -------------------------------------------------------------------------- */

$(document).on('click', '#appEdit', function(e){
	e.preventDefault();

	var edit_id = $(this).attr('value');
	$.ajax({
		type: 'get',
		url: baseUrl + 'editApp',
		dataType: 'json',
		data: {edit_id: edit_id},
		success: function(data){
			if (data.result === 'success')
			{
				$('#edit_app_modal').modal('show');
				$('#edit_app_id').val(data.post.app_id);
				$("#show_app_img").html(`
					<img src="${baseUrl}public/uploads/apps/${data.post.img}"
					width="100" height="100" class="rounded img-thumbnail">
					`);
				$('#edit_app_name').val(data.post.name);
			}
			else
			{
				toastr["error"](data.message, 'Error');
			}
		},
	});
});


/* -------------------------------------------------------------------------- */
/*                               Update Records                               */
/* -------------------------------------------------------------------------- */

$(document).on('click', '#app_update', function(e){
	e.preventDefault();

	var edit_id = $('#edit_app_id').val();
	var edit_app_img = $('#edit_app_img')[0].files[0];
	var name = $('#edit_app_name').val();

	if (name == "" || edit_app_img == "") {
		toastr["error"]('All field are required');
	}
	else
	{
		var fd = new FormData();

		fd.append('edit_id', edit_id);
		if ($('#edit_app_img')[0].files.length > 0) 
		{
			fd.append('edit_app_img', edit_app_img);
		}
		fd.append('name', name);

		$.ajax({
			type: 'POST',
			url: baseUrl + 'updateApp',
			dataType: 'json',
			contentType: false,
			processData: false,
			data: fd,
			async: true,
			success: function(response){
				if (response.result === 'success') 
				{
					toastr["success"](response.message);
					$('#edit_app_modal').modal('hide');
					$('#app_edit_form')[0].reset();
					$('.edit_file_label').html('Choose file');
					$('#app_table').DataTable().destroy();
					fetchApp();
				}
				else
				{
					toastr["error"](response.message);
				}
			},

		});
	}
});

// end of 


/*--------------------------- Add Record Modal ---------------------------------------*/

$('#card_modal').on('hide.bs.modal', function(e){
	$('#card_add_form')[0].reset();
	$('.custom-file-label').html('Choose file');
});


/* ---------------------------- Edit Record Modal --------------------------- */

$("#edit_card_modal").on("hide.bs.modal", function (e) {
    // do something...
    $("#card_edit_form")[0].reset();
    $(".custom-file-label").html("Choose file");
});


/* --------------------------------- Baseurl -------------------------------- */

var baseUrl = $("#base_url").val();


/*----------------------------------------------------------------------------*/
/* -------------------- card function ----------------------------------- */
/*                        Insert Records           		                      */
/* -------------------------------------------------------------------------- */


$(document).on('click', '#card_add', function(e){
	e.preventDefault();

	var img = $('#card_img')[0].files[0];
	var name = $('#card_name').val();

	if(name == "" || img == ""){
		toastr["error"]('all field are required');
	}
	else
	{
		var fd = new FormData();
		fd.append("img", img);
		fd.append("name", name);

		$.ajax({
			type: 'POST',
			url: baseUrl + 'addCard',
			contentType: false,
			processData: false,
			dataType: 'json',
			data: fd,
			async: true,
			success:function(data){
				if (data.result == 'success') 
				{
					toastr["success"](data.message);
					$('#card_modal').modal('hide');
					$('#card_add_form')[0].reset();
					$('.add-file-lable').html('Choose file');
					$('#card_table').DataTable().destroy();
					fetchCard();
				}
				else
				{
					toastr["error"](data.message);
				}

			},

		});
	}
});

/* -------------------------------------------------------------------------- */
/*                                Fetch Records                               */
/* -------------------------------------------------------------------------- */

function fetchCard(){
	
	$.ajax({
		url: baseUrl + 'fetchCard',
		type: 'get',
		dataType: 'json',
		processData: false,
		contentType:  "application/json; charset=utf-8",
		async: true,
		cache: false,
		success: function(response){

			var i = '1';
			$('#card_table').DataTable({
				data: response,
				responsive: true,
				// dom:"<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B> col-sm-12 col-md-4'f>" +
				// 	"<'row'<'col-sm-12'tr>>" +
				// 	"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
				// buttons: ['copy', 'excel', 'pdf'],
				columns: [{
					data: 'card_id',
					render: function( data, type, row, meta ){
						return i++;
					},
				},
				{data: 'img',
				render: function(data, type, row, meta){
					var a = `
					<img src="${baseUrl}public/uploads/cards/${row.img}"
					width="50" height="50" />
					`;
					return a;
				},
			},
			{data: 'name',},
			{
				orderable: false,
				searchable: false,
				data: function(row, type, set){
					return `
					<a href="#" value="${row.card_id}" id="cardEdit" class="btn btn-sm btn-outline-info">
					<i class="fas fa-pen-alt"></i></a>
					<a href="#" value="${row.card_id}" id="cardDel" class="btn btn-sm btn-outline-danger">
					<i class="fas fa-eraser"></i></a>
					`;
				},
			},
			],
		});		
		},
	});
}

fetchCard();


/* -------------------------------------------------------------------------- */
/*                               Delete Records                               */
/* -------------------------------------------------------------------------- */

$(document).on('click', '#cardDel', function(e){
	e.preventDefault();

	var del_id = $(this).attr('value');

	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger mr-2'
		},
		buttonsStyling: false
	});

	Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		reverseButtons: true,
		confirmButtonText: 'Yes, delete it!',

	}).then((result) => {
		if (result.isConfirmed) {

			$.ajax({
				type: 'post',
				url: baseUrl + 'delCard',
				dataType: 'json',
				data: {del_id: del_id,},
				success: function(data){
					if (data.result == 'success') {
						Swal.fire(
							'Deleted!',
							'Your file has been deleted.',
							'success'
							);
						$('#card_table').DataTable().destroy();
						fetchCard();
					}
				},
			});
		}
	});
});


/* -------------------------------------------------------------------------- */
/*                                Edit Records                                */
/* -------------------------------------------------------------------------- */

$(document).on('click', '#cardEdit', function(e){
	e.preventDefault();

	var edit_id = $(this).attr('value');
	$.ajax({
		type: 'get',
		url: baseUrl + 'editCard',
		dataType: 'json',
		data: {edit_id: edit_id},
		success: function(data){
			if (data.result === 'success')
			{
				$('#edit_card_modal').modal('show');
				$('#edit_card_id').val(data.post.card_id);
				$("#show_card_img").html(`
					<img src="${baseUrl}public/uploads/cards/${data.post.img}"
					width="100" height="100" class="rounded img-thumbnail">
					`);
				$('#edit_card_name').val(data.post.name);
			}
			else
			{
				toastr["error"](data.message, 'Error');
			}
		},
	});
});


/* -------------------------------------------------------------------------- */
/*                               Update Records                               */
/* -------------------------------------------------------------------------- */

$(document).on('click', '#card_update', function(e){
	e.preventDefault();

	var edit_id = $('#edit_card_id').val();
	var edit_card_img = $('#edit_card_img')[0].files[0];
	var name = $('#edit_card_name').val();

	if (name == "" || edit_card_img == "") {
		toastr["error"]('All field are required');
	}
	else
	{
		var fd = new FormData();

		fd.append('edit_id', edit_id);
		if ($('#edit_card_img')[0].files.length > 0) 
		{
			fd.append('edit_card_img', edit_card_img);
		}
		fd.append('name', name);

		$.ajax({
			type: 'POST',
			url: baseUrl + 'updateCard',
			dataType: 'json',
			contentType: false,
			processData: false,
			data: fd,
			async: true,
			success: function(response){
				if (response.result === 'success') 
				{
					toastr["success"](response.message);
					$('#edit_card_modal').modal('hide');
					$('#card_edit_form')[0].reset();
					$('.edit_file_label').html('Choose file');
					$('#card_table').DataTable().destroy();
					fetchCard();
				}
				else
				{
					toastr["error"](response.message);
				}
			},

		});
	}
});

// end of 


/*--------------------------- Add Record Modal ---------------------------------------*/

$('#web_modal').on('hide.bs.modal', function(e){
	$('#web_add_form')[0].reset();
	$('.custom-file-label').html('Choose file');
});


/* ---------------------------- Edit Record Modal --------------------------- */

$("#edit_web_modal").on("hide.bs.modal", function (e) {
    // do something...
    $("#web_edit_form")[0].reset();
    $(".custom-file-label").html("Choose file");
});


/* --------------------------------- Baseurl -------------------------------- */

var baseUrl = $("#base_url").val();


/*----------------------------------------------------------------------------*/
/* -------------------- web function ----------------------------------- */
/*                        Insert Records           		                      */
/* -------------------------------------------------------------------------- */


$(document).on('click', '#web_add', function(e){
	e.preventDefault();

	var img = $('#web_img')[0].files[0];
	var name = $('#web_name').val();

	if(name == "" || img == ""){
		toastr["error"]('all field are required');
	}
	else
	{
		var fd = new FormData();
		fd.append("img", img);
		fd.append("name", name);

		$.ajax({
			type: 'POST',
			url: baseUrl + 'addWeb',
			contentType: false,
			processData: false,
			dataType: 'json',
			data: fd,
			async: true,
			success:function(data){
				if (data.result == 'success') 
				{
					toastr["success"](data.message);
					$('#web_modal').modal('hide');
					$('#web_add_form')[0].reset();
					$('.add-file-lable').html('Choose file');
					$('#web_table').DataTable().destroy();
					fetchWeb();
				}
				else
				{
					toastr["error"](data.message);
				}

			},

		});
	}
});

/* -------------------------------------------------------------------------- */
/*                                Fetch Records                               */
/* -------------------------------------------------------------------------- */

function fetchWeb(){
	
	$.ajax({
		url: baseUrl + 'fetchWeb',
		type: 'get',
		dataType: 'json',
		processData: false,
		contentType:  "application/json; charset=utf-8",
		async: true,
		cache: false,
		success: function(response){

			var i = '1';
			$('#web_table').DataTable({
				data: response,
				responsive: true,
				// dom:"<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B> col-sm-12 col-md-4'f>" +
				// 	"<'row'<'col-sm-12'tr>>" +
				// 	"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
				// buttons: ['copy', 'excel', 'pdf'],
				columns: [{
					data: 'web_id',
					render: function( data, type, row, meta ){
						return i++;
					},
				},
				{data: 'img',
				render: function(data, type, row, meta){
					var a = `
					<img src="${baseUrl}public/uploads/webs/${row.img}"
					width="50" height="50" />
					`;
					return a;
				},
			},
			{data: 'name',},
			{
				orderable: false,
				searchable: false,
				data: function(row, type, set){
					return `
					<a href="#" value="${row.web_id}" id="webEdit" class="btn btn-sm btn-outline-info">
					<i class="fas fa-pen-alt"></i></a>
					<a href="#" value="${row.web_id}" id="webDel" class="btn btn-sm btn-outline-danger">
					<i class="fas fa-eraser"></i></a>
					`;
				},
			},
			],
		});		
		},
	});
}

fetchWeb();


/* -------------------------------------------------------------------------- */
/*                               Delete Records                               */
/* -------------------------------------------------------------------------- */

$(document).on('click', '#webDel', function(e){
	e.preventDefault();

	var del_id = $(this).attr('value');

	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger mr-2'
		},
		buttonsStyling: false
	});

	Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		reverseButtons: true,
		confirmButtonText: 'Yes, delete it!',

	}).then((result) => {
		if (result.isConfirmed) {

			$.ajax({
				type: 'post',
				url: baseUrl + 'delWeb',
				dataType: 'json',
				data: {del_id: del_id,},
				success: function(data){
					if (data.result == 'success') {
						Swal.fire(
							'Deleted!',
							'Your file has been deleted.',
							'success'
							);
						$('#web_table').DataTable().destroy();
						fetchWeb();
					}
				},
			});
		}
	});
});


/* -------------------------------------------------------------------------- */
/*                                Edit Records                                */
/* -------------------------------------------------------------------------- */

$(document).on('click', '#webEdit', function(e){
	e.preventDefault();

	var edit_id = $(this).attr('value');
	$.ajax({
		type: 'get',
		url: baseUrl + 'editWeb',
		dataType: 'json',
		data: {edit_id: edit_id},
		success: function(data){
			if (data.result === 'success')
			{
				$('#edit_web_modal').modal('show');
				$('#edit_web_id').val(data.post.web_id);
				$("#show_web_img").html(`
					<img src="${baseUrl}public/uploads/webs/${data.post.img}"
					width="100" height="100" class="rounded img-thumbnail">
					`);
				$('#edit_web_name').val(data.post.name);
			}
			else
			{
				toastr["error"](data.message, 'Error');
			}
		},
	});
});


/* -------------------------------------------------------------------------- */
/*                               Update Records                               */
/* -------------------------------------------------------------------------- */

$(document).on('click', '#web_update', function(e){
	e.preventDefault();

	var edit_id = $('#edit_web_id').val();
	var edit_web_img = $('#edit_web_img')[0].files[0];
	var name = $('#edit_web_name').val();

	if (name == "" || edit_web_img == "") {
		toastr["error"]('All field are required');
	}
	else
	{
		var fd = new FormData();

		fd.append('edit_id', edit_id);
		if ($('#edit_web_img')[0].files.length > 0) 
		{
			fd.append('edit_web_img', edit_web_img);
		}
		fd.append('name', name);

		$.ajax({
			type: 'POST',
			url: baseUrl + 'updateWeb',
			dataType: 'json',
			contentType: false,
			processData: false,
			data: fd,
			async: true,
			success: function(response){
				if (response.result === 'success') 
				{
					toastr["success"](response.message);
					$('#edit_web_modal').modal('hide');
					$('#web_edit_form')[0].reset();
					$('.edit_file_label').html('Choose file');
					$('#web_table').DataTable().destroy();
					fetchWeb();
				}
				else
				{
					toastr["error"](response.message);
				}
			},

		});
	}
});

// end of 



/*--------------------------- Add Record Modal ---------------------------------------*/

$('#team_modal').on('hide.bs.modal', function(e){
	$('#team_add_form')[0].reset();
	$('.custom-file-label').html('Choose file');
});


/* ---------------------------- Edit Record Modal --------------------------- */

$("#edit_team_modal").on("hide.bs.modal", function (e) {
    // do something...
    $("#team_edit_form")[0].reset();
    $(".custom-file-label").html("Choose file");
});


/* --------------------------------- Baseurl -------------------------------- */

var baseUrl = $("#base_url").val();


/*----------------------------------------------------------------------------*/
/* -------------------- team function ----------------------------------- */
/*                        Insert Records           		                      */
/* -------------------------------------------------------------------------- */


$(document).on('click', '#team_add', function(e){
	e.preventDefault();

	var img = $('#team_img')[0].files[0];
	var name = $('#team_name').val();
	var designation = $('#team_designation').val();

	if(name == "" || designation == ""){
		toastr["error"]('all field are required');
	}
	else
	{
		var fd = new FormData();

		fd.append("img", img);
		fd.append("name", name);
		fd.append("designation", designation);

		$.ajax({
			type: 'POST',
			url: baseUrl + 'addTeam',
			contentType: false,
			processData: false,
			dataType: 'json',
			data: fd,
			async: true,
			success:function(data){
				if (data.result == 'success') 
				{
					toastr["success"](data.message);
					$('#team_modal').modal('hide');
					$('#team_add_form')[0].reset();
					$('.add-file-lable').html('Choose file');
					$('#team_table').DataTable().destroy();
					fetchTeam();
				}
				else
				{
					toastr["error"](data.message);
				}

			},

		});
	}
});

/* -------------------------------------------------------------------------- */
/*                                Fetch Records                               */
/* -------------------------------------------------------------------------- */

function fetchTeam(){
	
	$.ajax({
		url: baseUrl + 'fetchTeam',
		type: 'get',
		dataType: 'json',
		processData: false,
		contentType:  "application/json; charset=utf-8",
		async: true,
		cache: false,
		success: function(response){

			var i = '1';
			$('#team_table').DataTable({
				data: response,
				responsive: true,
				columns: [{
					data: 'id',
					render: function( data, type, row, meta ){
						return i++;
					},
				},
				{data: 'img',
				render: function(data, type, row, meta){
					var a = `
					<img src="${baseUrl}public/uploads/${row.img}"
					width="50" height="50" />
					`;
					return a;
				},
			},
			{data: 'name',},
			{data: 'designation',},
			{
				orderable: false,
				searchable: false,
				data: function(row, type, set){
					return `
					<a href="#" value="${row.id}" id="teamEdit" class="btn btn-sm btn-outline-info">
					<i class="fas fa-pen-alt"></i></a>
					<a href="#" value="${row.id}" id="teamDel" class="btn btn-sm btn-outline-danger">
					<i class="fas fa-eraser"></i></a>
					`;
				},
			},
			],
		});		
		},
	});
}

fetchTeam();


/* -------------------------------------------------------------------------- */
/*                               Delete Records                               */
/* -------------------------------------------------------------------------- */

$(document).on('click', '#teamDel', function(e){
	e.preventDefault();

	var del_id = $(this).attr('value');

	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger mr-2'
		},
		buttonsStyling: false
	});

	Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		reverseButtons: true,
		confirmButtonText: 'Yes, delete it!',

	}).then((result) => {
		if (result.isConfirmed) {

			$.ajax({
				type: 'post',
				url: baseUrl + 'delTeam',
				dataType: 'json',
				data: {del_id: del_id,},
				success: function(data){
					if (data.result == 'success') {
						Swal.fire(
							'Deleted!',
							'Your file has been deleted.',
							'success'
							);
						$('#team_table').DataTable().destroy();
						fetchTeam();
					}
				},
			});
		}
	});
});


/* -------------------------------------------------------------------------- */
/*                                Edit Records                                */
/* -------------------------------------------------------------------------- */

$(document).on('click', '#teamEdit', function(e){
	e.preventDefault();

	var edit_id = $(this).attr('value');
	$.ajax({
		type: 'get',
		url: baseUrl + 'editTeam',
		dataType: 'json',
		data: {edit_id: edit_id},
		success: function(data){
			console.log(data);
			if (data.result === 'success')
			{
				$('#edit_team_modal').modal('show');
				$('#edit_team_id').val(data.post.id);
				$("#show_team_img").html(`
					<img src="${baseUrl}public/uploads/${data.post.img}"
					width="100" height="100" class="rounded img-thumbnail">
					`);
				$('#edit_team_name').val(data.post.name);
				$('#edit_team_designation').val(data.post.designation);
			}
			else
			{
				toastr["error"](data.message, 'Error');
			}
		},
	});
});


/* -------------------------------------------------------------------------- */
/*                               Update Records                               */
/* -------------------------------------------------------------------------- */

$(document).on('click', '#team_update', function(e){
	e.preventDefault();

	var edit_id = $('#edit_team_id').val();
	var edit_team_img = $('#edit_team_img')[0].files[0];
	var name = $('#edit_team_name').val();
	var designation = $('#edit_team_designation').val();

	if (name == "" || designation == "") {
		toastr["error"]('All field are required');
	}
	else
	{
		var fd = new FormData();

		fd.append('edit_id', edit_id);
		if ($('#edit_team_img')[0].files.length > 0) 
		{
			fd.append('edit_team_img', edit_team_img);
		}
		fd.append('name', name);
		fd.append('designation', designation);

		$.ajax({
			type: 'POST',
			url: baseUrl + 'updateTeam',
			dataType: 'json',
			contentType: false,
			processData: false,
			data: fd,
			async: true,
			success: function(response){
				if (response.result === 'success') 
				{
					toastr["success"](response.message);
					$('#edit_team_modal').modal('hide');
					$('#team_edit_form')[0].reset();
					$('.edit_file_label').html('Choose file');
					$('#team_table').DataTable().destroy();
					fetchTeam();
				}
				else
				{
					toastr["error"](response.message);
				}
			},

		});
	}
});

// end of 

/*--------------------------- Add Record Modal ---------------------------------------*/

$('#product_modal').on('hide.bs.modal', function(e){
	$('#product_add_form')[0].reset();
	$('.custom-file-label').html('Choose file');
});


/* ---------------------------- Edit Record Modal --------------------------- */

$("#edit_product_modal").on("hide.bs.modal", function (e) {
    // do something...
    $("#product_edit_form")[0].reset();
    $(".custom-file-label").html("Choose file");
});


/* --------------------------------- Baseurl -------------------------------- */

var baseUrl = $("#base_url").val();


/*----------------------------------------------------------------------------*/
/* -------------------- All Product function -------------------------------- */
/*                        Insert Records           		                      */
/* -------------------------------------------------------------------------- */


$(document).on('click', '#product_add', function(e){
	e.preventDefault();

	var name = $('#product_name').val();
	var app_id = $('#app_id').val();
	var card_id = $('#card_id').val();
	var web_id = $('#web_id').val();


	if(name == "" || app_id == ""){
		toastr["error"]('all field are required');
	}
	else
	{
		var fd = new FormData();

		fd.append("name", name);
		fd.append("app_id", app_id);
		fd.append("card_id", card_id);
		fd.append("web_id", web_id);

				console.log(fd);


		$.ajax({
			type: 'POST',
			url: baseUrl + 'addProduct',
			contentType: false,
			processData: false,
			dataType: 'json',
			data: fd,
			async: true,
			success:function(data){

				if (data.result == 'success') 
				{
					toastr["success"](data.message);
					$('#product_modal').modal('hide');
					$('#product_add_form')[0].reset();
					$('#product_table').DataTable().destroy();
					fetchProduct();
				}
				else
				{
					toastr["error"](data.message);
				}

			},

		});
	}
});

/* ------------------------------------------------------------------------------- */
/*                                 Fetch Records                                   */
/* ------------------------------------------------------------------------------- */

function fetchProduct(){

	$.ajax({
		url: baseUrl + 'fetchProduct',
		type: 'get',
		dataType: 'json',
		processData: false,
		contentType:  "application/json; charset=utf-8",
		async: true,
		cache: false,
		success: function(response){

			var i = '1';
			
			$('#product_table').DataTable({
				data: response,
				responsive: true,
				columns: [{
					data: 'product_id',
					render: function(data, type, row, meta){
						return i++;
					},
				},
				{data: 'name',},
				{data: 'app_id',
				render: function(data, type, row, meta){
					var a = `
						<img src="${baseUrl}public/uploads/apps/${row.app_id}" width="50"
						height="50" />
					`;
					return a;
				},
			},
			{data: 'card_id',
				render: function(data, type, row, meta){
					var b = `
						<img src="${baseUrl}public/uploads/cards/${row.card_id}" width="50"
						height="50" />
					`;
					return b;
				},
			},
			{data: 'web_id',
				render: function(data, type, row, meta){
					var c = `
						<img src="${baseUrl}public/uploads/webs/${row.web_id}" width="50"
						height="50" />
					`;
					return c;
				},
			},
			
			],
		});
		}
	});
}

fetchProduct();

// end of



/*----------------------------------------------------------------------------*/
/* --------------------  Customer Feedback Data ------------------------------*/
/*                        Insert Records           		                      */
/* -------------------------------------------------------------------------- */


$(document).on('click', '#submitMsg', function(e){
	e.preventDefault();
	alert(1);

	var name = $('#customer_name').val();
	var email = $('#customer_email').val();
	var subject = $('#msg_subject').val();
	var message = $('#customer_message').val();


	if(name == "" || email == "" || subject == "" || message == ""){
		toastr["error"]('all field are required');
	}
	else
	{
		var fd = new FormData();

		fd.append("name", name);
		fd.append("email", email);
		fd.append("subject", subject);
		fd.append("message", message);

		$.ajax({
			type: 'POST',
			url: baseUrl + 'addMessage',
			contentType: false,
			processData: false,
			dataType: 'json',
			data: fd,
			async: true,
			success:function(data){
				console.log(data);
				if (data.result == 'success') 
				{
					toastr["success"](data.message);
					$('#contactUs_form')[0].reset();
					$('#contactUs_table').DataTable().destroy();
					fetchInfo();
				}
				else
				{
					toastr["error"](data.message);
				}

			},

		});
	}
});


/* -------------------------------------------------------------------------- */
/*                               Contact_Us Data                              */
/* -------------------------------------------------------------------------- */

function fetchInfo(){
	
	$.ajax({
		url: baseUrl + 'fetchInfo',
		type: 'get',
		dataType: 'json',
		processData: false,
		contentType:  "application/json; charset=utf-8",
		async: true,
		cache: false,
		success: function(response){

			var i = '1';
			$('#contactUs_table').DataTable({
				data: response,
				responsive: true,
				columns: [{
					data: 'id',
					render: function( data, type, row, meta ){
						return i++;
					},
				},
				
			{data: 'name',},
			{data: 'email',},
			{data: 'subject',},
			{data: 'message',},
			{
				orderable: false,
				searchable: false,
				data: function(row, type, set){
					return `
					<a href="#" value="${row.id}" id="msgDel" class="btn btn-sm btn-outline-danger">
					<i class="fas fa-eraser"></i></a>
					`;
				},
			},
			],
		});		
		},
	});
}

fetchInfo();




/*------------------------------------------------------------------------------------*/
/*--------------------------- For Frontend display data ------------------------------*/
/*------------------------------------------------------------------------------------*/



/* -------------------------------------------------------------------------- */
/*                               Mobile Data                                   */
/* -------------------------------------------------------------------------- */

// function showMobile(){


//     $.ajax({
//         url: baseUrl + 'fetchMobile',
//         type: 'GET',
//         dataType: 'JSON',
//         contentType: false,
//         processData: false,
//         success: function(response){
// console.log(response);
//             // var result = JSON.parse(response);
// var result = JSON.parse(JSON.stringify(response));

//             console.log(result);	

//             // $(response, function(key,value){
//             $('#mobile_user_id').append(value.name);
//             $('#mobile_content').append(value.content);
//             // });
//         }

//     });
// }

// showMobile();
