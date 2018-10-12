<!-- RESPUESTAS -->
<?php
    $idComentario = $opinion['idComentario'];
    $datos['respuestas'] = get_respuestas($idComentario);    
?>


<ul class="children" style="margin-left: 35px;width: 92%;">
        <!-- COMENTARIO 01 -->
        <?php 	
        foreach($datos['respuestas'] as $respuesta) 
        {
        ?>  
            <li class="comment even thread-even depth-1 parent" id="comment-1">
                <div id="div-comment-1" class="comment-body">
                    <div class="comment-author vcard">
                            <img alt="" src="<?= __URL__ . '/imagenes/silueta.png' ?>" class="avatar avatar-32 photo" height="32" width="32">
                            <cite class="fn"><?= $respuesta['Usuario'] ?></cite><span class="says">dice:</span>
                    </div>
                    <div class="comment-meta commentmetadata">
                           <a href="#"><?php 
                                $fecha = date_create($respuesta['FechaAlta']);
                                echo date_format($fecha, 'd/m/Y H:i:s'); 
                            ?></a>
                    </div>

                     <p><?= $respuesta['Comentario'] ?></p>                       
                </div>                    
            </li><!-- #comment-## -->
    <?php 	
        }
    ?>
</ul>