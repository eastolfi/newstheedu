<!-- DEJAR COMENTARIO -->
<div id="respond" class="comment-respond">
    <h3 id="reply-title" class="comment-reply-title">Deja un comentario</h3>			        
    <form class="comment-form" name="frmComentario" id="frmComentario" onsubmit="return validarComentario();" method="POST">
        <p>Valoración</p>
        <p class="clasificacion">
            <input id="radio1" type="radio" name="estrellas" value="5" onclick="asignaValor(5)"><label class="rdb" for="radio1">&#9733;</label>
            <input id="radio2" type="radio" name="estrellas" value="4" onclick="asignaValor(4)"><label class="rdb" for="radio2">&#9733;</label>
            <input id="radio3" type="radio" name="estrellas" value="3" onclick="asignaValor(3)"><label class="rdb" for="radio3">&#9733;</label>
            <input id="radio4" type="radio" name="estrellas" value="2" onclick="asignaValor(2)"><label class="rdb" for="radio4">&#9733;</label>
            <input id="radio5" type="radio" name="estrellas" value="1" onclick="asignaValor(1)"><label class="rdb" for="radio5">&#9733;</label>            
        </p>       
        
        <span id="errorStar" style="text-align: center;color: red;"></span>
        
        <p class="comment-form-comment"><label for="comment">Comentario</label> 
            <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea>
        </p>
        
        <p class="form-submit">
            <input name="comentario" type="submit" id="comentario" class="submit" value="Publicar comentario"> 
                        
            <input type="hidden" name="comment_parent" id="comment_parent" value="<?= $noticia[0]['IdNoticia'] ?>">
            <input type="hidden" name="comment_valoracion" id="comment_valoracion" value="0">
            <input type="hidden" name="comment_idusuario" id="comment_idusuario" value="<?= $idUsuario ?>">
            
        </p>
                
    </form>
    
    <script>
      function validarComentario() {
           var radio1 = document.getElementById("radio1");
           var radio2 = document.getElementById("radio2");
           var radio3 = document.getElementById("radio3");
           var radio4 = document.getElementById("radio4");
           var radio5 = document.getElementById("radio5");                      
           var errorStar = document.getElementById("errorStar");
           
           if(!radio1.checked && !radio2.checked && !radio3.checked && !radio4.checked && !radio5.checked) {									
                errorStar.innerHTML = "Por favor, dale una valoracion.";                                   
                return false
           }
           else 
               return true;                  
       }
       
       function asignaValor(valor) {
           var valoracion = document.getElementById("comment_valoracion");           
           var errorStar = document.getElementById("errorStar");
           
           valoracion.value = valor;
           errorStar.innerHTML = "";
       }
    </script>
</div><!-- #respond -->
