<script src="<?php echo base_url(); ?>assets/painel/vendor/jquery/jquery.min.js"></script>


<div id="winGrupoMunic">
    <p>Teste</p>
</div>


    <script>
        </script>
    
            <button class="btn btn-small btn-primary" id="novoGrupoMunic" onclick="novoGrupoMunic()"> 
        </button> 
  
        
     
        
 



    <!-- <a onclick="novoGrupoMunic()"><i class="icon-hand-right"></i> Município</a> -->

    <!-- <button             
        class="btn btn-small btn-primary"
        onclick="novoGrupoMunic()"              
        id="novoGrupoMunic"> 
        <i class="icon-calendar icon-white">Adicionar</i>
    </button> -->

    <!-- <script id="teste">         
        
        <button class="btn btn-small btn-primary" id="novoGrupoMunic" onclick="novoGrupoMunic()" disabled="true"> 
        <i class="icon-calendar icon-white"></i>Teste</button> 
        
    </script> -->


   

<script>
        $(document).ready(function() 
        {
            
            $('#winGrupoMunic').kendoWindow({
                width:"405",
                height:"245",
                modal: true,
                visible: false,
                resizable: false,
                close: function(){
                    limparDados();       
                }
            });

        
            function novoGrupoMunic()
            {       
                $("#winGrupoMunic").data("kendoWindow").open().center().title("GRUPO: <Município>");      
            } 
        });
</script>



<!-- <div id="example">

    <div id="windowNovo" style="padding-left:15px; padding-right:15px">
        <p>Tecnologia.</p>
    </div> 

          
    <button class="btn btn-small btn-primary"  onclick="novo()"><i class="icon-calendar icon-white">Adicionar</i></button>                 
                            

    <div id="window">
        <h4>Armchair 402</h4>                
        <p>Alvar Aalto is one of the greatest names in modern architecture and design. Glassblowers at the iittala factory still meticulously handcraft the legendary vases that are variations on one theme, fluid organic shapes that let the end user decide the use. Interpretations of the shape in new colors and materials add to the growing Alvar Aalto Collection that remains true to his original design.</p>

        <p>Born Hugo Alvar Henrik Aalto (February 3, 1898 - May 11, 1976) in Kuortane, Finland, was noted for his humanistic approach to modernism. He studied architecture at the Helsinki University of Technology from 1916 to 1921. In 1924 he married architect Aino Marsio.</p>

        <p>Alvar Aalto was one of the first and most influential architects of the Scandinavian modern movement, and a member of the Congres Internationaux d'Architecture Moderne. Major architectural works include the Finlandia Hall in Helsinki, Finland, and the campus of Helsinki University of Technology.</p>
    </div>

    <span id="undo" style="display:none" class="k-button hide-on-narrow">Click here to open the window.</span>

    <div class="responsive-message"></div>

    <script>
        $(document).ready(function() {


            function novo()
            {       
                $("#windowNovo").data("kendoWindow").open().center().title("novo"); // centralizar titulo        
            } 

            // janela winGrupoMunic, janela para formatar Grupos Municipios (janela Grupo Municipio)
            $('#windowNovo').kendoWindow({
                width:"405",
                height:"245",
                modal: true,
                visible: false,
                resizable: false,
                
            });

            var myWindow = $("#window"),
                undo = $("#undo");

            undo.click(function() {
                myWindow.data("kendoWindow").open();
                undo.fadeOut();
            });

            function onClose() {
                undo.fadeIn();
            }

            myWindow.kendoWindow({
                width: "600px",
                title: "About Alvar Aalto",
                visible: false,
                actions: [
                    "Pin",
                    "Minimize",
                    "Maximize",
                    "Close"
                ],
                close: onClose
            }).data("kendoWindow").center().open();
        });
    </script>         
</div> -->

