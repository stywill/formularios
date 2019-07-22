
$(document).ready(function () {
    /*
     $("#formulario").validate({
     rules: {
     pergunta1: {
     required: true
     },
     pergunta2: {
     required: true
     },
     pergunta3: {
     required: true
     },
     pergunta4: {
     required: true
     }
     },
     messages: {
     pergunta1: "Responda a primeira pergunta.",
     pergunta2: "Responda a segunda pergunta.",
     pergunta3: "Responda a terceira pergunta.",
     pergunta4: "Responda a quarta pergunta."
     },
     errorPlacement: function (error, element) {
     var name = $(element).attr("name");
     error.appendTo($("#" + name + "_erro"));
     }
     });
     */
    
});
function showMacAddress(){

    var obj = new ActiveXObject("WbemScripting.SWbemLocator");
    var s = obj.ConnectServer(".");
    var properties = s.ExecQuery("SELECT * FROM Win32_NetworkAdapterConfiguration");
    var e = new Enumerator (properties);


    var output;
    output='<table border="0" cellPadding="5px" cellSpacing="1px" bgColor="#CCCCCC">';
    output=output + '<tr bgColor="#EAEAEA"><td>Caption</td><td>MACAddress</td></tr>';
    while(!e.atEnd())

    {
        e.moveNext();
        var p = e.item ();
        if(!p) continue;
        output=output + '<tr bgColor="#FFFFFF">';
        output=output + '<td>' + p.Caption; + '</td>';
        output=output + '<td>' + p.MACAddress + '</td>';
        output=output + '</tr>';
    }

    output=output + '</table>';
    document.getElementById("box").innerHTML=output;
}
function toggleFullScreen() {
        if ((document.fullScreenElement && document.fullScreenElement !== null) ||
                (!document.mozFullScreen && !document.webkitIsFullScreen)) {
            if (document.documentElement.requestFullScreen) {
                document.documentElement.requestFullScreen();
            } else if (document.documentElement.mozRequestFullScreen) {
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullScreen) {
                document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
            }
        } else {
            if (document.cancelFullScreen) {
                document.cancelFullScreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitCancelFullScreen) {
                document.webkitCancelFullScreen();
            }
        }
    }
function limpaErro(i) {
    $("#pergunta" + i + "_erro").text("");
}
function valida() {
    var contPergunta = parseInt($("#contPergunta").val());
    var erro = false;
    for (var i = 0; i < contPergunta; i++) {

        if (!$("input[name='resposta" + i + "']:checked").length) {
            $("#pergunta" + i + "_erro").text("Essa pergunta não foi respondida");
            erro = true;
        }
    }
    if (erro == false) {
        $("#formulario").submit();
    } else {
        return false;
    }
}
