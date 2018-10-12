<?php
    $datos['noticias'] = get_mas_comentadas_noticias();    
    $totComent = 12;
?>

<div class="widget">
	<h3>Entradas más comentadas</h3>
	<ul>
             <?php 	
            foreach($datos['noticias'] as $noticia) 
            {
                if($noticia['IdCategoria'] == 1) {
                    $descripcion = "Libro";
                    $imagen = "/imagenes/libro.png";                    
                } else if($noticia['IdCategoria'] == 2) {
                    $descripcion = "Película";
                    $imagen = "/imagenes/peli.png";                    
                }
                
                $titulo = $noticia['Titulo'];
            ?>                
        <!--    <li><a href="#" title="La Viajera del Tiempo - Lorena Franco">La Viajera del Tiempo</a> (389 votos)</li>	-->
                <li>
                    <img width="16" height="16" src="<?= __URL__ . $imagen; ?>" alt="<?= $descripcion ?>" title="<?= $descripcion ?>">
                    <a href="<?= __URL__ . '/index.php/noticia?id=' . $noticia['IdNoticia'] ?>" title="Ampliar informacion de <?= $noticia['Titulo'] ?>"><?= $titulo ?> </a>&nbsp;(<?= $totComent ?>&nbsp;comentarios)
                </li>		
            <?php 	
            }
            ?>
	</ul>
</div>