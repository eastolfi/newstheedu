<?php
    $totLibros = get_total_noticias(1);
    $totPelis = get_total_noticias(2); 
    $paramVista = "&vw=" . $vw;
?>

<div class="widget">
    <h3>Categorías</h3>
    <ul>
            <li class="cat-item cat-item-2">
                <a href="<?= __URL__ . '/index.php/noticias?cat=1' . $paramVista ?>" title="Mostrar noticias de libros">Libros</a> (<?= $totLibros ?>)
	   </li>
	   <li class="cat-item cat-item-1">
                <a href="<?= __URL__ . '/index.php/noticias?cat=2' . $paramVista ?>" title="Mostrar noticias de películas">Películas</a> (<?= $totPelis ?>)
	   </li>           					
   </ul>
</div>	