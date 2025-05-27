<?php
require_once __DIR__ . '/app/database/connection.php';
use app\database\Connection;

$page = isset($_GET['page']) ? (int) $_GET['page'] :1;
$pageSize = isset($_GET['pageSize']) ? (int) $_GET['pageSize'] :5;
$offset = ($page - 1) * $pageSize; 


$sqlAlunos = "SELECT
 aluno.id, aluno.nome, aluno.idade, aluno.media, status.nome
 AS status_nome, aluno.foto 
 FROM aluno 
 JOIN status ON aluno.idStatus = status.id LIMIT $offset, $pageSize";


$stmt = $pdo->prepare($sqlAlunos); // Prepara o sql com stakeholders
$stmt->execute(); // Executa a consulta no banco
$alunos = $stmt->fetchAll(PDO::FETCH_OBJ);

$count = count($alunos);

$isAjax = isset($_GET['ajax']) && $_GET['ajax'] == 1;


if ($count === 0){
    echo "<p>Nenhum artigo encontrado.</p>";
} else {
    foreach ($alunos as $aluno) {
        echo "<p>";
        echo "<b>Nome</b>: {$aluno->nome}<br>";
        echo "<b>Status:</b> {$aluno->status_nome}<br>";
        echo "<b>Idade</b>: {$aluno->idade}<br>";
        echo "<b>Média</b>: {$aluno->media}<br>";
        echo"</p><hr>";    
    }
}

$sqlCount = "SELECT COUNT(*) FROM aluno JOIN status ON aluno.idStatus = status.id";
$stmtCount = $pdo->prepare($sqlCount);
$stmtCount->execute();
$totalRegistros = $stmtCount->fetchColumn();

$totalPaginas = ceil($totalRegistros / $pageSize);

echo "<div class='paginacao'>";

if ($page > 1){
    echo "<a href='#' data-page='1'>1</a>";
    if ($page > 4){
        echo "<span>...</span>";
    }
}

$start = max(2, $page - 2);
$end = min($totalPaginas - 1, $page +2);

for ($i = $start; $i <= $end; $i++){
    if ($i === $page){
        echo "<strong style='margin:0 5px;'>$i</strong>";
    } else {

        echo "<a href='#' data-page='$i'style='margin:0 5px;'>$i</a>";
    }
}

if ($page < $totalPaginas - 3){
    echo "<span>...</span>";
}

if ($totalPaginas > 1 && $page != $totalPaginas){
    echo "<a href='#' data-page='$totalPaginas'>$totalPaginas</a>";
}

echo "</div>";
?>