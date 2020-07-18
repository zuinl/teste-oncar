<?php
 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

include './config/Veiculo.php';

$json = file_get_contents("php://input");
$data = json_decode($json);

$veiculo = new Veiculo();
if($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'PUT') {
    $veiculo->setModelo($data->modelo);
    $veiculo->setMarca($data->marca);
    $veiculo->setAno($data->ano);
    $veiculo->setDescricao($data->descricao);
    $veiculo->setVendido($data->vendido);
}

switch($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $veiculo->add();
    break;
    case 'GET':
        if(isset($_GET['id'])) {
            $veiculo->setId($_GET['id']);
            $veiculo->getOne();
        } else {
            $busca = (isset($_GET['search']) && !empty($_GET['search'])) ? 
                $_GET['search'] : "";

            $veiculo->getAll($busca);
        }
    break;
    case 'PUT':
        $veiculo->setId($_GET['id']);
        $veiculo->update();
    break;
    case 'DELETE':
        $veiculo->setId($_GET['id']);
        $veiculo->delete();
    break;
    default:
        echo json_encode('Não conseguimos interpretar sua requisição');
        http_response_code(400);
    break;
}

?>