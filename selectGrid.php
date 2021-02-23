<?php

include_once("conexao.php");

$parametros = "f.id as idf, f.nome as nomef, i.id as idi, i.nome as nomei, di.id as iddi, di.disciplina, di.tempo";
$consulta = "SELECT $parametros FROM fase f inner join iteracao i on (f.id = i.id_fase) inner join disciplina_iteracao di on (di.id_iteracao = i.id)";
$resultado = mysqli_query($conexao, $consulta);

$fases = array();
$rows = [];
$i = 0;
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
    $rows[$i++] = $rowAux;
}

$inicio = array();
$elaboracao = array();
$construcao = array();
$transicao = array();

foreach ($rows as  $value) {
    switch ($value["idf"]) {
        case '1':
            $inicio[sizeof($inicio)] = $value;
            break;
        case '2':
            $elaboracao[sizeof($elaboracao)] = $value;
            break;
        case '3':
            $construcao[sizeof($construcao)] = $value;
            break;
        case '4':
            $transicao[sizeof($transicao)] = $value;
            break;
    }
}
/// INICIO
$iteracao = [];

for($i = 0; $i < sizeof($inicio) / 6; $i++){
    $aux = $inicio[($i*6)];
    $aux2 = $inicio;
    $disciplina = array();
    for($j = 0; $j < 6; $j++){
        $disciplina[$j] = [
            "id" => $aux2[$j + ($i*6)]["iddi"],
            "disciplinas" => $aux2[$j + ($i*6)]["disciplina"],
            "tempo" => $aux2[$j + ($i*6)]["tempo"]
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

for($i = 0; $i < sizeof($elaboracao) / 6; $i++){
    $aux = $elaboracao[($i*6)];
    $aux2 = $elaboracao;
    $disciplina = array();
    for($j = 0; $j < 6; $j++){
        $disciplina[$j] = [
            "id" => $aux2[$j + ($i*6)]["iddi"],
            "disciplinas" => $aux2[$j + ($i*6)]["disciplina"],
            "tempo" => $aux2[$j + ($i*6)]["tempo"]
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

for($i = 0; $i < sizeof($construcao) / 6; $i++){
    $aux = $construcao[($i*6)];
    $aux2 = $construcao;
    $disciplina = array();
    for($j = 0; $j < 6; $j++){
        $disciplina[$j] = [
            "id" => $aux2[$j + ($i*6)]["iddi"],
            "disciplinas" => $aux2[$j + ($i*6)]["disciplina"],
            "tempo" => $aux2[$j + ($i*6)]["tempo"]
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

for($i = 0; $i < sizeof($transicao) / 6; $i++){
    $aux = $transicao[($i*6)];
    $aux2 = $transicao;
    $disciplina = array();
    for($j = 0; $j < 6; $j++){
        $disciplina[$j] = [
            "id" => $aux2[$j + ($i*6)]["iddi"],
            "disciplinas" => $aux2[$j + ($i*6)]["disciplina"],
            "tempo" => $aux2[$j + ($i*6)]["tempo"]
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