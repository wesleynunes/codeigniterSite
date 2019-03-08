<script src="<?php echo base_url(); ?>assets/jqueryui/js/jquery-3.1.1.min.js"></script>  

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Listar Categoria jguery</h1>
	  <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_Add" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="far fa-address-card"></i> Adicionar</a>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de categoria jguery</h6> 
    </div>
	<div class="alert alert-success" style="display: none;">		
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">			
				<thead>
					<tr>
						<td>Id</td>
						<td>Categoria</td>
						<td>Data Criação</td>
						<td>Data Alteração</td>
						<td>Ação</td>
					</tr>
				</thead>
				<tbody id="getData">			
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Form Adicionar -->
<form>
		<div class="modal fade" id="Modal_Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
							<div class="form-group row">
									<label class="col-md-2 col-form-label">Product Code</label>
									<div class="col-md-10">
										<input type="text" name="categoria" id="categoria" class="form-control">
									</div>
							</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" type="submit" id="btn_save" class="btn btn-primary">Save</button>
					</div>
				</div>
			</div>
		</div>
</form>

<form>
<div id="modalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Editar Categoria</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
			</button>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4> -->
      </div>
      <div class="modal-body">        	
						<!-- <form id="formEdit" action="" method="post" class="form-horizontal"> -->        		
        		<div class="form-group">
						<input type="hidden" name="id_categoria" id="id_categoria" value="0">
        			<label for="name" class="label-control col-md-4">Categoria</label>
        			<div class="col-md-8">
        				<input type="text" name="txtCategoria" id="txtCategoria" class="form-control">
        			</div>
        		</div>        	
        	</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btnEdit" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</form>


<!-- Form deletar -->
<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirm Delete</h4>
      </div>
      <div class="modal-body">
        	Do you want to delete this record?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btnDelete" class="btn btn-danger">Delete</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
	$(function(){

		getCategoria();

		//function
		function getCategoria()
		{
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url() ?>oficina/jguery/getCategoria',
				async: false,
				dataType: 'json',
				success: function(data){
					//console.log(data);
					var html = '';
					var i;
					for(i=0; i<data.length; i++){
						html +='<tr>'+
									'<td>'+data[i].id_categoria+'</td>'+
									'<td>'+data[i].categoria+'</td>'+
									'<td>'+data[i].data_criacao+'</td>'+
									'<td>'+data[i].data_alteracao+'</td>'+
									'<td style="text-align:right;">'+
										'<a href="javascript:;" class="btn btn-info btn-sm item-edit" data="'+data[i].id_categoria+'">Edit</a>'+' '+
										'<a href="javascript:;" class="btn btn-danger btn-sm item-delete" data="'+data[i].id_categoria+'">Delete</a>'+
									'</td>'+
							    '</tr>';
					}
					$('#getData').html(html);
				},
				error: function(){
					alert('Could not get Data from Database');
				}
			});
		}	
	
		 //Save product
		 $('#btn_save').on('click',function(){
			var categoria = $('#categoria').val();           
			$.ajax({
					type : "POST",
					url  : "<?php echo site_url('oficina/jguery/saveCategoria')?>",
					dataType : "JSON",
					data : {categoria:categoria},
					success: function(data){
							$('[name="categoria"]').val("");
							$('#Modal_Add').modal('hide');
							getCategoria();
					}
			});
			return false;
		 });



		 //edit
		$('#getData').on('click', '.item-edit', function(){
			var id_categoria = $(this).attr('data');
			var categoria = $('#txtCategoria').val(); 
			$('#modalEdit').modal('show');
			//$('#formEdit').attr('action', '<?php echo base_url() ?>oficina/jguery/updateCategoria');			
			$.ajax({
				type: 'ajax',
				method: 'get',
				url: '<?php echo base_url() ?>oficina/jguery/editCategoria',
				data: {id_categoria:id_categoria, categoria:categoria},
				async: false,
				dataType: 'json',
				success: function(data){
					$('input[name=txtCategoria]').val(data.categoria);					
					$('input[name=id_categoria]').val(data.id_categoria);
				},
				error: function(){
					alert('Could not Edit Data');
				}
			});
		});


		//Save product
		$('#btnEdit').on('click',function(){
			// var id_categoria = $(this).attr('data');
			var id_categoria = $('#id_categoria').val(); 
			var txtcategoria = $('#txtCategoria').val();   /// categoria que vai para o banco         
			$.ajax({
					type : "POST",
					url  : "<?php echo site_url('oficina/jguery/updateCategoria')?>",
					dataType : "JSON",
					data : {id_categoria:id_categoria, txtcategoria:txtcategoria}, /// isso e o que vai para o update na model 
					success: function(data){
						// alert("Hello! I am an alert box!!");							
							$('[name="txtCategoria"]').val("");							
							$('#modalEdit').modal('hide');
							getCategoria();
					}
			});
			return false;
			alert("Hello! I am an alert box!!");
		 });



		 //delete- 
		$('#getData').on('click', '.item-delete', function(){
			var id_categoria = $(this).attr('data');
			$('#deleteModal').modal('show');
			//prevent previous handler - unbind()
			$('#btnDelete').unbind().click(function(){
				$.ajax({
					type: 'ajax',
					method: 'get',
					async: false,
					url: '<?php echo base_url() ?>oficina/jguery/deleteCategoria',
					data:{id_categoria:id_categoria},
					dataType: 'json',
					success: function(response){
						if(response.success){
							$('#deleteModal').modal('hide');
							$('.alert-success').html('Employee Deleted successfully').fadeIn().delay(4000).fadeOut('slow');
							getCategoria();
						}else{
							alert('Error');
						}
					},
					error: function(){
						alert('Error deleting');
					}
				});
			});
		});
		 	
	});
</script>