<script src="<?php echo base_url(); ?>assets/painel/vendor/jquery/jquery.min.js"></script>

<div id="example">
    <div id="grid"></div>
    <script>
        $(document).ready(function () {
            var crudServiceBaseUrl = "<?php echo base_url(); ?>oficina/kendoui",
                dataSource = new kendo.data.DataSource({
                    transport: {
                        read:  {
                            url: crudServiceBaseUrl + "/read/read",
                            type: "POST",
                            dataType: "json"
                        },
                        update: {
                            url: crudServiceBaseUrl + "/Update",
                            type: "POST",
                            dataType: "json"
                        },
                        destroy: {
                            url: crudServiceBaseUrl + "/Destroy/id_categoria",
                            type: "POST",
                            dataType: "json"
                        },
                        create: {
                            url: crudServiceBaseUrl + "/create/create",
                            type: "post",
                            dataType: "json"
                        },
                        parameterMap: function(options, operation) {
                            if (operation !== "read" && options.models) {
                                return {models: kendo.stringify(options.models)};
                            }
                        }
                    },
                    batch: true,
                    pageSize: 20,
                    schema: {
                        model: {
                            id: "id_categoria",
                            fields: {
                                id_categoria: { editable: false },
                                // categoria: { validation: { required: true } },
                                categoria: { required: true },
                                data_criacao: { editable: false },
                                data_alteracao: { editable: false },
                            }
                        }
                    }
                });

            $("#grid").kendoGrid({
                dataSource: dataSource,
                pageable: true,
                height: 550,
                toolbar: ["create"],
                columns: [
                    { field:"id_categoria", title: "ID", width: "80px" },
                    { field: "categoria", title:"CATEGORIA", width: "120px" },
                    { field: "data_criacao", title:"DATA DE CRIACAO", width: "120px" },
                    { field: "data_alteracao", title:"DATA DE ALTERACAO", width: "120px", editor: customBoolEditor },
                    //{ command: ["destroy"], title: "&nbsp;", width: "120px", template:'<button id="${id_categoria}" onclick="confirmeDelete( \'${id_categoria}\')"></button>' }],
                    { command: ["edit", "destroy"], title: "&nbsp;", width: "120px" }],
                editable: "popup"

                //{ field: "", width: 15, attributes:{style:"text-align:center;"}, headerAttributes:{style:"text-align:center;"}, headerTemplate:"<i class=icon-trash icon-black>", template:'<button id="${DATA}" onclick="confirmeDelete( \'${ CODTABFOLGA }${DATA}\')" class="btn btn-danger btn-mini"><i class="icon-trash icon-white"></button>'}        
       

            });
        });

        function customBoolEditor(container, options) {
            var guid = kendo.guid();
            $('<input class="k-checkbox" id="' + guid + '" type="checkbox" name="Discontinued" data-type="boolean" data-bind="checked:Discontinued">').appendTo(container);
            $('<label class="k-checkbox-label" for="' + guid + '">&#8203;</label>').appendTo(container);
        }
    </script>
</div>


