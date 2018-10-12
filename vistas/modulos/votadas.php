<?php
    $datos['noticias'] = get_mas_votadas_noticias();   
    //var_dump($datos);    
?>

<div class="widget">
	<h3>Entradas más votadas</h3>
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
                $totalVotos = get_total_votos($noticia['IdNoticia']);
                if($totalVotos == 1) $totVotos = "(1 voto)";
                else $totVotos = "(" . $totalVotos . " votos)"
                
            ?>                       
                <li>
                    <img width="16" height="16" src="<?= __URL__ . $imagen; ?>" alt="<?= $descripcion ?>" title="<?= $descripcion ?>">
                    <a href="<?= __URL__ . '/index.php/noticia?id=' . $noticia['IdNoticia'] ?>" title="Ampliar informacion de <?= $noticia['Titulo'] ?>"><?= $titulo ?> </a>&nbsp;<?= $totVotos ?>
                </li>		
            <?php 	
            }
            ?>
	</ul>
</div>