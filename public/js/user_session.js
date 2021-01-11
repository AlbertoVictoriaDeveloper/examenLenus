$(document).ready(function () {
    
    
    $("#create").click(function(){ 
         $("#inicioSession").css("display","none"); 
         $("#crearRegistro").css("display","block"); 
         $("#username").val(""); 
         $("#password").val(""); 
         //
         $("#username").removeClass("validateInput"); 
         $("#password").removeClass("validateInput");

         
        
         $("#email_new").addClass("validateInput"); 
         $("#nombre").addClass("validateInput"); 
         $("#apellido_paterno").addClass("validateInput"); 
         $("#apellido_materno").addClass("validateInput"); 
         $("#password_new").addClass("validateInput"); 

    });

    $("#registerSession").click(function(){
        $("#inicioSession").css("display","block"); 
        $("#crearRegistro").css("display","none"); 
         $("#email_new").val(""); 
         $("#nombre").val(""); 
         $("#apellido_paterno").val(""); 
         $("#apellido_materno").val(""); 
         $("#password_new").val(""); 

         //
         $("#email_new").removeClass("validateInput"); 
         $("#nombre").removeClass("validateInput"); 
         $("#apellido_paterno").removeClass("validateInput"); 
         $("#apellido_materno").removeClass("validateInput"); 
         $("#password_new").removeClass("validateInput"); 

         $("#username").addClass("validateInput"); 
         $("#password").addClass("validateInput");

    }); 
  

    $("#btnCrearCuenta").click(function(){
        var validacionInput = validarInput('validateInput');
        
        if(validacionInput ==  0)
        { 
           
            var email_new         = $("#email_new").val(); 
            var nombre            = $("#nombre").val(); 
            var apellido_paterno  = $("#apellido_paterno").val(); 
            var apellido_materno  = $("#apellido_materno").val(); 
            var password_new      = $("#password_new").val();
            var validacionCorreo = validateEmail(email_new);
            if(validacionCorreo){
                    data      = {
                        'email_new': email_new, 
                        'nombre' : nombre,
                        'apellido_paterno': apellido_paterno,
                        'apellido_materno': apellido_materno,
                        'password_new':password_new,
                        'option': 4
                }; 
                $.ajax({
                async: true,
                type: "POST",
                dataType: "json",
                url: "controller/router/loginController.php",
                data: data,
                success: function (data) {
                        if(data.response == "ok")
                        {
                        location.reload();
                        }else{
                        toastr.error(data.message);
                        }
                },
                timeout: 100000,
                error: function(data) {
                    toastr.error('Error del servidor del inicio de session');
                }
                }); 

            }else{
                toastr.error('Correo No Valido');
            }
        }else{
            toastr.error('Verifique los campos Vacios');
        }
         

    });


    $("#btnactualizaPassword").click(function (){
        var validacionInput = validarInput('validateInput'); 
        if(validacionInput ==  0)
        {
           
            var password_verification  = $("#password_verification").val(); 
            var password_new_change    = $("#password_new_change").val(); 
            data      = {
  
                'password_verification' : password_verification,
                'password_new_change':password_new_change, 
                'option': 5
         }; 
                $.ajax({
                async: true,
                type: "POST",
                dataType: "json",
                url: "controller/router/loginController.php",
                data: data,
                success: function (data) {
                        if(data.response == "ok")
                        {
                        location.reload();
                        }else{
                        toastr.error(data.message);
                        }
                },
                timeout: 100000,
                error: function(data) {
                    toastr.error('Error del servidor');
                }
                }); 

        }else{
            toastr.error('Verifique los campos Vacios');

        }
    });
   
    
    $("#btnIniciarSession").click(function () { 
        
         
    
        var validacionInput = validarInput('validateInput'); 
        if(validacionInput ==  0)
        { 
            var pass  = $("#password").val(); 
            var user  = $("#username").val(); 
            var validacionCorreo = validateEmail(user);

    
          if(validacionCorreo == true){
                        data      = {
                            'user': user, 
                            'pass' : pass,
                            'option': 1
                    }; 
                    $.ajax({
                    async: true,
                    type: "POST",
                    dataType: "json",
                    url: "controller/router/loginController.php",
                    data: data,
                    success: function (data) {
                            if(data.response == "ok")
                            {
                            location.reload();
                            }else{
                            toastr.error(data.message);
                            }
                    },
                    timeout: 100000,
                    error: function(data) {
                        toastr.error('Error del servidor');
                    }
                    }); 
          }else{
            toastr.error('Correo Electronico no Valido');
          }


             

        }else{
            toastr.error('Verifique los campos Vacios');
        }
        
    });

    $("#logut").click(function () { 
        data      = {
              'option': 2
            }; 
     $.ajax({
        async: true,
        type: "POST",
        dataType: "json",
        url: "controller/router/loginController.php",
        data: data,
          success: function (data) {
               if(data.response == "ok")
               {
                window.location.href = "index.php";
                 // location.reload();
               }else{
                toastr.error(data.message);
               }
          },
          timeout: 100000,
        error: function(data) {
            toastr.error('Error del servidor');
        }
        });   


        
    });
  
});



function validateEmail(correo){
    var caract = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
    if (caract.test(correo) == false){
        return false;
    }else{
        return true;
    }
}
  


function validarInput(classInput) {
    var inputNone = 0;
    $("." + classInput).each(function(indexValidacion, input) {
        if ($(input).val() == '' ||  $(input).length <= 0 ) {
            inputNone++;
            $(this).css("border-color", "#ff3333");
        } else {
            $(this).css("border-color", "#ccc");
        }
    });
    return inputNone;
}