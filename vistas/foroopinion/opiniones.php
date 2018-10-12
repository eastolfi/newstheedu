<!-- OPINIONES -->
<?php
    $datos['opiniones'] = get_opiniones($idNoticia);        
    $datosUsuario = get_id($_SESSION['sesion_user']);   
    $idUsuario = $datosUsuario['idUsuario'];
?>

<h3 id="comments">
    <?php 
        if(count($datos['opiniones']) == 1) {
            echo "1 comentario a '" . $noticia[0]["Titulo"] . "'";
        } else {
            echo count($datos['opiniones']) . " comentarios a '" . $noticia[0]["Titulo"] . "'";
        }
     ?>
</h3>

<div class="navigation">
    <div class="alignleft"></div>
    <div class="alignright"></div>
</div>

<ol class="commentlist">
    <?php 	
        foreach($datos['opiniones'] as $opinion) 
        {
    ?>        
            <li class="comment even thread-even depth-1 parent" id="comment-5">
                <div id="div-comment-5" class="comment-body">
                    <div class="comment-author vcard">
                        <img alt="" src="<?= __URL__ . '/imagenes/silueta.png' ?>" class="avatar avatar-32 photo" height="32" width="32">
                        <cite class="fn"><?= $opinion['Usuario'] ?></cite><span class="says">dice:</span>
                    </div>
                    <div class="comment-meta commentmetadata">
                        <a href="#"><?php 
                            $fecha = date_create($opinion['FechaAlta']);
                            echo date_format($fecha, 'd/m/Y H:i:s'); 
                        ?></a>
                    </div>
                    <p><?= $opinion['Comentario'] ?></p>
                    <div class="reply">
                        <a rel="nofollow" class="comment-reply-link" href="#" onclick="return addComment.moveForm( &quot;div-comment-204465&quot;, &quot;204465&quot;, &quot;respond&quot;, &quot;6263&quot; )" aria-label="Responder a Luis Enrique">Responder</a>
                    </div>
                </div>
                
                <?php require($_SERVER['DOCUMENT_ROOT'] . '/vistas/foroopinion/respuestas.php'); ?>

            </li>
    <?php 	
        }
    ?>
</ol>