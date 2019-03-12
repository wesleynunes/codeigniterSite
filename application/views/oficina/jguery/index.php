<script src="<?php echo base_url(); ?>assets/jqueryui/js/jquery-3.1.1.min.js"></script>  
	
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Listar Categoria jguery</h1>
	  <a href="javascript:;"  data-toggle="modal" data-target="#modalAdd" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="far fa-address-card"></i> Adicionar</a>
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
		<div id="modalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Adicionar categoria</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="alert alert-danger" id="alert-add" style="display: none;">
					</div>
					<div class="modal-body">
							<div class="form-group">
									<label class="label-control col-md-4">Categoria</label>
									<div class="col-md-8">
										<input type="text" name="addCategoria" id="addCategoria" class="form-control">
									</div>
							</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
						<button type="button" type="submit" id="btnSalvar" class="btn btn-primary">Salvar</button>
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
				</div>
				<div class="alert alert-danger" id="alert-edit" style="display: none;">
				</div>
				<div class="modal-body">        	
					<div class="form-group">
						<input type="hidden" name="editIdCategoria" id="editIdCategoria" value="0">
						<label class="label-control col-md-4">Categoria</label>
						<div class="col-md-8">
							<input type="text" name="editCategoria" id="editCategoria" class="form-control">
						</div>
					</div>        	
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
					<button type="button" id="btnEdit" class="btn btn-primary">Editar</button>
				</div>
			</div>
		</div>
	</div>
</form>


<!-- Form deletar -->
<div id="modalDelete" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Deletar categoria</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>      
      <div class="modal-body">
				Você deseja excluir este registro?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" id="btnDelete" class="btn btn-danger">Deletar</button>
      </div>
    </div>
  </div>
</div>

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
										'<a href="javascript:;" class="btn btn-info btn-sm item-edit" data="'+data[i].id_categoria+'">Editar</a>'+' '+
										'<a href="javascript:;" class="btn btn-danger btn-sm item-delete" data="'+data[i].id_categoria+'">Deletar</a>'+
									'</td>'+
							    '</tr>';
					}
					$('#getData').html(html);
				},
				error: function(){
					alert('Não foi possível obter dados do banco de dados');
				}
			});
		}	
	
		 //Salvar categoria
		 $('#btnSalvar').on('click',function(){
			var addCategoria = $('#addCategoria').val();     

			if(document.getElementById("addCategoria").value.length < 3)
			{
				//alert('Por favor, preencha o campo');
				//$('.alert-danger').html('Por favor, preencha o campo').fadeIn().delay(4000).fadeOut('slow');
				$('#alert-add').html('Por favor, preencha o campo').fadeIn().delay(4000).fadeOut('slow');
				document.getElementById("addCategoria").focus();
				return false
			}

			$.ajax({
					type : "POST",
					url  : "<?php echo site_url('oficina/jguery/saveCategoria')?>",
					dataType : "JSON",
					data : {addCategoria:addCategoria},
					success: function(data){
							$('[name="addCategoria"]').val("");
							$('#modalAdd').modal('hide');
							$('.alert-success').html('Categoria inserida com sucesso').fadeIn().delay(4000).fadeOut('slow');
							getCategoria();
					}
			});
			return false;
		 });



		 //edit
		$('#getData').on('click', '.item-edit', function(){
			var editIdCategoria = $(this).attr('data');
			var editCategoria 	= $('#editCategoria').val(); 
			$('#modalEdit').modal('show');
			$.ajax({
				type: 'ajax',
				method: 'get',
				url: '<?php echo base_url() ?>oficina/jguery/editCategoria',
				data: {editIdCategoria:editIdCategoria, editCategoria:editCategoria},
				async: false,
				dataType: 'json',
				success: function(data){
					$('input[name=editIdCategoria]').val(data.id_categoria);
					$('input[name=editCategoria]').val(data.categoria);		
				},
				error: function(){
					alert('Não foi possível editar dados');
				}
			});
		});


		//Save product
		$('#btnEdit').on('click',function(){		
		
			var editIdCategoria = $('#editIdCategoria').val(); 
			var editCategoria 	= $('#editCategoria').val(); 

			if(document.getElementById("editCategoria").value.length < 3)
			{
				//alert('Por favor, preencha o campo');
				$('#alert-edit').html('Por favor, preencha o campo').fadeIn().delay(4000).fadeOut('slow');
				document.getElementById("editCategoria").focus();
				return false
			}

			$.ajax({
					type : "POST",
					url  : "<?php echo site_url('oficina/jguery/updateCategoria')?>",
					dataType : "JSON",
					data : {editIdCategoria:editIdCategoria, editCategoria:editCategoria}, /// isso e o que vai para o update na model 
					success: function(data){
						// alert("Hello! I am an alert box!!");							
							$('[name="editCategoria"]').val("");							
							$('#modalEdit').modal('hide');
							$('.alert-success').html('Categoria alterada com sucesso').fadeIn().delay(4000).fadeOut('slow');
							getCategoria();
					}
			});
			return false;
			alert("Não foi possível obter dados do banco de dados");
		 });


		//delete- 
		$('#getData').on('click', '.item-delete', function(){
			var idCategoria = $(this).attr('data');
			$('#modalDelete').modal('show');
			//prevent previous handler - unbind()
			$('#btnDelete').unbind().click(function(){
				$.ajax({
					type: 'ajax',
					method: 'get',
					async: false,
					url: '<?php echo base_url() ?>oficina/jguery/deleteCategoria',
					data:{idCategoria:idCategoria},
					dataType: 'json',
					success: function(response){
						if(response.success){
							$('#modalDelete').modal('hide');
							$('.alert-success').html('Categoria excluída com sucesso').fadeIn().delay(4000).fadeOut('slow');
							getCategoria();
						}else{
							alert('Error');
						}
					},
					error: function(){
						alert('Erro ao excluir');
					}
				});
			});
		});
	});



	function valida_form ()
	{
		if(document.getElementById("addCategoria").value.length < 3){
		alert('Por favor, preencha o campo nome');
		document.getElementById("").focus();
		return false
		}
	}






	// $(document).ready(function(){
  //     $(".form").submit(function(e) {
  //        e.preventDefault();//evito o submit do form ao apetar o enter..
  //     });
 	// });

</script>