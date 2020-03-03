<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once 'src/functions/functions.php';
require_once 'conexion.php';


//* Mostrar todas las empresas, (localidades y telefonos) *//  oK
$getAllEmpresa = "";
$app->get('/empresa', function (Request $request, Response $response) {

    $sql = "SELECT * FROM empresa";
    $stmt = executeQuery($sql);
    $count = $stmt->rowCount();

    if ($count == 0) {
        $message = "No hay ninguna empresa en la base de datos";
        return errorResponse($response, $message);
    } else {
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $response = array();
        foreach ($data as $row) {

            $idEmpresas = $row['idEmpresa'];
            $telefono = getTelefono($idEmpresas);
            $telefono = array(
                'telefono' => $telefono
            );
            //unir array datosEmpresa y telefono
            $array_resultante = array_merge($row, $telefono);
            array_push($response, $array_resultante);
        }
        return response($response, $response);
    }
});


//* Muestra una empresa, (localidad y telefonos), y mensajes con un Id *//   ok
$getEmpresaID = "";
$app->get('/empresa/{idEmpresa}', function (Request $request, Response $response) {
    $idEmpresa = $request->getAttribute('idEmpresa');

    $sql = "SELECT * FROM empresa WHERE idEmpresa = '" . $idEmpresa . "' ";
    $stmt = executeQuery($sql);
    $count = $stmt->rowCount();

    if ($count == 0) {
        $message = 'No hay ninguna empresa con ese ID en la base de datos';
        return errorResponse($response, $message);
    } else {
        //get dataEmpresa
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        //get Telefono
        $idempresa = $data['idEmpresa'];
        $telefono = getTelefono($idEmpresa);
        //$mensaje = getMensaje($idEmpresa);

        $response = array(
            'status' => 'Success',
            'code' => 200,
            'data' => $data,
            'telefono' => $telefono
            //'mensaje' => $mensaje

        );
       
        return json_encode($response);
    }
});

//* Add empresa *//
$addEmpresa = "";
$app->post('/empresa', function (Request $request, Response $response) {
    $data = $request->getParsedBody();
    $telefono = $data['telefono'];
    $localidad = strtoupper($data['localidad']);

    //comprobar telefonno
    $ctelefono =  comprobarTelefono($request, $response);
    $idEmpresa = $ctelefono['idEmpresa'];

    if ($ctelefono['comprobar'] == 'existe') {

        $Clocalidad = comprobarLocalidad($idEmpresa, $localidad, $telefono);

        //comprueba localidad
        if ($Clocalidad['comprobar'] == 'existe') {
            //comprueba localidad-> caso 2
            $message = 'No se ha añadido a la base de datos porque el telefono ya existe y la localidad tambien';
            return errorResponse($response, $message);
        } else {
            //añadir pueblo ->caso 3
            //añadir pueblo aunque sea con el mismo telefono //con esto podremos saber donde trabaja

            $result2 = addLocalidadTelefono($idEmpresa, $telefono, $localidad);
            if ($result2 == false) {
                $message = 'La localidad y el telefono no se han añadido';
                return errorResponse($response, $message);
            } else {
                $message = 'Se ha añadido correctamente la localidad o el telefono';
                return response($response, $message);
            }
        }
    }

    //si el telefono es distinto 
    if ($ctelefono['comprobar']  == 'noExiste') { //cuando el telefono es distinto     
        //compuebo el nombre de la empresa     
        $cnombreEmpresa = compruebaNombreEmpresa($request);

        if ($cnombreEmpresa['comprobar'] == 'existe') {
            //añadir pueblo y telefono-> caso 1 y 4

            $idEmpresa = $cnombreEmpresa['idEmpresa'];
            $result2 = addLocalidadTelefono2($idEmpresa, $telefono, $localidad);


            if ($result2 == false) {
                $message = 'La localidad y el telefono no se han añadido';
                return errorResponse($response, $message);
            } else {
                $message = 'Se ha añadido correctamente la localidad o el telefono';
                return response($response, $message);
            }
        } else {
            //añadir empresa -> caso 5
            $caddEmpresa = addEmpresa($request, $response);
            return $caddEmpresa;
        }
    }
});



//* Actualizar empresa *//   ok
$updateEmpresa = "";
$app->post('/actualizarEmpresa', function (Request $request, Response $response, array $args) {

    $data = $request->getParsedBody();

    $idEmpresa = $data['idEmpresa'];
    $provincia = strtoupper($data['provincia']);
    $nombreEmpresa = $data['nombreEmpresa'];
    $nombreTecnico = $data['nombreTecnico'];
    $especialidad = $data['especialidad'];
    $direccion = $data['direccion'];
    $email = $data['email'];
    $web = $data['web'];
    $horario = $data['horario'];
    $especificacion = $data['especificacion'];
    $contratado = $data['contratado'];
    $repetido = $data['repetido'];
    $webFound = $data['webFound'];
    $interesado = $data['interesado'];
    $comentario = $data['comentario'];

    $db = conexion();
    $sql = "UPDATE empresa SET 
    provincia = '" . $provincia . "', nombreEmpresa = '" . $nombreEmpresa . "',
    nombreTecnico = '" . $nombreTecnico . "', especialidad = '" . $especialidad . "',
    direccion = '" . $direccion . "', email = '" . $email . "' ,
    web = '" . $web . "' , horario = '" . $horario . "', 
    especificacion = '" . $especificacion . "', contratado = '" . $contratado . "',
    repetido = '" . $repetido . "', webFound = '" . $webFound . "', interesado = '" . $interesado . "',
    comentario = '" . $comentario . "' where idEmpresa = '" . $idEmpresa . "'";
    $stmt = $db->prepare($sql);
    $stmt->execute();

    $count = $stmt->rowCount();

    if (!$stmt) {
        return 'Error al ejecutar la consulta';
    } else {
        if ($count == 0) {
            $message = 'No hay ninguna empresa con ese id o
             no se ha actualizado ningun datos porque son los mismos datos';
            return errorResponse($response, $message);
        } else {
            $message = 'Se ha actualizado los datos de la empresa correctamente';
            return response($response, $message);
        }
    }
});

//* Borrar empresa y sus tablas en cascada pasandole por parámetros un Id de empresa*//  ok
$app->delete('/empresa/{idEmpresa}', function (Request $request, Response $response) {
    $idEmpresa = $request->getAttribute('idEmpresa');

    $sql = "DELETE FROM empresa WHERE idEmpresa = '" . $idEmpresa . "' ";
    $stmt = executeQuery($sql);

    $messageError = 'No hay ninguna empresa con ese id';
    $messageSuccess = 'Se ha eliminado la empresa y todos sus registros en sus tablas correspondientes';
    return responseMessage($response, $stmt, $messageError, $messageSuccess);
});





//************* Funciones ************************ */

//* comprueba el telefono *// parece que bien
function comprobarTelefono($request, $response)
{

    $data = $request->getParsedBody();
    $telefono = $data['telefono'];

    $sql = "SELECT idEmpresa FROM telefono WHERE telefono = '" . $telefono . "' ";
    $stmt = executeQuery($sql);
    $count = $stmt->rowCount();

    $idEmpresa = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$stmt) {
        return 'Error al ejecutar la consulta';
    } else {

        if ($count == 0) { //no existe el telefono hay que añadir
            $response = array(
                'comprobar' => 'noExiste',
                'idEmpresa' => null
            );
            return $response;
        } else { // existe el telefono no hay que añadir

            $response = array(
                'comprobar' => 'existe',
                'idEmpresa' => $idEmpresa['idEmpresa']
            );
            return $response;
        }
    }
}


//* comprueba la localidad *// parece que bien
function comprobarLocalidad($idEmpresa, $localidad, $telefono)
{

    $sql = "SELECT idtelefono FROM telefono WHERE localidad = '" . $localidad . "'  AND idEmpresa = '" . $idEmpresa . "' ";
    $db = conexion();
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $count = $stmt->rowCount();

    $idEmpresa = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$stmt) {
        return 'Error al ejecutar la consulta';
    } else {

        if ($count == 0) { // como no existe hay que añadir pueblo
            $response = array(
                'comprobar' => 'noExiste',
                'idEmpresa' => null
            );
            return $response;
        } else { //como si este pueblo no hay que añadir

            $response = array(
                'comprobar' => 'existe'
            );
            return $response;
        }
    }
}

//* comprueba el nombre de la empresa y que me devuelva el ID de la empresa*// parece que bien
function compruebaNombreEmpresa($request)
{
    $data = $request->getParsedBody();
    $nombreEmpresa = $data['nombreEmpresa'];

    $sql = "SELECT idEmpresa FROM empresa WHERE nombreEmpresa = '" . $nombreEmpresa . "' ";
    $db = conexion();
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $count = $stmt->rowCount();

    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$stmt) {
        return 'Error al ejecutar la consulta';
    } else {

        if ($count == 0) {
            $response = array(
                'comprobar' => 'noExiste',
            );
            return $response;
        } else {
            $response = array(
                'comprobar' => 'existe',
                'idEmpresa' => $data['idEmpresa']
            );
            return $response;
        }
    }
}

function addEmpresa($request, $response)
{

    $data = $request->getParsedBody();
    /*tabla empresa*/
    $provincia = strtoupper($data['provincia']);
    $nombreEmpresa = $data['nombreEmpresa'];
    $nombreTecnico = $data['nombreTecnico'];
    $especialidad = $data['especialidad'];
    $direccion = $data['direccion'];
    $email = $data['email'];
    $web = $data['web'];
    $horario = $data['horario'];
    $especificacion = $data['especificacion'];
    $contratado = $data['contratado'];
    $repetido = $data['repetido'];
    $webFound = $data['webFound'];
    $interesado = $data['interesado'];
    $comentario = $data['comentario'];
    $creacion = date('Y-m-d H:i:s');
    $ocultar = $data['ocultar'];
    /*tabla telefono*/
    $localidad = strtoupper($data['localidad']);
    $telefono = $data['telefono'];


    $db = conexion();
    $sql = "INSERT INTO empresa (provincia, nombreEmpresa, nombreTecnico, especialidad, direccion, email,
    web, horario, especificacion, contratado, repetido, webFound, interesado, comentario, creacion, ocultar)
    VALUES ('" . $provincia . "', '" . $nombreEmpresa . "', '" . $nombreTecnico . "',
    '" . $especialidad . "', '" . $direccion . "', '" . $email . "' , '" . $web . "' ,
     '" . $horario . "', '" . $especificacion . "', '" . $contratado . "', 
     '" . $repetido . "', '" . $webFound . "', '" . $interesado . "', '" . $comentario . "',
     '" . $creacion . "', '" . $ocultar . "' )";
    $stmt = $db->prepare($sql);
    $stmt->execute();


    $idEmpresa = $db->lastInsertId();
    $sql = "INSERT INTO telefono (idEmpresa, localidad, telefono)
    VALUES ('" . $idEmpresa . "', '" . $localidad . "', '" . $telefono . "')";
    $stmt = $db->prepare($sql);
    $stmt->execute();



    if (!$stmt) {
        return 'Error al ejecutar la consulta';
    } else {
        $result = array(
            'status' => 'success',
            'code' => 200,
            'data' => 'Se ha añadido la empresa correctamente'
        );
        return json_encode($result);
    }
}


//* Añade localidad y telefono *// ok
function addLocalidadTelefono2($idEmpresa, $telefono, $localidad)
{
    $db = conexion();
    $sql = "INSERT INTO telefono (idEmpresa, localidad, telefono) 
    VALUES ('" . $idEmpresa . "', '" . $localidad . "', '" . $telefono . "')";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $count = $stmt->rowCount();

    if (!$stmt) {
        return 'Error al ejecutar la consulta';
    } else {
        if ($count == 0) {
            return false;
        } else {
            return  true;
        }
    }
}


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

