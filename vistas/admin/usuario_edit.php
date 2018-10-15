<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es-ES" prefix="og: http://ogp.me/ns#">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
    <!-- INCLUDES -->		
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/includes.php'); ?> 
				
    <title>TIME TRAVEL. Administración de usuarios</title>	
    
    <script type="text/javascript">
        function validarEditaUsuario() {
            var divChk = document.getElementById("chkUserActivo");
            var hidChk = document.getElementById("chkEstado");
            
            hidChk.value = divChk.checked;
        }
    </script>
    <body cz-shortcut-listen="true">
        <!-- HEADER -->         	
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/cabecera.php'); ?> 
        <!-- FIN HEADER -->
                                	
        <main id="single" class="container" role="main">
            <div class="row">
                    <div class="col-md-12"><nav aria-label="breadcrumb" role="navigation"><ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= __URL__ . '/index.php'; ?>">Inicio</a></li>				
                    <li class="breadcrumb-item"><a href="<?= __URL__ . '/index.php/admin_usuarios'; ?>">Administración de usuarios</a></li>				
                    <li class="breadcrumb-item active" aria-current="page">Editar usuario</li></ol></nav></div>
            </div>
            
            <!-- CUERPO DEL HTML ---------------------------------------------------------------------------------->	
            <div class="contenedor">
                <div class="omb_login">
                    <h3 class="omb_authTitle">Editar usuario: '<?= $user_detalle[0]['Usuario'] ?>'</h3>
                    
                    <?php
                        $estadoActivo = "";

                         if($user_detalle[0]['Activo'] == 1) $estadoActivo = "checked";
                         else $estadoActivo = "unchecked";                        
                    ?> 

                    <div class="row omb_row-sm-offset-3" >
                        <div class="col-xs-12 col-sm-6" >	                            
                            <form class="comment-form" name="frmEditUsuario" id="frmEditUsuario" onsubmit="return validarEditaUsuario();" method="POST"> 
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="chkUserActivo" id="chkUserActivo" <?= $estadoActivo ?>>
                                    <label class="custom-control-label" style="font-size: 1.3em;" for="chkUserActivo" >&nbsp;Usuario activo</label>
                                </div>
                                <br />
                                
                                <div class="input-group">                                    
                                    <span class="input-group-addon" style="font-size: 1.3em;"><i class="fa fa-user"></i>&nbsp;&nbsp;Rol: </span>
                                    
                                    <select name="user_rol" style="margin-left: 10px;width:520px;font-size: 1.3em;">
                                     <?php 							
                                        $arrayRoles = array("admin", "visitante", "colaborador");
                                        
                                        for($i = 0; $i < count($arrayRoles); $i++) {
                                        if($user_detalle[0]['Rol'] == $arrayRoles[$i]) 
                                            $selected = "selected";
                                        else $selected = "";
                                            echo "<option value='" . $arrayRoles[$i] . "'" . $selected . ">" . ucfirst($arrayRoles[$i]) . "</option>";
                                        }				
                                    ?>		
                                    </select>
                                   
                                </div>
                                <br/>
                                <button class="btn btn-lg btn-primary btn-block" type="submit" id="edit_usuario" name="edit_usuario">Aceptar</button> 
                                <input type="hidden" name="chkEstado" id="chkEstado" value="">
                            </form>
                        </div>
                    </div>                    
                </div>
            </div>
            
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>

            <!-- PIE -->		
            <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/aceptacookie.php'); ?> 
            <!-- FIN PIE -->
        </main>

        <!-- PIE -->		
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/pie.php'); ?> 
        <!-- FIN PIE -->		
    </body>        
</html>