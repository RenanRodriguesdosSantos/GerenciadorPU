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

$parametros = "f.id as idf, f.nome as nomef, i.id as idi, i.nome as nomei, di.id as iddi, di.disciplina, di.tempo";
$consulta = "SELECT $parametros FROM fase f inner join iteracao i on (f.id = i.id_fase) inner join disciplina_iteracao di on (di.id_iteracao = i.id) WHERE f.id_projeto = '$projeto'";
$resultado = mysqli_query($conexao, $consulta);

$fases = array();
$rows = [];

while($row = mysqli_fetch_assoc($resultado)){
    $rowAux = [
        "idf" => $row["idf"],
        "nomef" => $row["nomef"],
        "idi" => $row["idi"],
        "nomei" => $row["nomei"],
        "iddi" => $row["iddi"],
        "disciplina" => $row["disciplina"],
        "tempo" => $row["tempo"]
    ];
    $rows[] = $rowAux;
}

$inicio = array();
$elaboracao = array();
$construcao = array();
$transicao = array();

foreach ($rows as  $value) {
    switch ($value["nomef"]) {
        case 'inicio':
            $inicio[sizeof($inicio)] = $value;
            break;
        case 'elaboracao':
            $elaboracao[sizeof($elaboracao)] = $value;
            break;
        case 'construcao':
            $construcao[sizeof($construcao)] = $value;
            break;
        case 'transicao':
            $transicao[sizeof($transicao)] = $value;
            break;
    }
}
/// INICIO
$iteracao = [];

for($i = 0; $i < sizeof($inicio) / 9; $i++){
    $aux = $inicio[($i*9)];
    $aux2 = $inicio;
    $disciplina = array();
    for($j = 0; $j < 9; $j++){
        $disciplina[$j] = [
            "id" => $aux2[$j + ($i*9)]["iddi"],
            "disciplinas" => $aux2[$j + ($i*9)]["disciplina"],
            "tempo" => $aux2[$j + ($i*9)]["tempo"]
        ];
    }
    $iteracao[$i] = [
        "id" => $aux["idi"],
        "nome" => $aux["nomei"],
        "disciplinas" => $disciplina
    ];
}

$fases[0] = ["id" => "1", "nome" => "inicio", "titulo" => "Início", "iteracao" => $iteracao];
/// ELABORAÇÃO
$iteracao = [];

for($i = 0; $i < sizeof($elaboracao) / 9; $i++){
    $aux = $elaboracao[($i*9)];
    $aux2 = $elaboracao;
    $disciplina = array();
    for($j = 0; $j < 9; $j++){
        $disciplina[$j] = [
            "id" => $aux2[$j + ($i*9)]["iddi"],
            "disciplinas" => $aux2[$j + ($i*9)]["disciplina"],
            "tempo" => $aux2[$j + ($i*9)]["tempo"]
        ];
    }
    $iteracao[$i] = [
        "id" => $aux["idi"],
        "nome" => $aux["nomei"],
        "disciplinas" => $disciplina
    ];
}

$fases[1] = ["id" => "2", "nome" => "elaboracao", "titulo" => "Elaboração", "iteracao" => $iteracao];

///CONSTRUCAO
$iteracao = [];

for($i = 0; $i < sizeof($construcao) / 9; $i++){
    $aux = $construcao[($i*9)];
    $aux2 = $construcao;
    $disciplina = array();
    for($j = 0; $j < 9; $j++){
        $disciplina[$j] = [
            "id" => $aux2[$j + ($i*9)]["iddi"],
            "disciplinas" => $aux2[$j + ($i*9)]["disciplina"],
            "tempo" => $aux2[$j + ($i*9)]["tempo"]
        ];
    }
    $iteracao[$i] = [
        "id" => $aux["idi"],
        "nome" => $aux["nomei"],
        "disciplinas" => $disciplina
    ];
}

$fases[2] = ["id" => "3", "nome" => "contrucao", "titulo" => "Contrução", "iteracao" => $iteracao];

/// TRANSICAO
$iteracao = [];

for($i = 0; $i < sizeof($transicao) / 9; $i++){
    $aux = $transicao[($i*9)];
    $aux2 = $transicao;
    $disciplina = array();
    for($j = 0; $j < 9; $j++){
        $disciplina[$j] = [
            "id" => $aux2[$j + ($i*9)]["iddi"],
            "disciplinas" => $aux2[$j + ($i*9)]["disciplina"],
            "tempo" => $aux2[$j + ($i*9)]["tempo"]
        ];
    }
    $iteracao[$i] = [
        "id" => $aux["idi"],
        "nome" => $aux["nomei"],
        "disciplinas" => $disciplina
    ];
}

$fases[3] = ["id" => "4", "nome" => "transicao", "titulo" => "Transição", "iteracao" => $iteracao];



echo json_encode($fases);