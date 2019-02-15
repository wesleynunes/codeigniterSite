<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Upload Formulario</title>
</head>
<body>
	<h1>Upload de imagens CodeIgniter 2.2.6</h1>	
	<!-- 
        Mostar menssagen de erro se houver
    -->
	<?php echo $error;?>

	<!-- Abrir um formulário com o auxiliar CodeIgniter é o mesmo que um
    tag form, você deve necessariamente adicionar o enctype = "multipart / form-data 
    -->
	<!-- 
        <form action="http://localhost/ci_upload/index.php/upload/do_upload" 
		  method="post" accept-charset="utf-8" enctype="multipart/form-data"> 
    -->
	<?php echo form_open_multipart('oficina/upload/do_upload');?>

		<!-- tag de entrada de arquivo -->
		<input type="file" name="userfile" size="20" />

		<br /><br />

		<input type="submit" value="upload" />

	<?php  echo form_close(); ?>
	<!-- O formulário está fechado, estamos usando o auxiliar do CodeIgniter. -->
	<!--</form>-->
	<!-- -->

</body>
</html>