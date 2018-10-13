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
        } );
    </script>
    
    <title>TIME TRAVEL. Administración de noticias</title>
</head>
    
    <body cz-shortcut-listen="true">
        <!-- HEADER -->         	
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/cabecera.php'); ?> 
        <!-- FIN HEADER -->
                                	
        <main id="single" class="container" role="main">
            <div class="row">
                    <div class="col-md-12"><nav aria-label="breadcrumb" role="navigation"><ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= __URL__ . '/index.php'; ?>">Inicio</a></li>				
                    <li class="breadcrumb-item active" aria-current="page">Administración de noticias</li></ol></nav></div>
            </div>
            
            <!-- CUERPO DEL HTML ---------------------------------------------------------------------------------->	
            <div class="contenedor">
                <div class="omb_login">
                    <h3 class="omb_authTitle">Administración de noticias</h3>                    
                    <p><a class="btn btn-primary" href="<?= __URL__ . '/index.php/admin_noticia_edit?id=0'; ?>" target="_top"><i class="fa fa-edit"></i>&nbsp;Nueva noticia</a></p>                
                    <table id="datatable" class="table">							
                        <thead>
                            <tr>
                                <th>Categoria</th>
                                <th>Titulo</th>                                
                                <th>Año</th>                                
                                <th>Valoración</th>
                                <th>Fec. alta</th>
                                <th>Fec. caduca</th>
                                <th>Aprobado</th>
                                
                                <!--
                                <th>Tit. original</th>                                                                
                                <th>Resumen</th>                                                                
                                <th>Autor</th>
                                <th>Editorial</th>
                                <th>Director</th>
                                <th>Protagonistas</th>
                                -->
                                
                                <th>Acción</th>
                            </tr>
                        </thead>
                        
                        <?php 	//IdCategoria	Titulo	TituloOriginal	Ano	Resumen	ImagenUrl	MetaAutor	MetaEditorial	MetaDirector	MetaProtagonistas	Valoracion	Visitas	FechaAlta	FechaCaducidad	FechaRevision	Aprobado									                                
                                foreach($datos['noticias'] as $noticia) 
                                {
                                    echo "<tr>";
                                    if($noticia["IdCategoria"] == 1) echo "<td align='left'>Libro</td>";
                                    if($noticia["IdCategoria"] == 2) echo "<td align='left'>Película</td>";
                                    $fechaA = date_create($noticia['FechaAlta']);
                                    $fechaC = date_create($noticia['FechaCaducidad']);
                                                                
                                    echo "<td align='left'>" . $noticia["Titulo"] . "</td><td align='center'>" . $noticia["Ano"]. "</td><td align='center'>" . $noticia["Valoracion"] . "<td align='center'>" . date_format($fechaA, 'd/m/Y H:i:s') . "</td><td align='center'>" . date_format($fechaA, 'd/m/Y H:i:s') . "</td><td align='center'>" . $noticia["Aprobado"] . "</td>"; 
                                    
                                    //$resumen = substr($noticia["Resumen"], 0, 25) . "...";
                                    //echo "<td align='center'>" . $noticia["Titulo"] . "</td><td align='center'>" . $noticia["TituloOriginal"]. "</td><td align='center'>" . $noticia["Ano"] . "</td><td align='center'>" . $resumen . "</td>"; 
                                    //echo "<td align='center'>" . $noticia["MetaAutor"] . "</td><td align='center'>" . $noticia["MetaEditorial"]. "</td><td align='center'>" . $noticia["MetaDirector"] . "</td><td align='center'>" . $noticia["MetaProtagonistas"] . "</td>"; 
                                    //echo "<td align='center'>" . $noticia["FechaAlta"] . "</td><td align='center'>" . $noticia["FechaCaducidad"]. "</td><td align='center'>" . $noticia["Aprobado"] . "</td><td align='center'>" . $noticia["Valoracion"] . "</td>"; 
                                    
                                    echo "<td align='center'>";
                                    echo "<a class='btn btn-primary' href='" . __URL__ . "/index.php/admin_noticia_edit?id=" . $noticia["IdNoticia"] ."' target='_top'><i class='fa fa-edit'></i>&nbsp;Editar</a>";
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