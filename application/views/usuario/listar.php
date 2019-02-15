<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Listar Usuário</h1>
    <a href="<?php echo base_url(); ?>usuario/adicionar" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="far fa-address-card"></i> Adicionar</a>
</div>

<!--Display Messages-->
<?php if($this->session->flashdata('usuario_salvado')) : ?>
    <?php echo '<p class="alert alert-success">' .$this->session->flashdata('usuario_salvado') . '</p>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('usuario_atualizado')) : ?>
    <?php echo '<p class="alert alert-success">' .$this->session->flashdata('usuario_atualizado') . '</p>'; ?>
<?php endif; ?>


<?php if($this->session->flashdata('usuario_deletado')) : ?>
    <?php echo '<p class="alert alert-danger">' .$this->session->flashdata('usuario_deletado') . '</p>'; ?>
<?php endif; ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de usuários</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">			
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Usuario</th>                        
                        <th>Email</th>
                        <th>Arquivo</th>
                        <th>Data de Criação</th>
                        <th>Data de Alteração</th>
                        <th>Operações</th>
                    </tr>
                </thead>
                <tbody>                 
                    <?php foreach ($usuario as $usuarios): ?>
                        <tr>
                            <td><?php echo $usuarios->id_usuario; ?></td>
                            <td><?php echo $usuarios->usuario; ?></td>
                            <td><?php echo $usuarios->email; ?></td>
                            <!-- <td><?php echo $usuarios->arquivo; ?></td> -->
                            <td><img src="<?php echo base_url()."./assets/uploads/usuario/".$usuarios->arquivo;?>" alt="" class="img-thumbnail" width="80" height="50"/></td>                                
                            <td><?php echo $usuarios->data_criacao; ?></td>
                            <td><?php echo $usuarios->data_alteracao; ?></td>                                                    
                            <td>
                                <a class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>usuario/editar/<?php echo $usuarios->id_usuario; ?>" ><i class="fas fa-user-edit"></i></a>
                                <a class="btn btn-danger btn-sm" href="<?php echo base_url(); ?>usuario/deletar/<?php echo $usuarios->id_usuario; ?>" onclick="return confirm('Deseja realmente excluir o usuário');"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>                
                </tbody>
            </table>
        </div>
    </div>           
</div>
