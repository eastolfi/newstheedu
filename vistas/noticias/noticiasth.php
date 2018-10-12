
<div class="contenedor_img_th">  
<?php 	
    foreach($datos['noticias'] as $noticia) 
    {    
        if($noticia['IdCategoria'] == 1) {
            $descripcion = "Libro";
            $imagen = "/imagenes/libro.png";
            //$titulo = $noticia['Titulo']; . "<br /> (" .  $noticia['MetaAutor'] . ")";
            $subTitulo = "(" .  $noticia['MetaAutor'] . ")";
        } else if($noticia['IdCategoria'] == 2) {
            $descripcion = "Película";
            $imagen = "/imagenes/peli.png";
            //$titulo = $noticia['Titulo'] . "<br /> (" . $noticia['Ano'] . ")";
            $subTitulo = "(" .  $noticia['Ano'] . ")";
        }
        
        $titulo = $noticia['Titulo']; 
?>        
    <div class="galleryItem">
        <img hspace="5" vspace="5" align="center" src="<?= __URL__ . $noticia['ImagenUrl']; ?> " alt="<?= $noticia['Titulo']  ?>" title="<?= $noticia['Titulo'] ?>" width="100" height="150">
        
                
        <a href="<?= __URL__ . '/index.php/noticia?id=' . $noticia['IdNoticia'] ?>" title="Ampliar informacion de <?= $noticia['Titulo'] ?>">
          <h3 style="height:30px"><?= $titulo ?></h3>
        </a>
        
        <h3 style="height:30px"><?= $subTitulo ?></h3>        
        <p class="puntua_th"><?= $noticia['Valoracion'] ?></p>        
        <img width="16" height="16" src="<?= __URL__ . $imagen; ?>" alt="<?= $descripcion ?>" title="<?= $descripcion ?>">
    </div>        
<?php
    }
?>    
</div>
