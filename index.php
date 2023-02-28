<?php

require __DIR__ . "/vendor/autoload.php";

use App\Entity\Vaga;
use App\Db\Pagination;
use App\Session\Login;

//Obriga o usuário a está logado
Login::requireLogin();

//Filtro de buscar
$busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

//Filtro de status
$filtrostatus = filter_input(INPUT_GET, 'filtrostatus', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$filtrostatus = in_array($filtrostatus, ['s', 'n']) ? $filtrostatus : '';

//Condições
$condicoes = [
    ($busca === null || $busca === '') ? null : 'titulo like "%' . str_replace(' ', '%', $busca) . '%"',
    ($filtrostatus === null || $filtrostatus === '') ? null : 'ativo = "' . $filtrostatus . '"'

];

$condicoes = array_filter($condicoes);

//Clausula where
$where = implode(' AND ', $condicoes);

// Quantidade total de vagas
$quantidadeVagas = Vaga::getQuantidadeVagas($where);


// Paginação
$obPagination = new Pagination($quantidadeVagas, $_GET['pagina'] ?? 1, 5);

$vagas = Vaga::getVagas($where, null, $obPagination->getLimit());
// var_dump($vagas);
//echo "<pre>"; print_R($vagas); echo "</pre>"; exit;

include __DIR__ . "/includes/header.php";
include __DIR__ . "/includes/listagem.php";
include __DIR__ . "/includes/footer.php";