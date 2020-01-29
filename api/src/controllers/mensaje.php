<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
require_once 'conexion.php';

//* Mostrar  respuesta *// ok
$app->get('/mensaje', function (Request $request, Response $response){

    $db = conexion();
    $sql="SELECT * FROM mensaje";
    $stmt = $db->prepare($sql);
    $stmt->execute();  
    $count = $stmt->rowCount();
    
    if (!$stmt){
        return 'Error al ejecutar la consulta';
    }else{

        if($count==0){
            $response = array(
                'status' => 'ERROR',
                'code' => 404,		
                "data" => "No hay ninguna mensaje en la base de datos"
            );   
            return json_encode($response);        
        }else{

            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);            
            $response = array(
                'status' => 'success',
                'code' => 200,		
                "data" => $data
                );   
            return json_encode($response);            
         }
    }

});



//* Muestra todos los mensaje con el id del una empresa *//  ok
$app->get('/mensaje/{idEmpresa}', function (Request $request, Response $response) {
    $idEmpresa = $request->getAttribute('idEmpresa');

    $data = getMensaje($idEmpresa);
    
    $response = array(
        'status' => 'Success',
        'code' => 200,		
        'data' => $data
    );
    return json_encode($response);    
  
});


//* Borrar un solo mesnaje con el idMensaje *//  ok
$app->delete('/mensaje/{idMensaje}', function (Request $request, Response $response) {
    $idMensaje = $request->getAttribute('idMensaje');

    $db = conexion();
    $sql = "DELETE FROM mensaje WHERE idMensaje = '" . $idMensaje . "' ";
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
                'data' => 'No hay ninguna mensaje con ese id'
            );
            return json_encode($response);
        } else {

            $response = array(
                'status' => 'Success',
                'code' => 200,
                'data' => 'Se ha eliminado el mensaje correctamente'
            );
            return json_encode($response);
        }
    }
});

//* Actualizar empresa *//   ok
$app->post('/actualizarMensaje', function (Request $request, Response $response, array $args) {

    $data = $request->getParsedBody(); 
    $idMensaje = $data['idMensaje'];  
    $fechaHora = $data['fechaHora'];
    $mensaje = $data['mensaje'];
    $encargadoLlamar = $data['encargadoLlamar'];

    $db = conexion();
    $sql = "UPDATE mensaje SET 
    fechaHora = '" . $fechaHora . "',
    mensaje = '" . $mensaje . "', encargadoLlamar = '" . $encargadoLlamar . "'
    where idMensaje = '" . $idMensaje ."' ";   

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
                'data' => 'No se ha podido actualizar el mensaje o no se ha modificado nada'
            );
            return json_encode($response);
        } else {
            $response = array(
                'status' => 'Success',
                'code' => 200,
                'data' => 'Se ha actualizado el mensaje correctamente'
            );
            return json_encode($response);
        }
    }
});

//************* Funciones ************************ */


function getMensaje($idEmpresa){
    $db = conexion();
    $sql= "SELECT * FROM mensaje WHERE idEmpresa = $idEmpresa";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $count = $stmt->rowCount(); //Devuelve el nº de filas.

    if (!$stmt){
        return 'Error al ejecutar la consulta';
    }else{  
        if($count==0){           
            return 'No hay mensaje';
        }else{  
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
    }
}


