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
            <input id="addCategoria"  name="addCategoria"  class="form-control" type="text" placeholder="" required="required"  />
        </div> 
        <div style="float: left; margin-left:115px; margin-top:20px; width: 185px;">
            <button id="btnSalvar" class="btn btn-success">Salvar</button>&nbsp; 
            <button onclick="fecharWindow()"  class="btn btn-danger">Cancelar</button>                          
        </div>      
    </div>
</div>



<!-- <div id="windowAdicionar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
</div> -->


    <div id="windowEditar">
        <p>teste</P>
    </div>






<div id="windowDeletar" style="padding-left:15px; padding-right:15px">
    <div style="clear:both; margin-top: 10px; float: left; width: px;">             
    <div style="width: 280px; float: left;">            
        A Categoria: <strong><span id="spanDeletar"></span></strong> séra excluida!</p>
    </div>
    <div style="clear:both;  margin-left:80px; margin-top: 5px; float: left; width: 170px;">
        <button id="" class="btn btn-success" onclick="deletar()">Excluir</button>&nbsp;                   
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
            groupable: true,
            sortable: true,
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
                { command: [                                
                                { 
                                    name: "delete",
                                    text: "delete",
                                    click: _handleDelete,
                                    id: "id_categoria",                               
                                },

                                { 
                                    name: "edit",
                                    text: "edit",
                                    click: _handleEdit,
                                    id: "id_categoria",                               
                                }                        
                            
                            ], title: "Opcões", width: "20px" 
                }
                  
            
                // { command: ["edit", {name: "myDelete", text: "Delete"}], title: "&nbsp;", width: "20px" }],
                // { command: [{ name: "delete"}], title: "Opcões", width: "20px" }
                // { command: ["edit", "destroy"], title: "&nbsp;", width: "20px" }
                // { command: [{ name: "edit", visible: function(dataItem) { return dataItem.name==="Jane" } }] }
                // {
                //     field: "",
                //     title: "Editar", 
                //     width: 10, 
                //     attributes:{style:"text-align:center;"},
                //     headerAttributes:{style:"text-align:center;"}, 
                //     //headerTemplate:"Editar", 
                //     template:'<button onclick="editar()"  class="btn btn-primary btn-mini"><i class="far fa-edit"></i></button>'
                // },  
                // { 
                //     field: "",
                //     title: "Deletar",
                //     width: 10, 
                //     // attributes:{style:"text-align:center;"}, 
                //     // headerAttributes:{style:"text-align:center;"}, 
                //     // headerTemplate:"Deletar", 
                //     template:'<button id="${id_categoria}" onclick="deletar( \'${id_categoria}\')" class="btn btn-danger btn-mini"><i class="far fa-trash-alt"></i></button>'
                // },
            ],         
            // change: function(e) {
            //     var selectedRows = this.select();
            //     var dataItem = this.dataItem(selectedRows);
            //     var id_categoria = dataItem.id_categoria; // pega codigo da gridGrupo     
            //     atualizaGridData() // atualiza as datas na gridDatas
            // }, 
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


    // function deletar() {
    //     // alert("Hello World!"); 
    //     // var dataSourceDeletar = $('#gridPrincipal').data('kendoGrid').dataSource.get(id_categoria);  
    //     // $("#windowDeletar").data("kendoWindow").open().center().title("Excluir: "  + dataSourceDeletar.categoria); // centralizar titulo     
    //     // $('#spanDeletar').html(dataSourceDeletar.categoria); // carrega span para data 
    // }

    // function editar() {
    //     //alert("Hello World!"); 
    //     $("#windowEditar").data("kendoWindow").open().center().title("Adicionar Categoria")
    // }


    function _handleDelete(id_categoria) {
        // alert("Hello World!");
        //var dataSourceDeletar = $('#gridPrincipal').data('kendoGrid').dataSource.get(id_categoria); 
        $("#windowDeletar").data("kendoWindow").open().center().title("Adicionar Categoria")
        
        // var dataSourceDeletar = $('#gridPrincipal').data('kendoGrid').dataSource.get(id_categoria);  
        //$("#windowDeletar").data("kendoWindow").open().center().title("Excluir: "  + dataSourceDeletar.categoria); // centralizar titulo     
        //$('#spanDeletar').html(dataSourceDeletar.categoria); // carrega span para data 
        // dataitem = grid.dataItem($(event.currentTarget).closest("tr"));
        // kWindow.open();
    };

    function _handleEdit(id_categoria) {

        $("#windowEditar").data("kendoWindow").open().center().title("Adicionar Categoria")
        // alert("Hello World!");
        //var dataSourceDeletar = $('#gridPrincipal').data('kendoGrid').dataSource.get(id_categoria); 
        // $("#windowDeletar").data("kendoWindow").open().center().title("Adicionar Categoria")
        
        // var dataSourceDeletar = $('#gridPrincipal').data('kendoGrid').dataSource.get(id_categoria);  
        //$("#windowDeletar").data("kendoWindow").open().center().title("Excluir: "  + dataSourceDeletar.categoria); // centralizar titulo     
        //$('#spanDeletar').html(dataSourceDeletar.categoria); // carrega span para data 
        // dataitem = grid.dataItem($(event.currentTarget).closest("tr"));
        // kWindow.open();
    };


       
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
            $('[name="addCategoria"]').val("");							
            $('.alert-success').html('Categoria inserida com sucesso').fadeIn().delay(4000).fadeOut('slow');
            $("#windowAdicionar").data("kendoWindow").close(); // fehcar janela  
            $('#gridPrincipal').data('kendoGrid').dataSource.read();                            
        }
    });  
        return false; 
    });   

    

    
    function fecharWindow()
    {   
        $("#windowDeletar").data("kendoWindow").close(); 
        $("#windowCrud").data("kendoWindow").close();               
    }

    // function carregarGridCrud(selecionado){   
    //     $("#gridPrinciapl").data("kendoGrid").select(selecionado);
    // }


</script>


