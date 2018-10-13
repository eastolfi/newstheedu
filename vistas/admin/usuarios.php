<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es-ES" prefix="og: http://ogp.me/ns#">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
    <!-- INCLUDES -->		
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/includes.php'); ?> 
    <script type="text/javascript">
        $(document).ready( function () {
            $('#datatable').DataTable();
        });                            
    </script>
				
    <title>TIME TRAVEL. Administración de usuarios</title>
</head>
    
    <body cz-shortcut-listen="true">
        <!-- HEADER -->         	
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/cabecera.php'); ?> 
        <!-- FIN HEADER -->
                                	
        <main id="single" class="container" role="main">
            <div class="row">
                    <div class="col-md-12"><nav aria-label="breadcrumb" role="navigation"><ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= __URL__ . '/index.php'; ?>">Inicio</a></li>				
                    <li class="breadcrumb-item active" aria-current="page">Administración de usuarios</li></ol></nav></div>
            </div>
            
            <!-- CUERPO DEL HTML ---------------------------------------------------------------------------------->	
            <div class="contenedor">
                <div class="omb_login">
                    <h3 class="omb_authTitle">Administración de usuarios</h3>

                    
                    
                    <table id="datatable" class="table">							
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Activo</th>                                
                                <th>Acciones</th>
                            </tr> 
                        </thead>
                        
                        <?php 										                                
                            foreach($datos['usuarios'] as $usuario) 
                            {
                                echo "<tr>";
                                echo "<td align='center'>" . $usuario["Usuario"] . "</td><td align='center'>" . $usuario["Email"]. "</td><td align='center'>" . $usuario["Rol"] . "</td><td align='center'>" . $usuario["Activo"] . "</td>"; 

                                echo "<td align='center'>";
                                echo "<a class='btn btn-primary' href='" . __URL__ . "/index.php/admin_usuario_edit?id=" . $usuario["idUsuario"] ."' target='_top'><i class='fa fa-edit'></i>&nbsp;Editar</a>";
                                echo "</td>";

                                echo "</tr>";                                        
                            }
                        ?>		
                    </table>
                    
                    
                    
                    
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

