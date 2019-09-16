<!-- *********************************************** MENÚ ********************************************************************* -->

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php?active=novedad"><img class="img-responsive logo" alt="Brand" src="img/favicon1.png"></a>
        </div>

        <div  role="navigation"  id="navbar" class="navbar-collapse collapse" aria-expanded="false">
            <ul class="nav navbar-nav navbar-left">

                <li <?php
                if (isset($_GET['active'])) {
                    if ($_GET['active'] == 'novedad') {
                        ?> class="active" <?php
                        }
                    } else {
                        ?> class="active" <?php } ?> role="presentation"><a href="index.php?active=novedad">Novedades</a></li>
                <li <?php
                if (isset($_GET['active'])) {
                    if ($_GET['active'] == 'tutorial') {
                        ?>class="dropdown active"<?php
                        }
                    } else {
                        ?> class="dropdown" <?php } ?>><a class=" dropdown-toggle" data-toggle="dropdown" href="#">Tutoriales <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="tutorialesDrones.php?active=tutorial">Drones y robots</a></li>
                        <li><a href="tutorialesVarios.php?active=tutorial">Varios</a></li>
                        <?php
                        if (isset($_SESSION['username'])) {
                            echo "<li><a href='crearTutorial.php?active=tutorial'>Crear tutorial</a></li>";
                        }
                        ?>

                    </ul>
                </li>
                
                <li <?php if(isset($_GET['active'])) {
                    if ($_GET['active'] == 'evento') {
                        ?>class="dropdown active"<?php
                        }
                    } else {
                        ?>class="dropdown" <?php } ?>><a class=" dropdown-toggle" data-toggle="dropdown" href="#">Eventos <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="eventosProximos.php?active=evento">Proximos</a></li>
                        <li><a href="eventosPasados.php?active=evento">Pasados</a></li>

                    </ul>
                </li>
                <li <?php if(isset($_GET['active'])) {
                    if ($_GET['active'] == 'galeria') {
                        ?> class="active"<?php }
                    }?>role="presentation"><a href="galeria.php?active=galeria">Galería</a></li>
                <?php
               
                if (isset($_SESSION['username'])) {
                    if ($_SESSION['admin'] == true) {
                         include"numMod.php";
                        if(isset($_GET['active']) && $_GET['active'] == 'admin') {
                            echo "<li class='dropdown active'><a class=' dropdown-toggle' data-toggle='dropdown' href='#'>Admin ".numModerar(). "  <span class='caret'></span></a>";
                        }else{
                               echo "<li class='dropdown'><a class=' dropdown-toggle' data-toggle='dropdown' href='#'>Admin ".numModerar(). " <span class='caret'></span></a>"; 
                            }
                        echo" <ul class='dropdown-menu'>
                                <li><a href='crearNovedad.php?active=admin'>Crear novedad</a></li>
                                <li><a href='crearEvento.php?active=admin'>Crear evento</a></li>
                                <li><a href='moderar.php?active=admin'>Moderar: ".numModerar()." </a></li>                      
                            </ul>
                        </li>";
                    }
                }
                ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                
                <?php
                if (!isset($_SESSION['username'])) {
                    echo" <li><a href='#id02' data-toggle='modal' data-target='#id02'><span class='glyphicon glyphicon-user'></span> Sign Up</a></li>
                             <li><a href='#id01' data-toggle='modal' data-target='#id01'><span class='glyphicon glyphicon-log-in'></span> Login </a></li>";
                } else {
                    echo"<li><a href='#id03' data-toggle='modal' data-target='#id03'><span class='glyphicon glyphicon-user'></span> Profile</a></li>
                            <li><a href='logout.php'><span class='glyphicon glyphicon-log-in'></span> Logout </a></li>";
                }
                ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<!--************************************************FORMULARIO DE LOGIN*******************************************-->                  
<div id="id01" class="modal">


    <!-- **************** La X para cerrar la ventana y la imagen central **************** -->
    <div class="mod">

        <div class="xclose">
            <a href="#" class="cerrarlog" data-dismiss="modal" aria-label="close">&times;</a>
            <img src="img/favicon1.png" alt="Avatar" class="img-responsive avatar center-block">
        </div>
        <div class="perfil">¡Inicia sesión!</div>

        <form class="animate" action="validarLogin.php" method="POST">

            <div class="contenedor">

                <!-- ***************** Formularios de Entrada *************** -->

                <label>Username</label>
                <input type="text" class="formIn" placeholder="&#61447; Nombre de Usuario" name="name" required>


                <label>Password</label>
                <input type="password" class="formIn" placeholder="&#xf084; Password" name="pass" required>

                <!-- **************** Botones de Login y campo de recordar contraseña  *************************-->

                <div class="boton1">
                    <a href = "indexUser.html"><input class="botonform" value="login" name="login" type="submit"> </a>
                </div>	                

            </div>

        </form>

    </div>

</div>



<!--************************* FIN DE FORMULARIO DE LOGIN  **************************************-->
<!--************************* FORMULARIO DE SIGN UP ******************************************* -->

<div id="id02" class="modal">

    <div class="mod">

        <!-- **************** La X para cerrar la ventana y la imagen central **************** -->

        <div class="xclose">
            <a href="#" class="cerrarlog" data-dismiss="modal" aria-label="close">&times;</a>
            <img src="img/favicon1.png" alt="Avatar" class="img-responsive avatar center-block">
        </div>

        <div class="perfil">¡Regístrate! ¡es muy sencillo!</div>



        <form class="animate" id="form" action="validarRegistro.php" method="post" enctype="multipart/form-data" autocomplete="off">


            <div class="contenedor">

                <!-- ***************** Formularios de Entrada *************** -->

                <label for="userName">Username</label>
                <input class="formIn" type="text" placeholder="&#61447; Nombre de Usuario" id="userName" name="userName" required>
                <div id="Info"></div>


                <label for="password">Password</label>
                <input class="formIn" type="password" placeholder="&#xf084; Password" id="pass1" name="pass1" required>

                <label for="password2">Confirma password</label>
                <input class="formIn" type="password" placeholder="&#xf084; Confirma password" name="pass2" id="pass2" required>

                <!-- Imagen principal -->
                <div class="form-group">
                    <label for="imagen"> Imagen principal: </label><br>
                    <input type="file" class="form-control-file" id="imagen" name="imagen" required="" aria-describedby="fileHelp">
                    <small id="fileHelp" class="form-text text-muted">Seleccione la imagen principal del perfil</small>

                </div>


                <label for="mail">E-Mail</label>
                <input class="formIn" type="text" id="email" placeholder="&#xf0e0; E-Mail" name="email" required>

                <label for="age">Edad</label>
                <input class="formIn" type="number" placeholder="&#xf1fd; Edad" id="age" name="age" required>


                <label for="body">Biografía</label>
                <input class="formIn" type="text" placeholder="&#xf1ea; Biografía" id="body" name="body"  autocomplete="off" required>


                <div class="boton2">
                    <input class="botonform" value="registrarme" type="submit">

                </div>

            </div>

        </form>

        <!-- *************** Footer del Log In, contiene el botón de cancelar y recuperación de contraseña *************** -->

        <div class="contenedor">
            <button type="button" class="cancelbtn" data-dismiss="modal"> Cancelar</button>

        </div>

    </div>

</div>

<!-- ****************************************PERFIL DE USUARIO*******************************-->
<div id="id03" class="modal">

    <div class="modper animate">

        <!-- **************** La X para cerrar la ventana  **************** -->

        <div class="xclose">
            <a href="#" class="cerrar" data-dismiss="modal" aria-label="close">&times;</a>
        </div>
        <div class="perfil">Perfil de usuario</div>
        <div class="contenedor">

            <!-- *************** Estilo de la imagen ************************* -->

            <div class="imgcontainerper">
                <?php  echo '<img class ="perfilImg img-responsive" src="data:image/jpeg;base64,'.base64_encode($_SESSION['image']).'"/>';  ?>
            </div>

            <!-- ***************** datos ***************-->
            <div>
                <table class="table table-bordered table-condensed table-striped">
                    <tr>
                        <th class="titTabla">Nombre de usuario:</th>
                        <?php echo"<th>$_SESSION[username]</th>"; ?>
                    </tr>
                    <tr>
                        <th class="titTabla">Edad:</th>
                        <?php echo"<th>$_SESSION[edad]</th>"; ?>
                    </tr>
                    <tr>
                        <th class="titTabla">E-mail:</th>
                        <?php echo"<th>$_SESSION[mail]</th>"; ?>
                    </tr>
                    <tr>
                        <th class="titTabla">Descripción:</th>
                        <?php echo"<th>$_SESSION[body]</th>"; ?>          
                    </tr>
                </table>

            </div>

         
        </div>
    </div>
</div>