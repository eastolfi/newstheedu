<form class="omb_loginForm" name="frmBoletin" id="frmBoletin" onsubmit="return validarBoletin()" autocomplete="off" method="POST">
    <div class="widget" style="height:225px;">
        <h3>Suscríbete a nuestro boletín</h3>								
        <p>
            <label style="margin-left:25px;"><input id="chkSubsLibros" name="chkSubsLibros" type="checkbox">&nbsp;Libros</label>						
            <label style="margin-left:25px;"><input id="chkSubsPelis" name="chkSubsPelis" type="checkbox">&nbsp;Películas</label>						
        </p>
        <br/>
        <div class="input-group">
            <input id="email" type="text" class="form-control" name="email" placeholder="Correo electrónico" required>
        </div>
        <span id="errorMail" style="text-align: center;color: red;"><?= $errorBoletin ?></span>            
        <p align="center">
            <button name="boletin" id="boletin" type="submit" class="btn btn-primary" style="margin-top:20px;background-color:#0087CB;">Apúntame</button>
        </p>
    </div>
</form>

<script>
    function validarBoletin() {
         var mail = document.getElementById("email");
         var chkLibros = document.getElementById("chkSubsLibros");
         var chkPelis = document.getElementById("chkSubsPelis");

         var errorMail = document.getElementById("errorMail");           
         regExpMail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;

         if(!regExpMail.test(mail.value)) {									
              errorMail.innerHTML = "Error en el correo electrónico.";
              mail.focus();                     
              return false
         }
         else if(chkLibros.checked == false && chkPelis.checked == false) {
             errorMail.innerHTML = "Seleccione una categoria.";                
             return false
         }
         else
         {
             errorMail.innerHTML = "";               
             return true;
         }           
     }
</script>