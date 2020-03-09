<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use \Firebase\JWT\JWT;


//* Se realiza un login *//   ok
$login = "";
$app->post('/login', function (Request $request, Response $response) {
    $db = conexion();
    $json = $request->getBody();
    $input = json_decode($json, true);

    $sql = "SELECT * FROM usuario WHERE email= :email";
    $sth = $db->prepare($sql);
    $sth->bindParam("email", $input['email']);
    $sth->execute();
    $user = $sth->fetch(PDO::FETCH_ASSOC);

    if (!$user) {    // verify email address.
        $message = 'El correo o la contraseña es incorrecta';
        return errorResponse($response, $message);
    }

    // verify password.
    if (($input['password'] == $user['password'])) {

        $settings = $this->get('settings'); // get settings array.
        //El token no varie y se pueda usar en varios dispostivos
        //$now = new DateTime();
        //$future = new DateTime("now +10 seconds");
        $payload = [
            'id' => $user['id'],
            'email' => $user['email']
            //,"iat" => $now->getTimeStamp(),
            //"nbf" => $future->getTimeStamp()
        ];
        $secret =  $settings['jwt']['secret'];
        $token = JWT::encode($payload, $secret, "HS256");


        addTokenBD($response, $token, $user['id']);
        $user = [
            'id' => $user['id'],
            'email' => $user['email']
        ];

        return $this->response->withJson([
            'status' => 'Success',
            'code' => 200,
            'data' => $user

        ])
            ->withAddedHeader('Authorization', $token)
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization');
    } else {
        $message = 'El correo o la contraseña es incorrecta';
        return errorResponse($response, $message);
    }
});

//* Se prueba un token y te devuelve coches *//   ok
$getCoches = "";
$app->get('/coches', function (Request $request, Response $response) {
    $esValido = verificarToken($request);

    if (!$esValido) {
        $message = 'No hay ningún usuario con ese token';
        return errorResponse($response, $message);
    }
    if ($esValido) {
        $message = 'AUDI, Citroen';
        return response($response, $message);
    }
});

$pruebalogin = "";
$app->get('/pruebalogin', function ($request, $response, $args) {
    header("token:" . "123456");
    $prueba = "funciona API";

    return  json_encode($prueba);
});


/*********************** USEFULL FUNCTIONS **************************************/
function addTokenBD($response, $token, $idUsuario)
{
    $sql = "UPDATE usuario SET token = '" . $token . "' where id = '" . $idUsuario . "' ";    
    $stmt = executeQuery($sql);

    $messageError = 'No hay ningún usuario con ese id';
    $messageSuccess = 'El token se ha actualizado correctamente en la BD';
    return responseMessage($response, $stmt, $messageError, $messageSuccess);
}


function verificarToken($request)
{
    $token = $request->getHeaderLine('Authorization');
    $sql = "SELECT * FROM usuario WHERE token = '" . $token . "' ";
    $stmt = executeQuery($sql);
    $count = $stmt->rowCount();

    if ($count == 0) {
        return false;
    } else {
        return true;
    }
    
}
