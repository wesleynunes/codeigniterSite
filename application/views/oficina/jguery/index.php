<script src="<?php echo base_url(); ?>assets/jqueryui/js/jquery-3.1.1.min.js"></script>  

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Listar Categoria jguery</h1>
	<button id="btnAdd"   class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="far fa-address-card"></i>Adicionar</button>
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
				<tbody id="gedData">			
				</tbody>
			</table>
		</div>
	</div>
</div>

<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        	<form id="myForm" action="" method="post" class="form-horizontal">
        		<input type="hidden" name="txtId" value="0">
        		<div class="form-group">
        			<label for="name" class="label-control col-md-4">Categoria</label>
        			<div class="col-md-8">
        				<input type="text" name="txtCategoria" class="form-control">
        			</div>
        		</div>        	
        	</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="button" id="btnSave" class="btn btn-primary">Salvar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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
									'<td>'+
										'<a href="javascript:;" class="btn btn-info item-edit" data="'+data[i].id_categoria+'">Edit</a>'+
										'<a href="javascript:;" class="btn btn-danger item-delete" data="'+data[i].id_categoria+'">Delete</a>'+
									'</td>'+
							    '</tr>';
					}
					$('#gedData').html(html);
				},
				error: function(){
					alert('Could not get Data from Database');
				}
			});
		}

		//Add New
		$('#btnAdd').click(function(){
			$('#myModal').modal('show');
			$('#myModal').find('.modal-title').text('Adicionar Categoria');
			$('#myForm').attr('action', '<?php echo base_url() ?>oficina/jguery/saveCategoria');
		});

		$('#btnSave').click(function(){
			var url = $('#myForm').attr('action');
			var data = $('#myForm').serialize();
			//validate form
			var categoria = $('input[name=txtCategoria]');			
			var result = '';
			if(categoria.val()==''){
				categoria.parent().parent().addClass('has-error');
			}else{
				categoria.parent().parent().removeClass('has-error');
				result +='1';
			}		

			if(result=='12'){
				$.ajax({
					type: 'ajax',
					method: 'post',
					url: url,
					data: data,
					async: false,
					dataType: 'json',
					success: function(response){
						if(response.success){
							$('#myModal').modal('hide');
							$('#myForm')[0].reset();
							if(response.type=='add'){
								var type = 'added'
							}else if(response.type=='update'){
								var type ="updated"
							}
							$('.alert-success').html('Categoria '+type+' Sucesso').fadeIn().delay(4000).fadeOut('slow');
							getCategoria();
						}else{
							alert('Error');
						}
					},
					error: function(){
						alert('Could not add data');
					}
				});
			}
		});

	});
</script>