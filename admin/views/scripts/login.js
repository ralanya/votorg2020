/*$("#frmacceso").on('submit', function(e) {
    e.preventDefault();
    logina = $("#logina").val();
    clavea = $("#clavea").val();
    $.post("../controllers/usuario.php?op=verificar", {
        "logina": logina,
        "clavea": clavea
    }, function(data) {
        if (data != "null") {
            $(location).attr("href", "escritorio.php");
        } else {
            swal("Error!", "Usuario y/o Password incorrectos", "error");
        }
    });
})*/
$("#frmacceso").on('submit', function(e) {
    e.preventDefault();
    logina = $("#logina").val();
    clavea = $("#clavea").val();
    $.post("../controllers/usuario.php?op=verificar", {
        "logina": logina,
        "clavea": clavea
    }, function(data) {
        if (data != "null") {
            $(location).attr("href", "escritorio.php");
        } else {
            swal("Error!", "Usuario y/o Password incorrectos", "error");
        }
    });
})