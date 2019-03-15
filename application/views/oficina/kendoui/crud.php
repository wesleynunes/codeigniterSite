<script src="<?php echo base_url(); ?>assets/painel/vendor/jquery/jquery.min.js"></script>

<div class="alert alert-success" style="display: none;"></div>

<div id="gridPrincipal">
</div>

<script id="templateToolbar" type="text/x-kendo-template">
    <a class="k-button" onclick="adicionar()" >Adicionar</a>
</script>

<div id="windowAdicionar" class="modal" tabindex="-1" role="dialog">
    <div class='modal-body'>
        <form>
            <div class="form-group">
                <label class="col-form-label">Categoria</label>
                <div class="col-sm-10">
                    <input id="addCategoria" name="addCategoria" class="form-control" type="text" required="required"/>
                </div>
            </div>          
        </form>     
    </div>
    <div class="modal-footer"> 
        <button id="btnSalvar" class="btn btn-success">Salvar</button>&nbsp;             
        <button onclick="fecharWindow()" class="btn btn-secondary">Fechar</button>                               
    </div>
</div>


<div id="windowEditar" class="modal" tabindex="-1" role="dialog">   
    <div class="modal-body">
        <form>            
            <div class="form-group">
                <!-- A Categoria: <strong><span id="spanEditar"></span></strong></p> -->
                <input type="hidden" name="idEditCategoria" id="idEditCategoria">
                <label class="col-form-label">Categoria</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="editCategoria" id="editCategoria">
                </div>
            </div>   
        </form>        
    </div>
    <div class="modal-footer">     
        <!-- <button type="button" id="btnEditar" class="btn btn-success">Editar</button>    -->
        <button type="button" onclick="btnEditar()" class="btn btn-success">Editar</button>   
        <button onclick="fecharWindow()" type="button" class="btn btn-secondary">Fechar</button>    
    </div>   
</div>


<!-- 
<div id="windowDeletar" style="padding-left:15px; padding-right:15px">
    <div style="clear:both; margin-top: 10px; float: left; width: px;">             
    <div style="width: 280px; float: left;">            
        A Categoria: <strong><span id="spanDeletar"></span></strong> séra excluida!</p>
    </div>
    <div style="clear:both;  margin-left:80px; margin-top: 5px; float: left; width: 170px;">
        <button onclick="btnDeletar('${id_categoria}')" class="btn btn-success">Excluir</button>&nbsp;                   
        <button class="btn btn-danger" onclick="fecharWindow()">Cancelar</button>   
    </div> 
    </div>  
</div> -->
    
    
<script>
    $(document).ready(function () {        
        
        $("#gridPrincipal").kendoGrid({
            dataSource: {
                schema:{ model:{ id:"id_categoria"}},
                type: "json",     
                transport: 
                {                        
                    read: {
                    url:"<?php echo base_url(); ?>oficina/kendoui/read/read",
                    dataType: "json", 
                    type: "POST"
                    },
                },
                pageSize: 20
            },
            height: 550,
            //groupable: true,
            //sortable: true,
            //selectable: true, 
            pageable: {
                refresh: true,
                pageSizes: true,
                buttonCount: 5
            },
            columns: 
            [
                {field: "id_categoria", title: "ID", width: 10},
                {field: "categoria", title: "CATEGORIA", width: 25},
                {field: "data_criacao", title: "DATA DE CRIAÇÃO", width: 20},
                {field: "data_alteracao", title: "DATA DE ALTERAÇÃO", width: 20},
                {template: 
                            "<button id='${id_categoria}' onclick='editar(${id_categoria})' class='remove k-button'>Editar</button> | <button id='${id_categoria}' onclick='deletar(${id_categoria})' class='remove k-button'>Deletar</button>", 
                            title: "OPCÕES", 
                            width: 20
                }   
            ],       
            toolbar:[ { template: kendo.template($("#templateToolbar").html()) } ]                      
        });
 

            
        $('#windowAdicionar').kendoWindow({
            width:"550", 
            height:"250",
            modal: true,
            visible: false,
            resizable: false,               
            close: function(e){                              
            }         
        });


        $('#windowEditar').kendoWindow({
            width:"650", 
            height:"250",
            modal: true,
            visible: false,
            resizable: false,                                       
            close: function(e){                              
            }         
        });    


        // $('#windowDeletar').kendoWindow({
        //     width:"295", 
        //     height:"140",
        //     modal: true,
        //     visible: false,
        //     resizable: false,           
        //     close: function(e){                              
        //     }         
        // }); 

    });

      
    //Formato da janela winDatas, configura mensagens para janela winDatas, 
    function adicionar()
    {         
        $("#windowAdicionar").data("kendoWindow").open().center().title("Adicionar Categoria");
    } 


    $('#btnSalvar').on('click',function(){
    // alert("Hello World!");
    var addCategoria = $('#addCategoria').val();    

    $.ajax({
        type : "POST",
        url  : "<?php echo site_url('oficina/kendoui/create/create')?>",
        dataType : "JSON",
        data : {addCategoria:addCategoria},
        success: function(data)
        {
            //alert("Hello World!");
            // $('[name="addCategoria"]').val("");							
            $('.alert-success').html('Categoria inserida com sucesso').fadeIn().delay(4000).fadeOut('slow');
            $("#windowAdicionar").data("kendoWindow").close(); // fehcar janela  
            $('#gridPrincipal').data('kendoGrid').dataSource.read();                            
        }
    });  
        return false; 
    });  
    
    function editar(id_categoria) {
        //alert("Hello World!");
        var dataEditar = $('#gridPrincipal').data('kendoGrid').dataSource.get(id_categoria);
        var idEditCategoria = dataEditar.id_categoria;
        var editCategoria   = dataEditar.categoria 

        //pegar valores id_categoria e categorias mais da erro de valores
        // var idEditCategoria = $("#idEditCategoria").val(dataEditar.id_categoria); 
        // var editCategoria   = $("#editCategoria").val(dataEditar.categoria); 

        $("#windowEditar").data("kendoWindow").open().center().title("Editar: "  + dataEditar.categoria); // centralizar titulo
        $('#spanEditar').html(dataEditar.categoria); // carrega span para data       
   
        $.ajax({
            type: 'ajax',           
            dataType: 'json',
            // method: 'get',                   
            data:{idEditCategoria:idEditCategoria,editCategoria,editCategoria},               
            url: '<?php echo base_url() ?>oficina/kendoui/edit',
            success: function(data){
                // alert("Teste editar com sucesso!");
                $('input[name=idEditCategoria]').val(dataEditar.id_categoria);  //traz id_categoria
                $('input[name=editCategoria]').val(dataEditar.categoria);		//traz categoria 
            },
            error: function(){
                alert('Não foi possível editar dados');
            }
        });
    }

    function btnEditar()
    {         
        // alert("Teste editar");   
        var idEditCategoria  = $('#idEditCategoria').val();
        var editCategoria 	 = $('#editCategoria').val();

        //pega valores id_categoria e categorias
        // var idEditCategoria = $("#idEditCategoria").val(dataEditar.id_categoria); 
        // var editCategoria   = $("#editCategoria").val(dataEditar.categoria); 

        $.ajax({
                type : "POST",
                url  : "<?php echo site_url('oficina/kendoui/update/update')?>",
                dataType : "json",
                data : {idEditCategoria:idEditCategoria,editCategoria:editCategoria}, /// isso e o que vai para o update na model 
                success: function(data){
                        // alert("Hello! I am an alert box!!");							
                        // $('[name="editCategoria"]').val("");					
                        $('.alert-success').html('Categoria alterada com sucesso').fadeIn().delay(4000).fadeOut('slow');
                        $("#windowEditar").data("kendoWindow").close(); // fehcar janela  
                        $('#gridPrincipal').data('kendoGrid').dataSource.read(); 
                }
        });
        return false;
        alert("Não foi possível obter dados do banco de dados");
    } 


    // function deletar(id_categoria){
    //     // alert("Hello World!"); 
    //     var dataSourceDeletar = $('#gridPrincipal').data('kendoGrid').dataSource.get(id_categoria);  
    //     $("#windowDeletar").data("kendoWindow").open().center().title("Excluir: "  + dataSourceDeletar.categoria); // centralizar titulo     
    //     $('#spanDeletar').html(dataSourceDeletar.categoria); // carrega span para data 
    // } 


    function deletar(id_categoria){
        // alert("Desenha deletar esta categoria"); 
        var id = $('#gridPrincipal').data('kendoGrid').dataSource.get(id_categoria); 
        var idCategoria = id.id_categoria;

        if (confirm("Você deseja excluir este registro?")) {
            $.ajax({
                type: 'post',           
                dataType: 'json',
                method: 'get',       
                url  : "<?php echo site_url('oficina/kendoui/destroy/destroy')?>",
                data : {idCategoria:idCategoria},
                success: function(data){
                    // alert("teste!");
                    // $('[name="idCategoria"]').val("");
                    // $("#windowDeletar").data("kendoWindow").close(); // fehcar janela  
                    $('.alert-success').html('Categoria excluída com sucesso').fadeIn().delay(4000).fadeOut('slow');               
                    $('#gridPrincipal').data('kendoGrid').dataSource.read();                       
                }
            });
            return false;
            alert("Hello World!");
        }      
    }  
     
    
    function fecharWindow()
    {   
        $("#windowAdicionar").data("kendoWindow").close();  
        $("#windowEditar").data("kendoWindow").close();
        // $("#windowDeletar").data("kendoWindow").close();               
    }
</script>


