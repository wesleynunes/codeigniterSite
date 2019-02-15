<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Upload Realizado com Sucesso</title>	
	</head>
<body>

	<h3> Seu arquivo foi enviado com sucesso! </h3>

	<ul>

		<!-- Passamos pela variável $ upload, que é uma matriz que contém
        os valores relacionados ao upload do arquivo. 
        -->
		<?php foreach ($upload_data as $item => $value):?>
			<li><?php echo $item;?>: <?php echo $value;?></li>
		<?php endforeach; ?>
	
	</ul>

	<p>
		<!-- 
            Este é um ajudante, equivalente a uma tag <a href> </a>
            Ele redireciona você para voar para fazer upload de outro arquivo.
		 -->
		<?php echo anchor('oficina/upload', 'Upload de outro arquivo!'); ?>
	</p>

</body>
</html>