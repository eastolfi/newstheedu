<?php
	 /*
	 if(isset($_COOKIE["PHPSESSID"])){
      echo "Hay session!";
	}
	*/
	
	phpinfo();
	
//	$url = "http://rss.theedu.es/rss_theedunews.xml";
//	$rss = simplexml_load_file($url);
//	if($rss){
//       echo '<h1>' . $rss->channel->title . '</h1>';
//       echo '<li>' . $rss->channel->pubDate . '</li>';
//       $items = $rss->channel->item;
//       foreach($items as $item){
//           $title = $item->title;
//           $link = $item->link;
//           $pubDate = $item->pubDate; 
//		   $description = $item->description;
//		   
//           echo '<h3><a href="'.$link.'">'.$title.'</a></h3>';
//           echo '<span>('. $pubDate . ')</span>';
//           echo $description;
//       }
//   }



//    $url = "rss/rss_theedunews.xml";
//    //$rss = simplexml_load_file($url);    
//    $rss = new SimpleXMLElement($url, 0, true);
//    $nuevoItem = $rss->channel->addChild('item');
//    
//    $nuevoItem->addChild('title', 'Nueva pelicula para el RSS');
//    $nuevoItem->addChild('link', 'http://news.theedu.es/index.php/noticia?id=4');
//    
//    $txtDescripcion = "<![CDATA[<p style='text-align: left;'><img src='http://news.theedu.es/imagenes/noticias/paris.jpg' alt='Placer en París' title='Placer en París' width='100' height='150'>";
//    $txtDescripcion .= "</p><p style='text-align: left;font-size: 12pt;'>Una sorprendente novela erótica que nos traslada al Paris de principios del Siglo XX</p>";
//    $descripcion = htmlspecialchars_decode($txtDescripcion);    
//    
//    $nuevoItem->addChild('description', $descripcion);
//    
//    $nuevoItem->addChild('pubDate', 'Thu, 11 Oct 2018 09:57:11 GMT');
//    
//    $rss->asXML($url);
    
//    $sxe = new SimpleXMLElement($rss->asXML());
//        
//    $itemNode = $sxe->channel->item[0];
//    $itemNode->addChild("title", "Nueva pelicula para el RSS");
//    $sxe->asXML($url); 

    
//    $dtz = new DateTimeZone("Europe/Madrid"); //Your timezone
//    $now = new DateTime(date("Y-m-d"), $dtz);
//    echo $now->format("Y-m-d H:i:s");

//    date_default_timezone_set('UTC');
//    // Imprime algo como: Monday 8th of August 2005 03:12:46 PM
//    echo date('l jS \of F Y h:i:s A');

    //$pubDate = new DateTime();
    //echo $pubDate->format(DateTime::RSS);
    
    //$now = time();
    //$pubDate= date('r', $now);

    //echo "\n<pubDate>$pubDate</pubDate>";
    
    
    //$pubDate = date(DATE_RSS, strtotime($now));
    //echo $pubDate;
?>