<?php
session_start();
if(!isset($_SESSION['idUser'])){
    unset($_SESSION['idUser']);
    unset($_SESSION['user']);
    session_unset();
    header("location: index.php");
}

include_once("conexao.php");
include_once("acessarProjeto.php");
acessarProjeto($_GET["projeto"],$conexao);
$projeto = $_GET["projeto"];

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$disciplina = $_GET["disciplina"];
$tipo = $_GET["tipo"];
$userId = $_SESSION["idUser"];


if($tipo == 1){
    $consulta = "SELECT id FROM artefatos WHERE id_disciplina_iteracao = '$disciplina' AND nome LIKE 'Especificação de caso de uso de negócios: < Nome do caso de uso de negócios>'";
    $resultado = mysqli_query($conexao,$consulta);
    if(mysqli_num_rows($resultado) == 0){
        
        mysqli_begin_transaction($conexao);
        try {
            
            $consultas = " INSERT INTO artefatos(nome,id_disciplina_iteracao,autor,renomeavel,tipo) VALUE ('Especificação de caso de uso de negócios: < Nome do caso de uso de negócios>','$disciplina','$userId','1','1');
            SET @artefato = (SELECT a.id FROM artefatos a WHERE a.id_disciplina_iteracao = '$disciplina' AND a.tipo = '1' ORDER BY id DESC LIMIT 1);
            INSERT INTO conteudo (titulo,id_artefato) VALUE ('Introdução',@artefato);
                SET @conteudo = (SELECT c.id FROM conteudo c INNER JOIN artefatos a ON (c.id_artefato = a.id) WHERE a.id = @artefato ORDER BY id DESC LIMIT 1);
                INSERT INTO subconteudo (titulo,id_conteudo) VALUES ('Objetivo',@conteudo),('Escopo',@conteudo),('Definições, acrônimos e abreviações',@conteudo),('Referências',@conteudo),('Visão Geral',@conteudo);
            INSERT INTO conteudo (titulo,id_artefato) VALUE ('Nome do Caso de Uso de Négocios',@artefato);
                SET @conteudo = (SELECT c.id FROM conteudo c INNER JOIN artefatos a ON (c.id_artefato = a.id) WHERE a.id = @artefato ORDER BY id DESC LIMIT 1);
                INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Breve Descrição',@conteudo);
            INSERT INTO conteudo (titulo,id_artefato) VALUE ('Metas',@artefato);
            INSERT INTO conteudo (titulo,id_artefato,editavel) VALUE ('Metas de Desempenho',@artefato,'1');
                SET @conteudo = (SELECT c.id FROM conteudo c INNER JOIN artefatos a ON (c.id_artefato = a.id) WHERE a.id = @artefato ORDER BY id DESC LIMIT 1);
                INSERT INTO subconteudo (titulo,id_conteudo,renomeavel) VALUE ('< Nome da Meta de Desempenho>',@conteudo,'1');
            INSERT INTO conteudo (titulo,id_artefato) VALUE ('Fluxo de Trabalho',@artefato);
                SET @conteudo = (SELECT c.id FROM conteudo c INNER JOIN artefatos a ON (c.id_artefato = a.id) WHERE a.id = @artefato ORDER BY id DESC LIMIT 1);
                INSERT INTO subconteudo (titulo,id_conteudo,editavel) VALUE ('Fluxo de Trabalho Básico',@conteudo,'1');
                    SET @subconteudo = (SELECT s.id FROM subconteudo s INNER JOIN conteudo c ON (s.id_conteudo = c.id) INNER JOIN artefatos a ON (c.id_artefato = a.id) WHERE a.id = @artefato AND c.id = @conteudo ORDER BY id DESC LIMIT 1);
                    INSERT INTO subconteudo2 (titulo,id_subconteudo,renomeavel) VALUE ('< nome da etapa do fluxo de trabalho>',@subconteudo,'1');
                INSERT INTO subconteudo (titulo,id_conteudo,editavel) VALUE ('Fluxo de Trabalho Alternativos',@conteudo,'1');
                    SET @subconteudo = (SELECT s.id FROM subconteudo s INNER JOIN conteudo c ON (s.id_conteudo = c.id) INNER JOIN artefatos a ON (c.id_artefato = a.id) WHERE a.id = @artefato AND c.id = @conteudo ORDER BY id DESC LIMIT 1);
                    INSERT INTO subconteudo2 (titulo,id_subconteudo,renomeavel) VALUE ('< nome da etapa do fluxo de trabalho>',@subconteudo,'1');
            INSERT INTO conteudo (titulo,id_artefato) VALUES ('Categoria',@artefato),('Risco',@artefato), ('Possibilidades',@artefato), ('Proprietário do Processo',@artefato);
            INSERT INTO conteudo (titulo,id_artefato,editavel) VALUE ('Requisitos Especias',@artefato,'1');
                SET @conteudo = (SELECT c.id FROM conteudo c INNER JOIN artefatos a ON (c.id_artefato = a.id) WHERE a.id = @artefato ORDER BY id DESC LIMIT 1);
                INSERT INTO subconteudo (titulo,id_conteudo,renomeavel) VALUE ('< Nome do Requisito Especial>',@conteudo,'1');
            INSERT INTO conteudo (titulo,id_artefato,editavel) VALUE ('Pontos de Extensão',@artefato,'1');
                SET @conteudo = (SELECT c.id FROM conteudo c INNER JOIN artefatos a ON (c.id_artefato = a.id) WHERE a.id = @artefato ORDER BY id DESC LIMIT 1);
                INSERT INTO subconteudo (titulo,id_conteudo,renomeavel) VALUE ('< Nome do Ponto de Extensão>',@conteudo,'1');
            ";
            if (mysqli_multi_query($conexao, $consultas)) {
                do {
                    if ($result = mysqli_store_result($conexao)) {
                        mysqli_free_result($result);
                    }
                } while (mysqli_next_result($conexao));
            }
            mysqli_commit($conexao);
            header("Location: ../frontend/viewDisciplina.php?id=$disciplina&projeto=$projeto");
        } catch (mysqli_sql_exception $e) {
            mysqli_rollback($conexao);
            throw $e;
        }
        
    }
    else{
        echo "<h1>Renomeie o último artefato de Casos de Negócios na Disciplina!</h1>";
        echo "<h2><a href='../frontend/viewDisciplina.php?id=$disciplina&projeto=$projeto'>Voltar</a></h2>";
    }
}
else if($tipo == 2){
    $consulta = "SELECT id FROM artefatos WHERE id_disciplina_iteracao = '$disciplina' AND nome LIKE 'Especificação de realização de caso de uso de negócios: < Nome do caso de uso de negócios>'";
    $resultado = mysqli_query($conexao,$consulta);
    if(mysqli_num_rows($resultado) == 0){
        
        mysqli_begin_transaction($conexao);
        try {
            
            $consultas = " INSERT INTO artefatos(nome,id_disciplina_iteracao,autor,renomeavel,tipo) VALUE ('Especificação de realização de caso de uso de negócios: < Nome do caso de uso de negócios>','$disciplina','$userId','1','2');
            SET @artefato = (SELECT a.id FROM artefatos a WHERE a.id_disciplina_iteracao = '$disciplina' AND a.tipo = '2' ORDER BY id DESC LIMIT 1);
            INSERT INTO conteudo (titulo,id_artefato) VALUE ('Introdução',@artefato);
                SET @conteudo = (SELECT c.id FROM conteudo c INNER JOIN artefatos a ON (c.id_artefato = a.id) WHERE a.id = @artefato ORDER BY id DESC LIMIT 1);
                INSERT INTO subconteudo (titulo,id_conteudo) VALUES ('Objetivo',@conteudo),('Escopo',@conteudo),('Definições, acrônimos e abreviações',@conteudo),('Referências',@conteudo),('Visão Geral',@conteudo);
            INSERT INTO conteudo (titulo,id_artefato) VALUE ('Realização do Fluxo de Trabalho',@artefato);
            INSERT INTO conteudo (titulo,id_artefato) VALUE ('Requisitos Derivados',@artefato);
            ";
            if (mysqli_multi_query($conexao, $consultas)) {
                do {
                    if ($result = mysqli_store_result($conexao)) {
                        mysqli_free_result($result);
                    }
                } while (mysqli_next_result($conexao));
            }
            mysqli_commit($conexao);
            header("Location: ../frontend/viewDisciplina.php?id=$disciplina&projeto=$projeto");
        } catch (mysqli_sql_exception $e) {
            mysqli_rollback($conexao);
            throw $e;
        }
        
    }
    else{
        echo "<h1>Renomeie o último artefato de Realização de Casos de Negócios na Disciplina!</h1>";
        echo "<h2><a href='../frontend/viewDisciplina.php?id=$disciplina&projeto=$projeto'>Voltar</a></h2>";
    }
}
else if($tipo == 3){
    $consulta = "SELECT id FROM artefatos WHERE id_disciplina_iteracao = '$disciplina' AND nome LIKE 'Especificação de caso de uso: < Nome do caso de uso>'";
    $resultado = mysqli_query($conexao,$consulta);
    if(mysqli_num_rows($resultado) == 0){
        
        mysqli_begin_transaction($conexao);
        try {
            
            $consultas = " INSERT INTO artefatos(nome,id_disciplina_iteracao,autor,renomeavel,tipo) VALUE ('Especificação de caso de uso: < Nome do caso de uso>','$disciplina','$userId','1','3');
            SET @artefato = (SELECT a.id FROM artefatos a WHERE a.id_disciplina_iteracao = '$disciplina' AND a.tipo = '3' ORDER BY id DESC LIMIT 1);
            INSERT INTO conteudo (titulo,id_artefato) VALUE ('Nome do Caso de Uso',@artefato);
                SET @conteudo = (SELECT c.id FROM conteudo c INNER JOIN artefatos a ON (c.id_artefato = a.id) WHERE a.id = @artefato ORDER BY id DESC LIMIT 1);
                INSERT INTO subconteudo (titulo,id_conteudo) VALUES ('Breve Descrição',@conteudo);
            INSERT INTO conteudo (titulo,id_artefato) VALUE ('Fluxo de Eventos',@artefato);
                SET @conteudo = (SELECT c.id FROM conteudo c INNER JOIN artefatos a ON (c.id_artefato = a.id) WHERE a.id = @artefato ORDER BY id DESC LIMIT 1);
                INSERT INTO subconteudo (titulo,id_conteudo, editavel) VALUES ('Fludo Básico',@conteudo,'1'),('Fluxo Alternativo',@conteudo, '1');
                SET @subconteudo = (SELECT s.id FROM subconteudo s INNER JOIN conteudo c ON (s.id_conteudo = c.id) INNER JOIN artefatos a ON (c.id_artefato = a.id) WHERE a.id = @artefato AND c.id = @conteudo ORDER BY id DESC LIMIT 1);
                    INSERT INTO subconteudo2 (titulo,id_subconteudo,renomeavel) VALUE ('< Primeiro Fluxo Alternativo>',@subconteudo,'1'),('< Segundo Fluxo Alternativo>',@subconteudo,'1');
            INSERT INTO conteudo (titulo,id_artefato,editavel) VALUE ('Requisitos Especiais',@artefato,'1');
                SET @conteudo = (SELECT c.id FROM conteudo c INNER JOIN artefatos a ON (c.id_artefato = a.id) WHERE a.id = @artefato ORDER BY id DESC LIMIT 1);
                INSERT INTO subconteudo (titulo,id_conteudo, renomeavel) VALUES ('< Primeiro Requisito Especial>',@conteudo,'1'),('Fluxo Alternativo',@conteudo, '1');
            INSERT INTO conteudo (titulo,id_artefato,editavel) VALUE ('Condições Prévias',@artefato,'1');
                SET @conteudo = (SELECT c.id FROM conteudo c INNER JOIN artefatos a ON (c.id_artefato = a.id) WHERE a.id = @artefato ORDER BY id DESC LIMIT 1);
                INSERT INTO subconteudo (titulo,id_conteudo, renomeavel) VALUES ('< Pre-condição um>',@conteudo,'1'),('Fluxo Alternativo',@conteudo, '1');
            INSERT INTO conteudo (titulo,id_artefato,editavel) VALUE ('Pós-condições',@artefato,'1');
                SET @conteudo = (SELECT c.id FROM conteudo c INNER JOIN artefatos a ON (c.id_artefato = a.id) WHERE a.id = @artefato ORDER BY id DESC LIMIT 1);
                INSERT INTO subconteudo (titulo,id_conteudo, renomeavel) VALUES ('< Pós-condição um>',@conteudo,'1'),('Fluxo Alternativo',@conteudo, '1');
            INSERT INTO conteudo (titulo,id_artefato,editavel) VALUE ('Ponto de Extensão',@artefato,'1');
                SET @conteudo = (SELECT c.id FROM conteudo c INNER JOIN artefatos a ON (c.id_artefato = a.id) WHERE a.id = @artefato ORDER BY id DESC LIMIT 1);
                INSERT INTO subconteudo (titulo,id_conteudo, renomeavel) VALUES ('< Nome do Ponto de Extensão>',@conteudo,'1'),('Fluxo Alternativo',@conteudo, '1');
            ";
            if (mysqli_multi_query($conexao, $consultas)) {
                do {
                    if ($result = mysqli_store_result($conexao)) {
                        mysqli_free_result($result);
                    }
                } while (mysqli_next_result($conexao));
            }
            mysqli_commit($conexao);
            header("Location: ../frontend/viewDisciplina.php?id=$disciplina&projeto=$projeto");
        } catch (mysqli_sql_exception $e) {
            mysqli_rollback($conexao);
            throw $e;
        }
        
    }
    else{
        echo "<h1>Renomeie o último artefato de Casos na Disciplina!</h1>";
        echo "<h2><a href='../frontend/viewDisciplina.php?id=$disciplina&projeto=$projeto'>Voltar</a></h2>";
    }
}
else if($tipo == 4){
    $consulta = "SELECT id FROM artefatos WHERE id_disciplina_iteracao = '$disciplina' AND nome LIKE 'Especificação de Requisitos de Software Para < Subsistema ou Recurso>'";
    $resultado = mysqli_query($conexao,$consulta);
    if(mysqli_num_rows($resultado) == 0){
        
        mysqli_begin_transaction($conexao);
        try {
            
            $consultas = " INSERT INTO artefatos(nome,id_disciplina_iteracao,autor,renomeavel,tipo) VALUE ('Especificação de Requisitos de Software Para < Subsistema ou Recurso>','$disciplina','$userId','1','4');
            SET @artefato = (SELECT a.id FROM artefatos a WHERE a.id_disciplina_iteracao = '$disciplina' AND a.tipo = '4' ORDER BY id DESC LIMIT 1);
            INSERT INTO conteudo (titulo,id_artefato) VALUE ('Introdução',@artefato);
                SET @conteudo = (SELECT c.id FROM conteudo c INNER JOIN artefatos a ON (c.id_artefato = a.id) WHERE a.id = @artefato ORDER BY id DESC LIMIT 1);
                INSERT INTO subconteudo (titulo,id_conteudo) VALUES ('Objetivo',@conteudo),('Escopo',@conteudo),('Definições, acrônimos e abreviações',@conteudo),('Referências',@conteudo),('Visão Geral',@conteudo);
            INSERT INTO conteudo (titulo,id_artefato) VALUE ('Descrição Geral',@artefato);
                SET @conteudo = (SELECT c.id FROM conteudo c INNER JOIN artefatos a ON (c.id_artefato = a.id) WHERE a.id = @artefato ORDER BY id DESC LIMIT 1);
                INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Pesquisa de Modelo de Caso de Uso',@conteudo),('Suposições e Dependências',@conteudo);
            INSERT INTO conteudo (titulo,id_artefato) VALUE ('Requisitos Específicos',@artefato);
                SET @conteudo = (SELECT c.id FROM conteudo c INNER JOIN artefatos a ON (c.id_artefato = a.id) WHERE a.id = @artefato ORDER BY id DESC LIMIT 1);
                INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Relatórios de Caso de Uso',@conteudo),('Requisitos Suplementares',@conteudo);
            INSERT INTO conteudo (titulo,id_artefato) VALUE ('Informações de Apoio',@artefato);
            ";
            if (mysqli_multi_query($conexao, $consultas)) {
                do {
                    if ($result = mysqli_store_result($conexao)) {
                        mysqli_free_result($result);
                    }
                } while (mysqli_next_result($conexao));
            }
            mysqli_commit($conexao);
            header("Location: ../frontend/viewDisciplina.php?id=$disciplina&projeto=$projeto");
        } catch (mysqli_sql_exception $e) {
            mysqli_rollback($conexao);
            throw $e;
        }
        
    }
    else{
        echo "<h1>Renomeie o último artefato Requisitos de Software!</h1>";
        echo "<h2><a href='../frontend/viewDisciplina.php?id=$disciplina&projeto=$projeto'>Voltar</a></h2>";
    }
}
else if($tipo == 5){
    $consulta = "SELECT id FROM artefatos WHERE id_disciplina_iteracao = '$disciplina' AND nome LIKE 'Especificação de realização de caso de uso: < Nome do caso de uso>'";
    $resultado = mysqli_query($conexao,$consulta);
    if(mysqli_num_rows($resultado) == 0){
        
        mysqli_begin_transaction($conexao);
        try {
            
            $consultas = " INSERT INTO artefatos(nome,id_disciplina_iteracao,autor,renomeavel,tipo) VALUE ('Especificação de realização de caso de uso: < Nome do caso de uso>','$disciplina','$userId','1','4');
            SET @artefato = (SELECT a.id FROM artefatos a WHERE a.id_disciplina_iteracao = '$disciplina' AND a.tipo = '4' ORDER BY id DESC LIMIT 1);
            INSERT INTO conteudo (titulo,id_artefato) VALUE ('Introdução',@artefato);
                SET @conteudo = (SELECT c.id FROM conteudo c INNER JOIN artefatos a ON (c.id_artefato = a.id) WHERE a.id = @artefato ORDER BY id DESC LIMIT 1);
                INSERT INTO subconteudo (titulo,id_conteudo) VALUES ('Objetivo',@conteudo),('Escopo',@conteudo),('Definições, acrônimos e abreviações',@conteudo),('Referências',@conteudo),('Visão Geral',@conteudo);
            INSERT INTO conteudo (titulo,id_artefato) VALUE ('Fluxo de Eventos - Design',@artefato);
            INSERT INTO conteudo (titulo,id_artefato) VALUE ('Requisitos Derivados',@artefato);
            ";
            if (mysqli_multi_query($conexao, $consultas)) {
                do {
                    if ($result = mysqli_store_result($conexao)) {
                        mysqli_free_result($result);
                    }
                } while (mysqli_next_result($conexao));
            }
            mysqli_commit($conexao);
            header("Location: ../frontend/viewDisciplina.php?id=$disciplina&projeto=$projeto");
        } catch (mysqli_sql_exception $e) {
            mysqli_rollback($conexao);
            throw $e;
        }
        
    }
    else{
        echo "<h1>Renomeie o último artefato Realização de Caso de Uso da Disciplina!</h1>";
        echo "<h2><a href='../frontend/viewDisciplina.php?id=$disciplina&projeto=$projeto'>Voltar</a></h2>";
    }
}


