<?php 	
    foreach($datos['noticias'] as $noticia) 
    { 
?>
<div class="content"> 						
    <h1 style="font-size:1.3em">
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
            
            //Obtengo el total de votos de esta noticia
            $totalVotos = get_total_votos($noticia['IdNoticia']);
            if($totalVotos == 1) $litTotalVotos = "(" . $totalVotos . " voto)";
            else $litTotalVotos = "(" . $totalVotos . " votos)";
        ?>
        <img src="<?= __URL__ . $imagen; ?>" alt="<?= $descripcion ?>" title="<?= $descripcion ?>">
        <a style="color: white;" href="<?= '/index.php/noticia?id=' . $noticia['IdNoticia'] ?>" title="Ampliar informacion de <?= $noticia['Titulo'] ?>"><?= $titulo ?></a>
    </h1>
    <p style="min-height:115px;">
        <img hspace="5" width="75" height="112" vspace="5" align="left" src="<?= __URL__ . $noticia['ImagenUrl']; ?> " alt="<?= $noticia['Titulo'] ?>" title="<?= $noticia['Titulo'] ?>">
    <?= $noticia['Resumen'] ?>...&nbsp;
    <a href="<?= __URL__ . '/index.php/noticia?id=' . $noticia['IdNoticia'] ?>" title="Ampliar informacion de <?= $noticia['Titulo'] ?>">Leer noticia completa...</a></p>
        
    <p  align="center">
        Valoración: <img width="72" height="15" src="/imagenes/val<?= round($noticia['Valoracion']) ?>.jpg" alt="Valoración" title="<?= $noticia['Valoracion'] ?> sobre 5"><?= $litTotalVotos ?>						
    </p>
    
    <div class="comment-meta commentmetadata" style="text-align: right;">
        <a href="#"><?php 
            $fecha = date_create($noticia['FechaAlta']);
            echo date_format($fecha, 'd/m/Y H:i:s'); 
        ?></a>
    </div>
</div>
<?php 	
    }
?>
