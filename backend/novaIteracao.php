<?php
session_start();
if(!isset($_SESSION['idUser'])){
    unset($_SESSION['idUser']);
    unset($_SESSION['user']);
    session_unset();
    header("location: index.php");
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include_once("conexao.php");
include_once("acessarProjeto.php");
acessarProjeto($_GET["projeto"],$conexao);
$projeto = $_GET["projeto"];


$fase = $_GET["fase"];

$nomesFases = ["inicio","elaboracao","construcao","transicao"];

$nomeFase = $nomesFases[$fase - 1];

$consulta = "SELECT id FROM fase WHERE id_projeto = '$projeto' AND nome LIKE '$nomeFase'";
$resultado = mysqli_query($conexao,$consulta);

if($row = mysqli_fetch_assoc($resultado)){
    $idFase = $row["id"];
}

$nomes = ["I","E","C","T"];
mysqli_begin_transaction($conexao);

try {
    $nome = $nomes[$fase-1];
    $autor = $_SESSION["idUser"];
    $consultas = "
        SET @idFase = '$idFase';
        
        WHILE (SELECT (EXISTS (SELECT id FROM iteracao WHERE id_fase = @idFase ORDER BY id DESC LIMIT 1)) = 0) DO
            SET @idFase = @idFase - 1;
        END WHILE;
        SET @idUltimaIteracao = (SELECT id FROM iteracao WHERE id_fase = @idFase ORDER BY id DESC LIMIT 1);
        SET @nomeIteracao = (SELECT COUNT(id) FROM iteracao WHERE id_fase = '$idFase') + 1;
        INSERT INTO iteracao (nome,id_fase) VALUES (CONCAT('$nome',@nomeIteracao),'$idFase');
        SET @idIteracao = (SELECT id FROM iteracao ORDER BY id DESC LIMIT 1);
        SET @iDisc = 1;
        
        WHILE @iDisc <= 9 DO
            INSERT INTO disciplina_iteracao (disciplina,id_iteracao) VALUES (CONCAT('D',@iDisc),@idIteracao);
            SET @idUltimaDisciplinaIteracao = (SELECT id FROM disciplina_iteracao WHERE disciplina LIKE CONCAT('D',@iDisc) AND id_iteracao = @idUltimaIteracao);
            SET @nArtefato = (SELECT COUNT(id) FROM artefatos WHERE id_disciplina_iteracao = @idUltimaDisciplinaIteracao);
            SET @iArtefato = 0;
            SET @cArtefato = 0;
            SET @idDisciplinaIteracao = (SELECT id FROM disciplina_iteracao ORDER BY id DESC LIMIT 1);
            WHILE @iArtefato < @nArtefato DO
                SELECT @idUltimoArtefato := id, @nomeArtefato := nome, @renoArtefato := renomeavel FROM artefatos WHERE id > @cArtefato AND id_disciplina_iteracao = @idUltimaDisciplinaIteracao ORDER BY id LIMIT 1;
                INSERT INTO artefatos (nome,renomeavel,id_disciplina_iteracao,autor) VALUES (@nomeArtefato,@renoArtefato,@idDisciplinaIteracao,'$autor');
                SET @nConteudo = (SELECT COUNT(id) FROM conteudo WHERE id_artefato = @idUltimoArtefato);
                SET @iConteudo = 0;
                SET @cConteudo = 0;
                SET @idArtefato = (SELECT id FROM artefatos ORDER BY id DESC LIMIT 1);
                WHILE @iConteudo < @nConteudo DO
                    SELECT @idUltimoConteudo := id, @nomeConteudo := titulo, @editConteudo := editavel, @textConteudo := texto FROM conteudo WHERE id_artefato = @idUltimoArtefato AND id > @cConteudo ORDER BY id LIMIT 1;
                    INSERT INTO conteudo(titulo,editavel,texto,id_artefato) VALUE (@nomeConteudo,@editConteudo,@textConteudo,@idArtefato);
                    SET @nSubConteudo = (SELECT COUNT(id) FROM subconteudo WHERE id_conteudo = @idUltimoConteudo);
                    SET @iSubConteudo = 0;
                    SET @cSubConteudo = 0;
                    SET @idConteudo = (SELECT id FROM conteudo ORDER BY id DESC LIMIT 1);
                    WHILE @iSubConteudo < @nSubConteudo DO
                        SELECT @idUltimoSubConteudo := id, @nomeSubConteudo := titulo, @editSubConteudo := editavel, @renoSubConteudo := renomeavel, @textSubConteudo := texto FROM subconteudo WHERE id_conteudo = @idUltimoConteudo AND id > @cSubConteudo ORDER BY id LIMIT 1;
                        INSERT INTO subconteudo(titulo,editavel,renomeavel,texto,id_conteudo) VALUE (@nomeSubConteudo,@editSubConteudo,@renoSubConteudo,@textSubConteudo,@idConteudo);
                        SET @nSubConteudo2 = (SELECT COUNT(id) FROM subconteudo2 WHERE id_subconteudo = @idUltimoSubConteudo);
                        SET @iSubConteudo2 = 0;
                        SET @cSubConteudo2 = 0;
                        SET @idSubConteudo = (SELECT id FROM subconteudo ORDER BY id DESC LIMIT 1);
                        WHILE @iSubConteudo2 < @nSubConteudo2 DO
                            SELECT @idUltimoSubConteudo2 := id, @nomeSubConteudo2 := titulo, @renoSubConteudo2 := renomeavel, @textSubConteudo2 := texto FROM subconteudo2 WHERE id_subconteudo = @idUltimoSubConteudo AND id > @cSubConteudo2 ORDER BY id LIMIT 1;
                            INSERT INTO subconteudo2(titulo,renomeavel,texto,id_subconteudo) VALUE (@nomeSubConteudo2,@renoSubConteudo2,@textSubConteudo2,@idSubConteudo);
                            SET @cSubConteudo2 = @idUltimoSubConteudo2;
                            SET @iSubConteudo2 = @iSubConteudo2 + 1;
                        END WHILE;
                        SET @cSubConteudo = @idUltimoSubConteudo;
                        SET @iSubConteudo = @iSubConteudo + 1;
                        END WHILE;
                    SET @cConteudo = @idUltimoConteudo;
                    SET @iConteudo = @iConteudo + 1;
                END WHILE;
                SET @cArtefato = @idUltimoArtefato;
                SET @iArtefato = @iArtefato + 1;
            END WHILE;
            SET @iDisc = @iDisc + 1;
        END WHILE;

    ";

    if (mysqli_multi_query($conexao, $consultas)) {
        do {
            if ($result = mysqli_store_result($conexao)) {
                mysqli_free_result($result);
            }
        } while (mysqli_next_result($conexao));
    }

    mysqli_commit($conexao);
    $projeto = $_GET["projeto"];
    header("Location: ../frontend/canvas.php?projeto=$projeto");
} catch (mysqli_sql_exception $e) {
    mysqli_rollback($conexao);
    throw $e;
}

