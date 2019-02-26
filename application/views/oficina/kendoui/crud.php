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
    <script>
        $(document).ready(function () {        
            $("#gridCrud").kendoGrid({
                dataSource: {
                    type: "post",      
                    dataType: "json",             
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
                        template:'<button class="btn btn-primary btn-mini"><i class="far fa-edit"></i></button>'
                    }, 
                    { 
                        field: "",
                        title: "Deletar",
                        width: 10, 
                        attributes:{style:"text-align:center;"}, 
                        headerAttributes:{style:"text-align:center;"}, 
                        // headerTemplate:"Deletar", 
                        template:'<button class="btn btn-danger btn-mini"><i class="far fa-trash-alt"></i></button>'
                    },
                ],                        
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
                // alert("Hello World!");    
                dados={        
                        categoria: $('#categoria').val(),                           
                };       
                $.post('<?php echo base_url(); ?>oficina/kendoui/crud/create/create', {"dados":$.toJSON(dados)}, function(data){      
                    $('#winMsg').html(data.msg); 
                    $("#winMsg").dialog("option","maxHeight",220).dialog("open");
                    $('.ui-dialog').css('z-index','10030');
                    $('.ui-widget-overlay').css('z-index','10005');
                    $('#gridCrud').data('kendoGrid').dataSource.read();
                    $( "#winMsg" ).on( "dialogclose", function( event, ui ) {$('#windowCrud').data('kendoWindow').close();} );  
                    carregarGridGrupo(selecionado); // funçao para carregar grid selecionada.    
                },'json').
                fail(function(e) {        
                    $("#MsgErroWinDatasNaci").html("<i class=\"icon-thumbs-down\"></i>A Data já está <span class=\"label label-important\">Cadrastada</span>em um Município!");
                    setTimeout(function(){ $("#MsgErroWinDatasNaci").html(''); }, 6000);  // seta mensagen com erro de data já cadrastada
                });

            });

            FecharVar.click(function() {
                $("#windowCrud").data("kendoWindow").close(); // fehcar janela                   
            });




           
        




            // // funçao para salvar datas nacionais
            // function salvar()
            // {                  


            //     if(!categoriaValida()){     
            //         }else{     
            //         dados={        
            //             categoria: $('#categoria').val(), //                           
            //         };       
            //         $.post('<?php echo base_url(); ?>oficina/kendoui/crud/create', {"dados":$.toJSON(dados)}, function(data){      
            //             $('#winMsg').html(data.msg); 
            //             $("#winMsg").dialog("option","maxHeight",220).dialog("open");
            //             $('.ui-dialog').css('z-index','10030');
            //             $('.ui-widget-overlay').css('z-index','10005');
            //             $('#gridCrud').data('kendoGrid').dataSource.read();
            //             $( "#winMsg" ).on( "dialogclose", function( event, ui ) {$('#windowCrud').data('kendoWindow').close();} );  
            //             carregarGridGrupo(selecionado); // funçao para carregar grid selecionada.    
            //         },'json').
            //         fail(function(e) {        
            //             $("#MsgErroWinDatasNaci").html("<i class=\"icon-thumbs-down\"></i>A Data já está <span class=\"label label-important\">Cadrastada</span>em um Município!");
            //             setTimeout(function(){ $("#MsgErroWinDatasNaci").html(''); }, 6000);  // seta mensagen com erro de data já cadrastada
            //         });
            //     }
            // }


            //função para validar datas Novas 
            function categoriaValida()
            {     
                // var categoriaVazio = undefined; // variavel com informaçao vazia (undefined = vazio)
                // var validoCampoVazio = true; // validar campos vazios
                // var categoriaClone = true; // valida campos data iquais
                // var categoriaDados = $('#gridCrud').data('kendoGrid').dataSource.get(id_categoria); // tras categorias cadastradas  
                                   

                // if($.trim($("#categoria").val()).length == 0){ // controle de datas vazias      
                //     validoCampoVazio = false;     
                // }

                // // carrega caixa de dialog para datas que estejão cadastradas. 
                // if(!categoriaClone)
                // {
                //     $("#MsgErroWinDatas").html("<i class=\"icon-thumbs-down\"></i>A Data já está <span class=\"label label-important\">Cadrastada</span>!");
                //     setTimeout(function(){ $("#MsgErroWinDatas").html(''); }, 5000);
                //     return false;    
                // } 
            }
        });
    </script>
</div>


