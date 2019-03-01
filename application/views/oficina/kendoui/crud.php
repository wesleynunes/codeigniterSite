<script src="<?php echo base_url(); ?>assets/painel/vendor/jquery/jquery.min.js"></script>

<div>
    <div id="gridCrud">   
        <button         
            class="btn btn-small btn-primary"               
            id="adicionar"> 
            <i class="far fa-plus-square">Adicionar</i>
        </button>
    </div>
    <div id="windowCrud">
        <div class="col-lg-8">
            <div class="form-group">
                <label>Categoria</label>
                <input id="categoria" class="form-control" type="text" name="categoria"  placeholder="" required="required"  />
            </div> 
            <div style="float: left; margin-left:115px; margin-top:20px; width: 185px;">
                <button id="salvar" class="btn btn-success">Salvar</button>&nbsp; 
                <button id="fechar" class="btn btn-danger">Cancelar</button>                          
            </div>      
        </div>
    </div>
    <div id="winDeletar" style="padding-left:15px; padding-right:15px">
          <div style="clear:both; margin-top: 10px; float: left; width: px;">             
          <div style="width: 280px; float: left;">            
             A Categoria: <strong><span id="spanDeletar"></span></strong> séra excluida!</p>
          </div>
          <div style="clear:both;  margin-left:80px; margin-top: 5px; float: left; width: 170px;">
            <button id="btnSalvar" class="btn btn-success" onclick="deletar()">Excluir</button>&nbsp;                   
            <button class="btn btn-danger" onclick="fecharWindow()">Cancelar</button>   
          </div> 
        </div> <!-- end winDelete -->    
    </div>
<script>
    $(document).ready(function () {        
        $("#gridCrud").kendoGrid({
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
            selectable: true, 
            pageable: {
                refresh: true,
                pageSizes: true,
                buttonCount: 5
            },
            columns: 
            [
                {field: "id_categoria", title: "ID", width: 5},
                {field: "categoria", title: "CATEGORIA", width: 30},
                {field: "data_criacao", title: "DATA DE CRIAÇÃO", width: 20},
                {field: "data_alteracao", title: "DATA DE ALTERAÇÃO", width: 20},
                {
                    field: "",
                    title: "Editar", 
                    width: 10, 
                    attributes:{style:"text-align:center;"},
                    headerAttributes:{style:"text-align:center;"}, 
                    //headerTemplate:"Editar", 
                    template:'<button onclick="editar()"  class="btn btn-primary btn-mini"><i class="far fa-edit"></i></button>'
                },  
                { 
                    field: "",
                    title: "Deletar",
                    width: 10, 
                    // attributes:{style:"text-align:center;"}, 
                    // headerAttributes:{style:"text-align:center;"}, 
                    // headerTemplate:"Deletar", 
                    template:'<button id="${id_categoria}"  onclick="confirmarDeletar( \'${id_categoria}\')" class="btn btn-danger btn-mini"><i class="far fa-trash-alt"></i></button>'
                },
            ], 
            change: function(e) {
                var selectedRows = this.select();
                var dataItem = this.dataItem(selectedRows);
                var id_categoria = dataItem.id_categoria; // pega codigo da gridGrupo     
                atualizaGridData() // atualiza as datas na gridDatas
            },                       
        });
   
    
        var myWindowCrud = $("#windowCrud"),
            adicionar = $("#adicionar");

        adicionar.click(function() {
            myWindowCrud.data("kendoWindow").open();      
            undo.fadeOut();
        });

        function onClose() {
            adicionar.fadeIn();
            
        }

        myWindowCrud.kendoWindow({
            width: "600px",
            title: "Adicionar",                
            visible: false,
            resizable: false,
            actions: [
                //"Pin", // abre a kendo window sempre que atualizar ou abrir a pagina crud
                "Minimize",
                "Maximize",
                "Close"
            ],
            close: onClose
        }).data("kendoWindow").center();

              
        // variavel para salvar
        var salvarVar = $("#salvar");

        //variavel para fechar janela kendowindow
        var FecharVar = $("#fechar");
       
        salvarVar.click(function() {
            alert("Hello World!");    
        });

        FecharVar.click(function() {
            $("#windowCrud").data("kendoWindow").close(); // fehcar janela                   
        });  


        $('#winDeletar').kendoWindow({
            width:"295", 
            height:"140",
            modal: true,
            visible: false,
            resizable: false,           
            close: function(e){                              
            }         
        }); 


               
    });   

    function confirmarDeletar(id_categoria) {
        //alert("Hello World!"); 
        var dataSourceDeletar = $('#gridCrud').data('kendoGrid').dataSource.get(id_categoria);  
        $("#winDeletar").data("kendoWindow").open().center().title("Excluir: "  + dataSourceDeletar.categoria); // centralizar titulo     
        $('#spanDeletar').html(dataSourceDeletar.categoria); // carrega span para data 
    }

    function deletar() {
        //alert("Hello World!");
        var id_categoria = $("#gridCrud").data("kendoGrid").dataItem($("#gridCrud").data("kendoGrid").select()).id_categoria;
        var selecionado =  $("#gridCrud").data("kendoGrid").select();   
        dados ={    
            IDCATEGORIA: id_categoria, // captura CODTABFOLGA para ser deletada 
        }; 
        $.post('<?php echo base_url(); ?>oficina/kendoui/destroy', {"dados":$.toJSON(dados)}, function(data) {     
            $('#gridCrud').data('kendoGrid').dataSource.read();
            $( "#winMsg" ).on( "dialogclose", function( event, ui ) {$('#winDeletar').data('kendoWindow').close();} );
            carregarGridCrud(selecionado);   
        },'json');             
        
    }

    function fecharWindow()
    {   
        $("#winDeletar").data("kendoWindow").close(); // fehcar janela               
    }

    function carregarGridCrud(selecionado){   
        $("#gridCrud").data("kendoGrid").select(selecionado);
    }


</script>


