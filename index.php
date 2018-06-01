<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
    <input type="hidden" name="cmd" value="_s-xclick">
    <input type="hidden" name="hosted_button_id" value="COD_PAYPAL">
    <input type="image" src="https://www.sandbox.paypal.com/pt_BR/BR/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - A maneira fácil e segura de enviar pagamentos online!">
    <img alt="" border="0" src="https://www.sandbox.paypal.com/pt_BR/i/scr/pixel.gif" width="1" height="1">
</form>


<?php
/**
 * Created by PhpStorm.
 * User: gustavoweb
 * Date: 30/05/2018
 * Time: 09:37
 */

echo "<h1>Teste de Integração com a Paypal</h1>";

$getData = filter_input_array(INPUT_GET, FILTER_DEFAULT);

require __DIR__ . '/Paypal.php';

$paypal = new \Payment\Paypal(false);
$transaction = $paypal->getDataTransaction($getData['tx']);

echo "<h1>Seja muito bem vindo {$transaction['first_name']}, o seu e-mail de cadastro é: {$transaction['payer_email']}</h1>";