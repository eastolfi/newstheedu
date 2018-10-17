<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es-ES" prefix="og: http://ogp.me/ns#">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
    <!-- INCLUDES -->		
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/includes.php'); ?> 
				
    <title>TIME TRAVEL. Administración de RSS</title>
</head>
    
    <body cz-shortcut-listen="true">
        <!-- HEADER -->         	
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vistas/cabecera.php'); ?> 
        <!-- FIN HEADER -->
                                	
        <main id="single" class="container" role="main">
            <div class="row">
                    <div class="col-md-12"><nav aria-label="breadcrumb" role="navigation"><ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= __URL__ . '/index.php'; ?>">Inicio</a></li>				
                    <li class="breadcrumb-item active" aria-current="page">Administración de RSS</li></ol></nav></div>
            </div>
            
            <!-- CUERPO DEL HTML ---------------------------------------------------------------------------------->	
            <div class="contenedor">
                <div class="omb_login">
                    <h3 class="omb_authTitle">Administración de RSS</h3>                    
                    <h4 class="omb_authTitle">Feed RSS de noticias de TheEduNews</h4>                    
                    <?php                        
                        $url = __URL__ . "/rss/rss_theedunews.xml";
                        $rss = simplexml_load_file($url);
                        if($rss)
                        {                            
                            $items = $rss->channel->item;
                            foreach($items as $item)
                            {
                                echo "<div class='content' style='background-color: #FFFFE1;'>";
                                $title = $item->title;
                                $link = $item->link;
                                
                                $pubDate = $item->pubDate;                                
                                //setlocale(LC_TIME, 'es_ES.UTF-8');
                                //date_default_timezone_set ('Europe/Madrid');                                
                                //$date = date_create_from_format(DateTime::RSS, $pubDate);
                                //$pubDateStr = $date->format("r");                                
                                //$pubDate = $pubDateStr;                                
                                //$pubDate = strftime("%Y-%m-%d %H:%M:%S", strtotime($pubDate));
                                //$pubDate = $item->pubDate; 
                                
                                $description = $item->description;                                
                                echo '<img src="' . __URL__ . '/imagenes/rss.png" alt="feed de noticia RSS" title="Feed de noticia RSS" /><h5><b><a href="' . $link . '">' . $title . '</a></b></h5>';
                                echo '<h6>('. $pubDate . ')</h6>';
                                echo $description;                                
                                echo "<input type='button' value='Eliminar'>";
                                echo "</div>";                                
                            }                            
                        }             
                    ?>                                        
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