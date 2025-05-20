<?php
require_once __DIR__ . '/app/database/connection.php';
use app\database\Connection;

$sqlAlunos = "SELECT
 aluno.id, aluno.nome, aluno.idade, aluno.media, status.nome
 AS status_nome, aluno.foto 
 FROM aluno 
 JOIN status ON aluno.idStatus = status.id";
$stmt = $pdo->prepare($sqlAlunos); // Prepara o sql com stakeholders
$stmt->execute(); // Executa a consulta no banco
$alunos = $stmt->fetchAll(PDO::FETCH_OBJ);

foreach ($alunos as $aluno) {
    echo "<p>";
    echo "<b>Nome</b>: {$aluno->nome}<br>";
    echo "<b>Status:</b> {$aluno->status_nome}<br>";
    echo "<b>Idade</b>: {$aluno->idade}<br>";
    echo "<b>Média</b>: {$aluno->media}<br>";
    echo"</p><hr>";
}

?>