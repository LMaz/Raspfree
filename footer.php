<footer>
    <div class="container-fluid hidden-print">
        <div class="row pie">
            <div class="col-md-offset-0 col-md-3  col-sm-6 hidden-xs footerleft">
                <img class="img-responsive iconfooter" alt="Brand" src="img/iconfooter1.png">

            </div>
            <div class="col-md-3 col-sm-6 paddingtop-bottom">
                <h4 class="headingfoot">Explore</h4>
                <ul class="footer-ul active">
                    <li><a href="index.php?active=novedad"> Novedades</a></li>
                    <li><a href="tutorialesVarios.php?active=tutorial"> Tutoriales</a></li>
                    <li><a href="eventosProximos.php?active=evento"> Eventos</a></li>
                    <li><a href="galeria.php?active=galeria"> Galeria</a></li>
                    <li><a href="#id04" data-toggle="modal" data-target="#id04"> Contacta con nosotros</a></li>
                    <li><a href="#id05" data-toggle="modal" data-target="#id05"> Términos y condiciones</a></li>
                </ul>
            </div>
            <div class="col-md-4 col-md-offset-1 col-sm-offset-1 col-sm-12 paddingtop-bottom">
                <div class= "iconosFooter">

                    <a href="http//:www.skype.com" class="fa fa-lg fa-skype"> </a>
                    <a href="http//:www.google.com" class="fa fa-lg fa-google-plus "> </a>
                    <a href="http//:www.linkedin.com" class="fa fa-lg fa-linkedin "> </a>
                    <a href="http//:www.twitter.com" class="fa fa-lg fa-twitter"> </a>
                    <a href="http//:www.facebook.com" class="fa fa-lg fa-facebook "> </a>
                </div>  
                <div class="textoFooter">
                    <p> Copyright &copy 2017 Página hecha con fines academicos. Sin animo de lucro.</p>
                </div> 
            </div>

        </div>
    </div>

</footer>



        <!-- *********************************************** FORMULARIO DE CONTACTO ****************************************************** -->

<div id="id04" class="modal">

    <div class="mod">

            <!-- **************** La X para cerrar la ventana y la imagen central **************** -->

            <div class="xclose">
                <a href="#" class="cerrarlog" data-dismiss="modal" aria-label="close">&times;</a>
                <img src="img/favicon1.png" alt="Avatar" class="img-responsive avatar center-block">
            </div>
            <!-- **************** Encabezado del formulario *************************************-->
            <div class="perfil">¡Contacta con nosotros!</div>


        <form class="animate" action="mailto:lucamaza@gmail.com?subject=Contacto" method="post" enctype="text/plain">



            <div class="contenedor">

                <!-- ***************** Formulario de contacto *************** -->

                <div class="form-group">
                    <label>Nombre de usuario:</label>
                    <input type="text" class="form-control" id="user" name="Usuario" placeholder="Usuario">
                </div>

                <div class="form-group">
                    <label>E-mail:</label>
                    <input type="email" class="form-control" id="mail" name="E-mail" placeholder="E-mail">
                </div>

                <p>Motivo de la consulta</p>
                <label class="radio-inline"><input type="radio" name="Problema">Problema</label>
                <label class="radio-inline"><input type="radio" name="Sugerencia">Sugerencia</label>
                <label class="radio-inline"><input type="radio" name="Cancelación">Cancelación</label> 
                <br>
                <br>


                <div class="form-group">
                    <label>Explicación de la consulta:</label>
                    <textarea class="form-control" rows="5" id="comment" name="Comentario" placeholder="Comentario"></textarea>
                </div>


                <input type="submit" value="enviar" class="cancelbtn">

            </div>

        </form>

    </div>

</div>

<!-- *********************************************** TERMS Y CONDITIONS ****************************************************** -->

<div id="id05" class="modal">

    <div class="mod animate">

        <!-- **************** La X para cerrar la ventana y la imagen central **************** -->

        <div class="xclose">
            <a href="#" class="cerrarlog" data-dismiss="modal" aria-label="close">&times;</a>
            <img src="img/favicon1.png" alt="Avatar" class="img-responsive avatar center-block">
        </div>
        <!-- **************** Encabezado *************************************-->
        <div class="perfil">Términos y condiciones</div>

        <div class="contenedor">

            <!-- ***************** Texto *************** -->
            <div class="terms">
                <p>Desde Raspfree nuestra intención es crear una página web para el intercambio de conocimiento sobre tecnología entre distintos usuarios. Esta página está creada exclusivamente con fines académicos para la asignatura de Aplicaciones Web de la facultad de informática de la Universidad Complutense de Madrid. </p>

            </div>


            <button type="submit" class="cancelbtn" data-dismiss="modal">Cancelar</button>

        </div>

    </div>

</div>
<!-- *********************************************** FIN DE TÉRMINOS Y CONDICIONES ******************************************* -->
