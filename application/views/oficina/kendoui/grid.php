<script src="<?php echo base_url(); ?>assets/painel/vendor/jquery/jquery.min.js"></script>

<div id="example">
    <div id="grid"></div>     
    <script>   
        $(document).ready(function () {        
            $("#grid").kendoGrid({
                dataSource: {
                    type: "post",      
                    dataType: "json",             
                    transport: 
                    {                        
                      read: {
                        url:"<?php echo base_url(); ?>oficina/kendoui/grid/read",
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
                    {field: "id_categoria", title: "ID", width: 2},
                    {field: "categoria", title: "CATEGORIA", width: 10},
                    {field: "data_criacao", title: "DATA DE CRIAÇÃO", width: 5},
                    {field: "data_alteracao", title: "DATA DE ALTERAÇÃO", width: 5},
                ]
            });
        });
    </script>
</div>

<style type="text/css">
    .customer-photo {
        display: inline-block;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background-size: 32px 35px;
        background-position: center center;
        vertical-align: middle;
        line-height: 32px;
        box-shadow: inset 0 0 1px #999, inset 0 0 10px rgba(0,0,0,.2);
        margin-left: 5px;
    }

    .customer-name {
        display: inline-block;
        vertical-align: middle;
        line-height: 32px;
        padding-left: 3px;
    }
</style>


