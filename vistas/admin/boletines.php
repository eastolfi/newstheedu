<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es-ES" prefix="og: http://ogp.me/ns#">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
    <!-- INCLUDES -->		
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/includes.php'); ?>     
    <style>
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        /* Style the buttons inside the tab */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }
    </style>
    
    <script type="text/javascript">
        $(document).ready( function () {
            $('#datatable').DataTable();
        } );
    </script>
    
    <title>TIME TRAVEL. Administración de boletines</title>

</head>
    
    <body cz-shortcut-listen="true">
        <!-- HEADER -->         	
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/cabecera.php'); ?> 
        <!-- FIN HEADER -->
                                	
        <main id="single" class="container" role="main">
            <div class="row">
                    <div class="col-md-12"><nav aria-label="breadcrumb" role="navigation"><ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= __URL__ . '/index.php'; ?>">Inicio</a></li>				
                    <li class="breadcrumb-item active" aria-current="page">Administración de boletines</li></ol></nav></div>
            </div>
            
            <!-- CUERPO DEL HTML ---------------------------------------------------------------------------------->	
            <div class="contenedor">
                <div class="omb_login">
                    <h3 class="omb_authTitle">Administración de boletines</h3>

                    <div class="tab">
                        <button class="tablinks" onclick="cargaPestana(event, 'contenido')" id="defaultOpen">Enviar boletín</button>
                        <button class="tablinks" onclick="cargaPestana(event, 'suscriptores')">Suscriptores</button>                        
                    </div>
                    
                    <div id="contenido" class="tabcontent">
                        <br />

                        <p class="comment-form-comment" style="font-size: 1.3em"><b>Lista de distribución:</b></p> 
                        <select name="categoria" id="categoria" style="width:200px;font-size: 1.3em">					
                            <option value="1">Libro</option>		
                            <option value="2">Pelicula</option>		
                        </select>                                                        

                        <br /><br />
                        <p class="comment-form-comment"><label for="body" style="font-size: 1.3em"><b>Cuerpo del mensaje:</b></label> 
                            <textarea id="body" name="body" cols="90" rows="8" maxlength="65525" style="font-size: 1.3em" required="required"></textarea>
                        </p>                        
                        
                        <br />
                        <p class="form-submit">
                            <input name="lista" type="submit" id="lista" class="submit" value="Enviar boletín"> 
                        </p>
                    </div>
                    
                    <div id="suscriptores" class="tabcontent">
                        <br />
                        <table id="datatable" class="table">							
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Fecha alta</th>
                                <th>Peliculas</th>
                                <th>Libros</th>
                                <th>Activo</th>                                                                
                            </tr> 
                        </thead>
                        
                        <?php 										                                
                            foreach($datos['suscriptores'] as $suscriptor) 
                            {
                                echo "<tr>";
                                echo "<td align='center'>" . $suscriptor["email"] . "</td><td align='center'>" . $suscriptor["fechaAlta"]. "</td><td align='center'>" . $suscriptor["okPelis"] . "</td><td align='center'>" . $suscriptor["okLibros"] . "</td><td align='center'>" . $suscriptor["activa"] . "</td>"; 

                                echo "<td align='center'>";
                                echo "<a class='btn btn-primary' href='" . __URL__ . "/index.php/admin_usuario_edit?id=" . $suscriptor["id"] ."' target='_top'><i class='fa fa-edit'></i>&nbsp;Editar</a>";
                                echo "</td>";

                                echo "</tr>";                                        
                            }
                        ?>		
                    </table>                        
                    </div>
                </div>
            </div>
            
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
    <script>
        function cargaPestana(evt, accion) {
            var i, tabcontent, tablinks;

            tabcontent = document.getElementsByClassName("tabcontent");

            for (i = 0; i < tabcontent.length; i++) 
            {
                tabcontent[i].style.display = "none";
            }

            tablinks = document.getElementsByClassName("tablinks");

            for (i = 0; i < tablinks.length; i++) 
            {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            document.getElementById(accion).style.display = "block";
            evt.currentTarget.className += " active";
        }

        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
    </script>
</html>