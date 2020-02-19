<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use \Firebase\JWT\JWT;


$app->get('/pruebalogin', function ($request, $response, $args) {
    header("token:"."123456");
    $prueba = "funciona API";
   
    return  json_encode($prueba);
});

//* Se realiza un login *//   ok
$app->post('/login', function (Request $request, Response $response) {
    $db = conexion();
    $input = $request->getParsedBody();
    $sql = "SELECT * FROM usuario WHERE email= :email";
    $sth = $db->prepare($sql);
    $sth->bindParam("email", $input['email']);
    $sth->execute();
    $user = $sth->fetch(PDO::FETCH_ASSOC);

    // verify email address.
    if (!$user) {
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
        
        
        addTokenBD($token, $user['id']);
        $user = [
            'id' => $user['id'],
            'email' => $user['email']
        ];

        return $this->response->withJson([
            'status' => 'Success',
            'code' => 200,
            'message' => $user

        ])
            ->withAddedHeader('Authorization', $token)
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization');
            
    } else {
        $message = 'El correo o la contraseña es incorrecta';
        return errorResponse($response, $message);

    }
});

//* Se prueba un token y te devuelve coches *//   ok
$app->get('/coches', function (Request $request, Response $response) {

    $esValido = verificarToken($request);  //verifica el token

    if (!$esValido) {
        $response = array(
            'status' => 'ERROR',
            'code' => 404,
            "data" => 'No hay ningún usuario con ese token'
        );
        return json_encode($response);
    }

    if ($esValido) {
        $response = array(
            'status' => 'success',
            'code' => 200,
            "data" => 'AUDI, Citroen'
        );
        return json_encode($response);
    }
});



/*********************** USEFULL FUNCTIONS **************************************/
function addTokenBD($token, $idUsuario)
{
    $db = conexion();
    $sql = "UPDATE usuario SET token = '" . $token . "' where id = '" . $idUsuario . "' ";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $count = $stmt->rowCount();

    if (!$stmt) {
        return 'Error al ejecutar la consulta';
    } else {
        if ($count == 0) {
            
            $response = array(
                'status' => 'ERROR',
                'code' => 404,
                'data' => 'No hay ningún usuario con ese id'
            );
            return json_encode($response);
        } else {

            $response = array(
                'status' => 'Success',
                'code' => 200,
                'data' => 'El token se ha actualizado correctamente en la BD'

            );
            return json_encode($response);
        }
    }
}


function verificarToken($request)
{

    $token = $request->getHeaderLine('Authorization');
    $db = conexion();
    $sql = "SELECT * FROM usuario WHERE token = '" . $token . "' ";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $idempresa = $data['email'];
    $count = $stmt->rowCount(); //Devuelve el nº de filas.


    if (!$stmt) {
        return 'Error al ejecutar la consulta';
    } else {

        if ($count == 0) {
            $response = array(
                'status' => 'ERROR',
                'code' => 404,
                'data' => "No hay ningún usuario con ese token",
                'token' => 'false'
            );
            return false;
        } else {

            $response = array(
                'status' => 'Success',
                'code' => 200,
                'data' => "El token es válido",
                'token' => 'TRUE'

            );
            return true;
        }
    }
}
