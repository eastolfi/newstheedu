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

<form class="comment-form" name="frmRespuesta" id="frmRespuesta" method="POST">
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
                            <a class="comment-reply-link" id="lnk<?= $opinion['idComentario'] ?>" href="javascript:expandResp('div<?= $opinion['idComentario'] ?>')" aria-label="Responder a <?= $opinion['Usuario'] ?>">Responder</a>
                            <div id="div<?= $opinion['idComentario'] ?>" style='display:none;'>
                                <textarea id="areaResp<?= $opinion['idComentario'] ?>" name="areaResp<?= $opinion['idComentario'] ?>" cols="50" rows="4" maxlength="65525"></textarea>
                                <br/>                            
                                <input type="button" value="enviar" onclick="javascript:validarRespuesta('<?= $opinion['idComentario'] ?>')">
                                <input type="button" value="cancelar" onclick="javascript:expandResp('div<?= $opinion['idComentario'] ?>')">                                  
                            </div>
                        </div>


                    </div>

                    <?php require($_SERVER['DOCUMENT_ROOT'] . '/vistas/foroopinion/respuestas.php'); ?>

                </li>
        <?php 	
            }
        ?>            
    </ol>
    <input type="hidden" name="resp_idOpinion" id="resp_idOpinion" value="">
    <input type="hidden" name="resp_idusuario" id="resp_idusuario" value="<?= $idUsuario ?>">
</form>

<script>
    function validarRespuesta(idOpinion) {
         //var btnSubmits = document.getElementsByClassName("submit");
         var txtArea = document.getElementById("areaResp" + idOpinion);
         if(txtArea.value == "") {             
             txtArea.style.borderColor = "red";
         } else {
             document.getElementById("resp_idOpinion").value = idOpinion;
             document.getElementById("frmRespuesta").submit();
         }
     }     
</script>
