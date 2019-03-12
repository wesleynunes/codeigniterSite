<div class="card shadow mb-4">
    <!--Display form validation errors-->

    <?php 
        if(isset($error)):
            echo "<div class='alert alert-danger'>".$error."</div>";
        endif; 
        echo validation_errors('<p class="alert alert-dismissable alert-danger">');         

        if($this->session->flashdata('categoria_salvado')) :
            echo '<p class="alert alert-success">' .$this->session->flashdata('categoria_salvado') . '</p>';
        endif;
      
        if($this->session->flashdata('categoria_deletada')) :
            echo '<p class="alert alert-success">' .$this->session->flashdata('categoria_deletada') . '</p>';
        endif;
    ?>

    <div class="card-body">
        <form  class="form-inline" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>categoria/salvar">
            <label class="sr-only" for="inlineFormInputGroupUsername2">Username</label>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                <div class="input-group-text">Categoria</div>
            </div>
                <input id="categoria" type="text" name="categoria" class="form-control" value="<?php echo set_value('categoria'); ?>" placeholder="">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Salvar</button>
        </form>
    </div>
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de usuários</h6> 
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">			
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Categoria</th>                        
                        <th>Data de Criação</th>
                        <th>Data de Alteração</th>                   
                        <th>Operações</th>
                    </tr>
                </thead>
                <tbody>                 
                    <?php foreach ($categoria as $row): ?>
                        <tr>
                            <td><?php echo $row->id_categoria; ?></td>
                            <td><?php echo $row->categoria; ?></td>                                        
                            <td><?php echo $row->data_criacao; ?></td>
                            <td><?php echo $row->data_alteracao; ?></td>                                                    
                            <td>
                                <a class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>usuario/editar/<?php echo $row->id_categoria; ?>" ><i class="fas fa-user-edit"></i></a>
                                <a class="btn btn-danger btn-sm" href="<?php echo base_url(); ?>categoria/deletar/<?php echo $row->id_categoria; ?>" onclick="return confirm('Deseja realmente excluir a categoria');"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>                
                </tbody>
            </table>
        </div>
    </div>           
</div>
