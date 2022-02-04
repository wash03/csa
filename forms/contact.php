<?php
    //Variáveis
    $nome = $_POST['nome'];
    $empresa = $_POST['empresa'];
    $segmento = $_POST['segmento'];
    $email = $_POST['email'];
    $interesse = $_POST['interesse'];
    $telefone = $_POST['telefone'];
    $comonosconheceu = $_POST['comonosconheceu'];
    $texto = $_POST['texto'];
    $data_envio = date('d/m/Y');
    $hora_envio = date('H:i:s');
    
     //Compo E-mail
    $arquivo = "
    <html>
        <p><b>Nome: </b>$nome</p>
        <p><b>Empresa: </b>$empresa</p>
        <p><b>Segmento: </b>$segmento</p>
        <p><b>E-mail: </b>$email</p>
        <p><b>Interesse: </b>$interesse</p>
        <p><b>Telefone: </b>$telefone</p>
        <p><b>Como nos conheceu: </b>$comonosconheceu</p>
        <p><b>Texto: </b>$texto</p>
        <p>Este e-mail foi enviado em <b>$data_envio</b> às <b>$hora_envio</b></p>
    </html>
    ";

    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require '../vendor/autoload.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {

        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.titan.email';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'site@csa-ma.com.br';                     //SMTP username
        $mail->Password   = 'tqrPcNIDZI';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;     

        //Recipients
        $mail->setFrom('site@csa-ma.com.br', 'Site CSA');
        $mail->addAddress('izabela@csa-ma.com.br');     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Contato - Site CSA';
        $mail->Body    = $arquivo;

        $mail->send();
        echo "

        <!DOCTYPE html>
        <html>
        <head>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <style>
        body {font-family: Arial, Helvetica, sans-serif;}

        /* The Modal (background) */
        .modal {
          display: none; /* Hidden by default */
          position: fixed; /* Stay in place */
          z-index: 1; /* Sit on top */
          padding-top: 100px; /* Location of the box */
          left: 0;
          top: 0;
          width: 100%; /* Full width */
          height: 100%; /* Full height */
          overflow: auto; /* Enable scroll if needed */
          background-color: rgb(0,0,0); /* Fallback color */
          background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
          position: relative;
          background-color: #fefefe;
          margin: auto;
          margin-top: 12%;
          padding: 0;
          border: 1px solid #888;
          width: 70%;
          box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
          -webkit-animation-name: animatetop;
          -webkit-animation-duration: 0.4s;
          animation-name: animatetop;
          animation-duration: 0.4s
        }

        /* Add Animation */
        @-webkit-keyframes animatetop {
          from {top:-300px; opacity:0} 
          to {top:0; opacity:1}
        }

        @keyframes animatetop {
          from {top:-300px; opacity:0}
          to {top:0; opacity:1}
        }

        /* The Close Button */
        .close {
          color: white;
          float: right;
          font-size: 28px;
          font-weight: bold;
        }

        .close:hover,
        .close:focus {
          color: #000;
          text-decoration: none;
          cursor: pointer;
        }

        .modal-header {
          text-align: center;
          padding: 20px 16px;
          background-color: #04AA6D;
          color: white;
        }

        
        </style>
        </head>
        <body>

        <!-- The Modal -->
        <div id='myModal' class='modal'>

          <!-- Modal content -->
          <div class='modal-content'>
            <div class='modal-header'>
              <h2>E-mail enviado com sucesso! Entraremos em contato em breve!</h2>
            </div>
            
            </div>
          </div>

        </div>

        <script>
        // Get the modal
        var modal = document.getElementById('myModal');

        window.onload = function() {
          modal.style.display = 'block';
        };

        </script>

        </body>
        </html>

        
        ";
        echo "<meta http-equiv='refresh' content='3;URL=../index.php'>";
        
    } catch (Exception $e) {
        echo "<h1>Erro no envio do e-mail.</h1>";
        echo "<meta http-equiv='refresh' content='3;URL=../index.php'>";
    }


?>