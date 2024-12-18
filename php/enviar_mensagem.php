<?php
/* Set e-mail recipient */
$meuemail  = "rafadev@gmx.com";

/* Check all form inputs using check_input function */
$nome = check_input($_POST['nome'], "Digite seu nome");
$assunto  = check_input($_POST['assunto'], "Escreva um assunto");
$email    = check_input($_POST['email']);
$gosta   = check_input($_POST['gosta']);
$como_achou = check_input($_POST['como_achou']);
$mensagem = check_input($_POST['mensagem'], "Escreva sua mensagem");

/* If e-mail is not valid show error message */
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
{
    show_error("Por favor digite um e-mail válido!");
}

/* Let's prepare the message for the e-mail */
$mensagem = "Olá!

Seu formulário de contato foi enviado por:

Name: $nome
E-mail: $email

Gosta do Website? $gosta
Como você achou? $como_achou

Mensagem:
$mensagem

Fim da mensagem.
";

/* Send the message using mail() function */
mail($meuemail, $assunto, $mensagem);

/* Redirect visitor to the thank you page */
header('Location: /obrigado.html');
exit();

/* Functions we used */
function check_input($data, $problem='')
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($problem && strlen($data) == 0)
    {
        show_error($problem);
    }
    return $data;
}

function show_error($myError)
{
?>
    <html>
    <body>

    <b>Por favor corrija o seguinte erro:</b><br />
    <?php echo $myError; ?>

    </body>
    </html>
<?php
exit();
}
?>