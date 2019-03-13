<script src="<?php echo base_url(); ?>assets/painel/vendor/jquery/jquery.min.js"></script>

<div class="alert alert-success" style="display: none;"></div>

<div id="gridPrincipal">
</div>

<!-- <div id="templateToolbar" type="text/x-kendo-template">
    <button   onclick="adicionar()" class="btn btn-small btn-primary">            
        <i class="far fa-plus-square">Adicionar</i>
    </button>
</div> -->

<script id="templateToolbar" type="text/x-kendo-template">
    <a class="k-button" onclick="adicionar()" >Adicionar</a>
</script>



<div id="windowAdicionar">
    <div class="col-lg-8">
        <div class="form-group">
            <label>Categoria</label>
            <input id="addCategoria" name="addCategoria" class="form-control" type="text"  required="required"  />
        </div> 
        <div style="float: left; margin-left:115px; margin-top:20px; width: 185px;">
            <button id="btnSalvar" class="btn btn-success">Salvar</button>&nbsp; 
            <button onclick="fecharWindow()"  class="btn btn-danger">Cancelar</button>                          
        </div>      
    </div>
</div>


<div id="windowEditar">
    <div style="width: 280px; float: left;">            
        A Categoria: <strong><span id="spanEditar"></span></strong></p>
    </div>
</div>


<div id="windowDeletar" style="padding-left:15px; padding-right:15px">
    <div style="clear:both; margin-top: 10px; float: left; width: px;">             
    <div style="width: 280px; float: left;">            
        A Categoria: <strong><span id="spanDeletar"></span></strong> séra excluida!</p>
    </div>
    <div style="clear:both;  margin-left:80px; margin-top: 5px; float: left; width: 170px;">
        <button onclick="btnDeletar('${id_categoria}')" class="btn btn-success">Excluir</button>&nbsp;                   
        <button class="btn btn-danger" onclick="fecharWindow()">Cancelar</button>   
    </div> 
    </div> <!-- end winDelete -->    
</div>
    
    
<script>
    $(document).ready(function () {        
        
        $("#gridPrincipal").kendoGrid({
            dataSource: {
                schema:{ model:{ id:"id_categoria"}},
                type: "json",     
                transport: 
                {                        
                    read: {
                    url:"<?php echo base_url(); ?>oficina/kendoui/crud/read",
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
                            "<button id='${id_categoria}' onclick='editar(${id_categoria})' class='remove k-button'>Editar</button> | <button id='${id_categoria}' onclick='Ideletar(${id_categoria})' class='remove k-button'>Deletar</button>", 
                            title: "OPCÕES", 
                            width: 20
                }   
            ],        
        
            toolbar:[ { template: kendo.template($("#templateToolbar").html()) } ]                      
        });
 

            
        $('#windowAdicionar').kendoWindow({
            width:"600", 
            //height:"140",
            modal: true,
            visible: false,
            resizable: false,           
            close: function(e){                              
            }         
        });


        $('#windowEditar').kendoWindow({
            width:"295", 
            height:"140",
            modal: true,
            visible: false,
            resizable: false,           
            close: function(e){                              
            }         
        });    


        $('#windowDeletar').kendoWindow({
            width:"295", 
            height:"140",
            modal: true,
            visible: false,
            resizable: false,           
            close: function(e){                              
            }         
        }); 

    });

      
    //Formato da janela winDatas, configura mensagens para janela winDatas, 
    function adicionar()
    {         
        $("#windowAdicionar").data("kendoWindow").open().center().title("Adicionar Categoria");
    } 


    function editar(id_categoria) {
        //alert("Hello World!");
        var dataEditar = $('#gridPrincipal').data('kendoGrid').dataSource.get(id_categoria); 
        $("#windowEditar").data("kendoWindow").open().center().title("Excluir: "  + dataEditar.categoria); // centralizar titulo
        $('#spanEditar').html(dataEditar.categoria); // carrega span para data
        $('#spanEditarId').html(dataEditar.id_categoria); // carrega span para data     
    }

    // function deletar(id_categoria){
    //     // alert("Hello World!"); 
    //     var dataSourceDeletar = $('#gridPrincipal').data('kendoGrid').dataSource.get(id_categoria);  
    //     $("#windowDeletar").data("kendoWindow").open().center().title("Excluir: "  + dataSourceDeletar.categoria); // centralizar titulo     
    //     $('#spanDeletar').html(dataSourceDeletar.categoria); // carrega span para data 
    // } 


    function Ideletar(id_categoria){
        // alert("Desenha deletar esta categoria"); 
        var id = $('#gridPrincipal').data('kendoGrid').dataSource.get(id_categoria); 
        var idCategoria = id.id_categoria;

        if (confirm("Are you sure you want to delete this customer?")) {
            $.ajax({
                type: 'post',           
                dataType: 'json',
                method: 'get',       
                url  : "<?php echo site_url('oficina/kendoui/destroy/destroy')?>",
                data : {idCategoria:idCategoria},
                success: function(data){
                    //alert("Hello World!");
                    // $('[name="idCategoria"]').val("");
                    $('.alert-success').html('Categoria excluída com sucesso').fadeIn().delay(4000).fadeOut('slow');                
                    $("#windowDeletar").data("kendoWindow").close(); // fehcar janela  
                    $('#gridPrincipal').data('kendoGrid').dataSource.read();                       
                }
            });
            return false;
            alert("Hello World!");
        }
        
        // if (confirm("Are you sure you want to delete this customer?")) {
        //     $.ajax({
        //         type: 'post',           
        //         dataType: 'json',               
        //         data : {dataDeletar:dataDeletar},
        //         url:  "<?php echo site_url('oficina/kendoui/destroy/destroy')?>",              
        //         success: function () {
        //             alert("ok"); 
        //             // $('.alert-success').html('Categoria excluída com sucesso').fadeIn().delay(4000).fadeOut('slow');                
        //             // $("#windowDeletar").data("kendoWindow").close(); // fehcar janela  
        //             // $('#gridPrincipal').data('kendoGrid').dataSource.read();  
        //         }
        //     });
        //     return false;
        //     alert("error"); 
        //}


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



    // function btnDeletar(id_categoria){
    //     // alert("Hello World!"); 
    //     var id_categoria = $('#gridPrincipal').data('kendoGrid').dataSource.get(id_categoria);
    //     $.ajax({
    //         type: 'post',           
    //         dataType: 'json',
    //         method: 'get',
    //         url  : "<?php echo site_url('oficina/kendoui/destroy/destroy')?>",
    //         data : {id_categoria:id_categoria},
    //         success: function(data){
    //             //alert("Hello World!");
    //             // $('[name="idCategoria"]').val("");
    //             $('.alert-success').html('Categoria excluída com sucesso').fadeIn().delay(4000).fadeOut('slow');                
    //             $("#windowDeletar").data("kendoWindow").close(); // fehcar janela  
    //             $('#gridPrincipal').data('kendoGrid').dataSource.read();                       
    //         }
    //     });
    //     return false;
    //     alert("Hello World!");
    // } 
   

  
    // $('#btnDeletar').on('click',function(id_categoria){
    //     var idCategoria = $('#gridPrincipal').data('kendoGrid').dataSource.get(id_categoria); 
    //     $.ajax({
    //         type: 'post',
    //         method: 'DELETE',
    //         async: false,
    //         dataType: 'json',
    //         url  : "<?php echo site_url('oficina/kendoui/destroy/destroy')?>",
    //         data : {idCategoria:idCategoria},
    //         success: function(data){
    //             $('[name="idCategoria"]').val("");
    //             $('.alert-success').html('Categoria excluída com sucesso').fadeIn().delay(4000).fadeOut('slow');
    //             //alert("Hello World!");
    //             $("#windowDeletar").data("kendoWindow").close(); // fehcar janela  
    //             $('#gridPrincipal').data('kendoGrid').dataSource.read();                       
    //         }
    //     });
    //     return false;
    //     //alert("Hello World!");
    // });







    // $('#btnDeletar').on('click',function(){
    //     // alert("Hello World!");
    //     //var idCategoria = $('#gridPrincipal').data('kendoGrid').dataSource.get(id_categoria);   
    //     $.ajax({
    //         type: 'ajax',
    //         method: 'get',
    //         async: false,
    //         url: '<?php echo base_url() ?>oficina/kendoui/destroy/destroy',
    //         data:{idCategoria:idCategoria},
    //         dataType: 'json',
    //         success: function(data)
    //         {
    //             alert("Hello World!");
    //             // $('[name="addCategoria"]').val("");							
    //             // $('.alert-success').html('Categoria inserida com sucesso').fadeIn().delay(4000).fadeOut('slow');
    //             // $("#windowAdicionar").data("kendoWindow").close(); // fehcar janela  
    //             // $('#gridPrincipal').data('kendoGrid').dataSource.read();                            
    //         }
           
            
    //     });
    //     alert("Error");
    // }); 


 
    // $('#btnDeletar').on('click',function(){
    //     var idCategoria = $('#gridPrincipal').data('kendoGrid').dataSource.get(id_categoria);  
    //     $.ajax({
    //         type: 'ajax',
    //         method: 'get',
    //         async: false,
    //         url: '<?php echo base_url() ?>oficina/kendoui/destroy/destroy',
    //         data:{idCategoria:idCategoria},
    //         dataType: 'json',
    //         success: function(response){
    //             if(response.success){ 
    //                 alert("Hello World!");                  
    //                 $('.alert-success').html('Categoria excluída com sucesso').fadeIn().delay(4000).fadeOut('slow');
    //                 $('#gridPrincipal').data('kendoGrid').dataSource.read();  
    //             }else{
    //                 alert('Error');
    //             }
    //         },
    //         error: function(){
    //             alert('Erro ao excluir');
    //         }
    //     });
    // });
    

    

    
    function fecharWindow()
    {   
        $("#windowDeletar").data("kendoWindow").close(); 
        $("#windowCrud").data("kendoWindow").close();               
    }

    // function carregarGridCrud(selecionado){   
    //     $("#gridPrinciapl").data("kendoGrid").select(selecionado);
    // }


</script>


