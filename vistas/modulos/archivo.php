<?php
    $meses = array('enero','febrero','marzo','abril','mayo','junio','julio', 'agosto','septiembre','octubre','noviembre','diciembre');
    $iniAno = 2015;
    $finAno = date("Y");
    $paramVista = "&vw=" . $vw; 
    
//    if(empty($_SESSION['expand'])) {
//        $estadoDiv = "style='display:none;'";  
//        $_SESSION['expand'] = "none";
//    } else {
//        $estadoDiv = "";
//    }
?>

<div class="widget">
    <h3>Archivo</h3>        
    <ul>
        <?php 	
        for ($ano = $iniAno; $ano <= $finAno; $ano++)
        {
            for ($mes=1; $mes < sizeof($meses) + 1; $mes++)
            { 
                $datos['archivo'] = get_archivo_noticias($mes, $ano);
                $tot_mes_ano = get_total_noticias_mes_ano($mes, $ano);
                $lnkLiteral = $meses[$mes - 1] . "&nbsp;" . $ano;

                if(sizeof($datos['archivo']) > 0) {                    
        ?>                
                <li class="cat-item cat-item-1">                        
                    <a id="lnk<?= $ano . $mes ?>" href="javascript:expandDiv('div<?= $ano . $mes ?>', 'lnk<?= $ano . $mes ?>', '<?= $lnkLiteral ?>')" title="Noticias mes de <?= $meses[$mes - 1] ?>">+&nbsp;<?= $meses[$mes - 1] ?>&nbsp;<?= $ano ?></a>&nbsp;(<?= $tot_mes_ano ?>)                        
                    <div id="div<?= $ano . $mes ?>" style='display:none;'>
                        <?php 
                        foreach($datos['archivo'] as $noticia_archivo) 
                        {
                            if($noticia_archivo['IdCategoria'] == 1) {
                                $descr_arch = "Libro";
                                $img_arch = "/imagenes/libro.png";                    
                            } else if($noticia_archivo['IdCategoria'] == 2) {
                                $descr_arch = "Película";
                                $img_arch = "/imagenes/peli.png";                    
                            }

                            $tit_arch = $noticia_archivo['Titulo'];
                        ?>
                            <img width="16" height="16" src="<?= __URL__ . $img_arch; ?>" alt="<?= $descr_arch ?>" title="<?= $descr_arch ?>">
                            <a href="<?= __URL__ . '/index.php/noticia?id=' . $noticia_archivo['IdNoticia'] ?>" title="Ampliar informacion de <?= $noticia_archivo['Titulo'] ?>"><?= $tit_arch ?> </a></br>
                        <?php                                       
                        } 
                        ?>
                    </div>
                </li>            
                <?php                       
                } 
            }
        } ?>
    </ul>
</div>
