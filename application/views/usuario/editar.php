

<form method="post" action="<?php echo base_url(); ?>usuario/atualizar/<?php echo $usuario->id_usuario; ?>">
<div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-0 text-gray-800">Editar Usuário</h1>
        </div>
        <div class="col-md-6">
            <div class="float-right">
                <button  class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" name="submit"  type="submit" id="page_submit">
                    <i class="far fa-edit"></i><a> Editar</a>
                </button>      
                <a href="<?php echo base_url(); ?>usuario/listar" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-undo-alt"></i> Voltar</a>
            </div>
        </div>
    </div>
    &nbsp
    <!-- <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="<?php echo base_url(); ?>admin/users"><i class="fa fa-pencil"></i> Users</a></li>
                <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-plus-square-o"></i> Edit User</li>
            </ol>
        </div>
    </div> -->
    <div class="card shadow mb-4">
    <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Editar usuário</h6>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label>Usuario</label>
                <input class="form-control" type="text" name="usuario" value="<?php echo $usuario->usuario; ?>" placeholder="" />
            </div>         
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" type="email" name="email" value="<?php echo $usuario->email; ?>" placeholder="" />
            </div>
            <div class="form-group">
                <label>Senha</label>
                <input class="form-control" type="password" name="senha" value="<?php echo $usuario->senha; ?>" placeholder="" />
            </div>
            <div class="form-group">
                <label>Arquivo</label>
                <input class="form-control" type="text" name="arquivo" value="<?php echo $usuario->arquivo; ?>" placeholder="" />
            </div>
        </div><!-- /.row -->
</form>