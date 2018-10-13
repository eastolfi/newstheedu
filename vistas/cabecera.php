
<?php 
    $estaLogin = false;
    $esAdmin = false;
    
    if(!empty($_SESSION['sesion_user'])) {
        $estaLogin = true;                
    }
    
    if(!empty($_SESSION['sesion_rol'])) {
        if($_SESSION['sesion_rol'] == "admin") $esAdmin = true;                
    }        
?>

<header id="top" >
   <nav class="navbar navbar-expand-xl navbar-dark fixed-top bg-dark"> <!-- style="top:20px;" -->
        <a class="navbar-brand" href="/vistas/presentacion.php" title="">
            <img class="d-inline-block align-top img-fluid" alt="TheEdu New" src="<?= __URL__ . '/imagenes/logo.png'; ?> "> 
        </a>

        <!-- Boton responsive -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- MENU CABECERA -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto"> 
                    <li class="nav-item active"><a class="nav-link" href="<?= __URL__ . '/vistas/presentacion.php'; ?>" title="Presentacion">Presentación</a></li>
                    <li class="nav-item active"><a class="nav-link" href="<?= __URL__ . '/index.php/noticias'; ?> " title="Noticias">Noticias</a></li>                        
                    
                    <?php if(!$estaLogin) { ?>
                    <li class="nav-item active"><a class="nav-link" href="<?= __URL__ . '/index.php/login'; ?> " title="Login">Login</a></li>
                    <li class="nav-item active"><a class="nav-link" href="<?= __URL__ . '/index.php/registro'; ?>" title="Registro">Registro</a></li>
<!--                    <li class="nav-item active"><a class="nav-link" href="#" title="Contacto">Contacto</a></li>-->
                    <?php } else { ?>
                        <li class="nav-item dropdown">
                        <a href="#" class="nav-link active dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?= $_SESSION['sesion_user'] ?></a>
                        <div id="dropdown-logout" class="dropdown-menu" role="menu" style="width:300px;">
                            <div class="col-md-12">
                                <ul class="menu">
                                    <li >
                                        <a href="<?= __URL__ . '/index.php/logout'; ?>" title="">Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        </li>

                        <?php if($esAdmin) { ?>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link active dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Administración</a>                      		
                                <div id="dropdown-admin" class="dropdown-menu" role="menu" style="width:300px;">                                
                                    <div class="col-xs-12">
                                        <a href="<?= __URL__ . '/index.php/admin_noticias'; ?>" title="">Noticias</a>
                                    </div>

                                    <div class="col-xs-12">                                    
                                        <a href="<?= __URL__ . '/index.php/admin_usuarios'; ?>" title="">Usuarios</a>
                                    </div>

                                    <div class="col-xs-12">
                                        <a href="<?= __URL__ . '/index.php/admin_rss'; ?>" title="">RSS</a>
                                    </div>

                                    <div class="col-xs-12">
                                        <a href="<?= __URL__ . '/index.php/admin_boletines'; ?>" title="">Boletines</a>
                                    </div>
                                </div>
                            </li>  
                        <?php } ?>
                    <?php } ?>
            </ul>

            <form class="form-inline mt-2 mt-md-0" method="get" action="#">
                <div class="input-group input-group-sm">
                        <input class="search_query form-control" type="text" name="s" id="s" placeholder="Buscar...">
                        <span class="input-group-btn">
                                <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
                        </span>
                </div>
            </form>
        </div>				
    </nav>
</header>