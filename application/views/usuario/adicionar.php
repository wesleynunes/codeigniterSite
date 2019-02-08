
<!--Display form validation errors-->
<?php echo validation_errors('<p class="alert alert-dismissable alert-danger">'); ?>

<form method="post" action="<?php echo base_url(); ?>usuario/salvar">
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-0 text-gray-800">Adicionar novo usuário</h1>
        </div>
        <div class="col-md-6">
            <div class="float-right">
                <button  class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" name="submit"  type="submit" id="page_submit">
                    <i class="far fa-save"></i><a> Salvar</a>
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
                <li class="breadcrumb-item active"><a href="<?php echo base_url(); ?>usuario/listar"><i class="fa fa-pencil"></i> Users</a></li>
                <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-plus-square-o"></i> Add User</li>
            </ol>
        </div>
    </div> -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Adicionar usuário</h6>
        </div>
        &nbsp
        <div class="col-lg-8">
            <div class="form-group">
                <label>Usuario</label>
                <input class="form-control" type="text" name="usuario" value="<?php echo set_value('usuario'); ?>" placeholder="" />
            </div>         
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" type="email" name="email" value="<?php echo set_value('email'); ?>" placeholder="" />
            </div>        
            <div class="form-group">
                <label>Password</label>
                <input class="form-control" type="password" name="senha" value="<?php echo set_value('senha'); ?>" placeholder="" />
            </div>
            <div class="form-group">
                <label>Nome Completo</label>
                <input class="form-control" type="text" name="arquivo" value="<?php echo set_value('arquivo'); ?>" placeholder="" />
            </div>               
        </div>
</form>
















<!-- Page Heading
<h1 class="h3 mb-2 text-gray-800">Adicionar Usuário</h1>
<p class="mb-4">Chart.js is a third party plugin that is used to generate the charts in this theme. The charts below have been customized - for further customization options, please visit the <a target="_blank" href="https://www.chartjs.org/docs/latest/">official Chart.js documentation</a>.</p>

<div class="card shadow mb-4">
	<form method="post" action="<?php echo base_url();?>usuario/adicionar" enctype="multipart/form-data">

		<div class="col-md-4">
			<div class="form-group">
				<label>Usuario:</label>
				<input type="text" name="Usuario" class="form-control" value="<?=set_value('Usuario')?>" required/>
			</div>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				<label>Nome Completo:</label>
				<input type="text" name="NomeCompleto" class="form-control" value="<?=set_value('NomeCompleto')?>" required/>
			</div>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				<label>Email:</label>
				<input type="email" name="Email" class="form-control" value="<?=set_value('Email')?>" required/>
			</div>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				<label>Senha:</label>
				<input type="password" name="Senha" class="form-control" value="<?=set_value('Senha')?>" required/>
			</div>
		</div>
		<div class="col-md-4">
			<label><em>Todos os campos são obrigatórios.</em></label>
			<div class="clearfix"></div>
			<input type="submit" value="Salvar" class="btn btn-success" />
		</div>
	</form>
</div> -->