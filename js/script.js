
// ************************************ FIN INCLUIR FOOTER ****************************************


$(function () {
    CKEDITOR.replace('editor');
    $(".textarea").wysihtml5();
});


/* ************************************************ DESPLIEGUE DE COMENTARIOS ***************************************************** */
$("#myBtn").click(function() {
    if ($("#comentarios").is(":visible")) {
        $("#comentarios").hide();
    }
    else {
        $("#comentarios").show();
    }
});



/* ************************************************ UNIRSE ***************************************************** */
$("#botonUnirse").click(function() {
    $.ajax({
        type: "GET",
        url: "insertarParticipante.php",
        success: function() {
            $("#botonUnirse").css("font-weight", "bold");
            $("#botonUnirse").html("✓ Liked");
        }
    });
});



/* ******************************************** COMPROBAR USER TIEMPO REAL AJAX ********************************************** */


$('#userName').blur(function () {

    $('#Info').html('<img src="img/loading.gif" alt="" />').fadeOut(1000);

    var username = $(this).val();
    var dataString = 'userName=' + username;

    $.ajax({
        type: "POST",
        url: "checkUsername.php",
        data: dataString,
        success: function (data) {
            $('#Info').fadeIn(1000).html(data);
            
        }
    });
});                  

/* ************************************************ ACCEPT TUTORIAL ***************************************************** */

$("#acceptTut").click(function() {
    
    window.location.href = "acceptTut.php";
    
});


/* ************************************************ FIN ACCEPT TUTORIAL ***************************************************** */

/* ************************************************ ERASE TUTORIAL ***************************************************** */

$("#eraseTut").click(function() {
    
    window.location.href = "eraseTut.php";
    
});

/* ************************************************ FIN ERASE TUTORIAL ***************************************************** */

/* ************************************************ PAGINADOR EVENTOS PRÓXIMOS ***************************************************** */

$(".paginateEventProx a").bind("click", function(){
    $('.load').html('<div><img src="img/loadingPage.gif" width="130px" height="70px"/></div>');
    var page = $(this).attr('data');    
    var dataString = 'page='+page;
    
    $('html, body').animate({scrollTop:0}, 'slow');
    
    $.ajax({
        type: "GET",
        url: "eventosProximos.php",
        data: dataString,
        success: function(data) {
            $('#content').fadeIn(1000).html(data);
        }
    });
});

/* ************************************************ PAGINADOR EVENTOS PASADOS ***************************************************** */

$(".paginateEventPas a").bind("click", function(){
    $('.load').html('<div><img src="img/loadingPage.gif" width="130px" height="70px"/></div>');
    var page = $(this).attr('data');    
    var dataString = 'page='+page;
    
    $('html, body').animate({scrollTop:0}, 'slow');
    
    $.ajax({
        type: "GET",
        url: "eventosPasados.php",
        data: dataString,
        success: function(data) {
            $('#content').fadeIn(1000).html(data);
        }
    });
});

/* ************************************************ PAGINADOR NOVEDADES ***************************************************** */

 $(".paginateNov a").bind("click", function(){

    var page = $(this).attr('data');    
    var dataString = 'page='+page;

    $('html, body').animate({scrollTop:0}, 'slow');
    $.ajax({

        type: "GET",
        url: "index.php",
        data: dataString,
        success: function(data) {
            $('#content').fadeIn(1000).html(data);
        }
    });

});

 /* ************************************************ PAGINADOR NOVEDADES ***************************************************** */
/* ************************************************ ME GUSTA ***************************************************** */
$("#botonUnirse").click(function() {

    $.ajax ({

        type: "GET",
        url: "insertarLike.php",
        success: function () {
    
        $("#botonUnirse").css("font-weight", "bold");
        $("#botonUnirse").html("✓ Liked");

        }
    })
});

/* **************************************************** PAGINADOR TUTORIAL VARIO ************************************************************* */
$(".paginateVar a").bind("click", function(){

    $('.load').html('<div><img src="img/loadingPage.gif" width="130px" height="70px"/></div>');
    var page = $(this).attr('data');    
    var dataString = 'page='+page;
    
    $('html, body').animate({scrollTop:0}, 'slow');
    
    $.ajax({
        type: "GET",
        url: "tutorialesVarios.php",
        data: dataString,
        success: function(data) {
            $('#content').fadeIn(1000).html(data);
        }
    });

});

/* **************************************************** PAGINADOR TUTORIAL DRON ************************************************************* */
$(".paginateDron a").bind("click", function(){

    $('.load').html('<div><img src="img/loadingPage.gif" width="130px" height="70px"/></div>');
    var page = $(this).attr('data');    
    var dataString = 'page='+page;
    
    $('html, body').animate({scrollTop:0}, 'slow');
    
    $.ajax({
        type: "GET",
        url: "tutorialesDrones.php",
        data: dataString,
        success: function(data) {
            
            $('#content').fadeIn(1000).html(data);

        }
    });

});
