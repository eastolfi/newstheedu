<?php
    $datos['noticias'] = get_mas_visitadas_noticias();        
?>

<div class="widget">
    <h3>Entradas más visitadas</h3>
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
            if($noticia['Visitas'] == 1) $totComent = "(1 visita)";
            else $totComent = "(" . $noticia['Visitas'] . " visitas)"
        ?>                        
            <li>
                <img width="16" height="16" src="<?= __URL__ . $imagen; ?>" alt="<?= $descripcion ?>" title="<?= $descripcion ?>">
                <a href="<?= __URL__ . '/index.php/noticia?id=' . $noticia['IdNoticia'] ?>" title="Ampliar informacion de <?= $noticia['Titulo'] ?>"><?= $titulo ?> </a>&nbsp;<?= $totComent ?>
            </li>		
        <?php 	
        }
        ?>
    </ul>
</div>