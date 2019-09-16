// Función para comprobar que las claves son iguales//

$("#pass2").change(function () {

    var clave1 = $("#pass1").val();
    var clave2 = $("#pass2").val();


    if (clave1 == clave2)
    {
        $("#pass1").css("border-color", "#00FF00");
        $("#pass2").css("border-color", "#00FF00");
    } else {

        alert("Las dos claves son distintas...")
        $("#pass1").css("border-color", "#FF0000");
        $("#pass2").css("border-color", "#FF0000");
    }


});

// Función para comprobar la validez del e-mail

$("#email").change(function () {

    var x = $("#email").val();

    if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(x)) {
        $("#email").css("border-color", "#00FF00");
    } else {
        $("#email").css("border-color", "#FF0000");

    }
});