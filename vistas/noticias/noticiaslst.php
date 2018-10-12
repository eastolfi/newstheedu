
<div class="content">
<?php 	
    foreach($datos['noticias'] as $noticia) 
    { 
?>
    
    
    <?php
        if($noticia['IdCategoria'] == 1) {
            $descripcion = "Libro";
            $imagen = "/imagenes/libro.png";
            $titulo = $noticia['Titulo'] . " - " .  $noticia['MetaAutor'];                
        } else if($noticia['IdCategoria'] == 2) {
            $descripcion = "Película";
            $imagen = "/imagenes/peli.png";
            $titulo = $noticia['Titulo'] . " (" . $noticia['Ano'] . ")";
        }

        $tituloOriginal = $noticia['TituloOriginal'];
        //Obtengo el total de votos de esta noticia
        $totalVotos = get_total_votos($noticia['IdNoticia']);
        if($totalVotos == 1) $litTotalVotos = "(" . $totalVotos . " voto)";
        else $litTotalVotos = "(" . $totalVotos . " votos)";
    ?>
       
    <p style="min-height:57px;">        
        <img hspace="3" width="37" height="56" vspace="5" align="left" src="<?= __URL__ . $noticia['ImagenUrl']; ?> " alt="<?= $noticia['Titulo'] ?>" title="<?= $noticia['Titulo'] ?>">            
        <a href="<?= __URL__ . '/index.php/noticia?id=' . $noticia['IdNoticia'] ?>" title="Ampliar informacion de <?= $noticia['Titulo'] ?>">
            <?= $titulo ?>
        </a>
        <br/>(<?= $tituloOriginal ?>)
        <br/>
        <img width="16" height="16" src="<?= __URL__ . $imagen; ?>" alt="<?= $descripcion ?>" title="<?= $descripcion ?>">
        
        <img width="72" height="15" src="/imagenes/val<?= round($noticia['Valoracion']) ?>.jpg" alt="Valoración" title="<?= $noticia['Valoracion'] ?> sobre 5">
    </p>
    <hr>
<?php 	
    }
?>
</div>