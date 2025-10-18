<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Simular usuário logado
$_SESSION['usuario_logado'] = (object)[
    'Id' => 1,
    'Nome' => 'Teste',
    'Email' => 'teste@teste.com'
];

include "config.php";
include "autoload.php";

echo "<h1>🔍 Debug - Pacientes</h1>";
echo "<style>body{font-family:Arial;padding:20px;} 
       .success{color:green;} 
       .error{color:red;} 
       pre{background:#f5f5f5;padding:10px;border-radius:5px;overflow:auto;}
       table{border-collapse:collapse; width:100%;}
       th, td{border:1px solid #ddd; padding:10px; text-align:left;}
       th{background:#667eea; color:white;}
       </style>";

try {
    echo "<h2>1. Conectando ao banco...</h2>";
    $dao = new App\DAO\PacienteDAO();
    $conexao = App\DAO\DAO::getConexao();
    
    if($conexao) {
        echo "<span class='success'>✅ Conexão OK!</span><br><br>";
    } else {
        echo "<span class='error'>❌ Conexão falhou!</span><br>";
        exit;
    }

    echo "<h2>2. Testando query RAW (sem classe):</h2>";
    $sql = "SELECT id, nome, cpf, telefone, data_nascimento FROM paciente LIMIT 5";
    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    $resultado_raw = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<pre>";
    print_r($resultado_raw);
    echo "</pre>";

    echo "<h2>3. Testando query com AS (mapeada):</h2>";
    $sql_mapeado = "SELECT id as Id, nome as Nome, cpf as CPF, telefone as Telefone, 
                           data_nascimento as Data_Nascimento FROM paciente LIMIT 5";
    $stmt2 = $conexao->prepare($sql_mapeado);
    $stmt2->execute();
    $resultado_mapeado = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<pre>";
    print_r($resultado_mapeado);
    echo "</pre>";

    echo "<h2>4. Testando com FETCH_CLASS:</h2>";
    $stmt3 = $conexao->prepare($sql_mapeado);
    $stmt3->execute();
    $objetos = $stmt3->fetchAll(PDO::FETCH_CLASS, "App\\Model\\Paciente");
    
    echo "<p>Quantidade de pacientes: " . count($objetos) . "</p>";
    
    if(count($objetos) > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Nome</th>";
        echo "<th>CPF</th>";
        echo "<th>Telefone</th>";
        echo "<th>Data Nascimento</th>";
        echo "</tr>";
        
        foreach($objetos as $pac) {
            echo "<tr>";
            echo "<td>" . ($pac->Id ?? 'NULL') . "</td>";
            echo "<td>" . ($pac->Nome ?? 'NULL') . "</td>";
            echo "<td>" . ($pac->CPF ?? 'NULL') . "</td>";
            echo "<td>" . ($pac->Telefone ?? 'NULL') . "</td>";
            echo "<td>" . ($pac->Data_Nascimento ?? 'NULL') . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    echo "<h2>5. Testando DAO->select():</h2>";
    $daoTest = new App\DAO\PacienteDAO();
    $pacientes = $daoTest->select();
    
    echo "<p>Quantidade de pacientes retornados: " . count($pacientes) . "</p>";
    
    if(count($pacientes) > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Nome</th>";
        echo "<th>CPF</th>";
        echo "<th>Telefone</th>";
        echo "<th>Data Nascimento</th>";
        echo "</tr>";
        
        foreach($pacientes as $pac) {
            echo "<tr>";
            echo "<td>" . ($pac->Id ?? 'NULL') . "</td>";
            echo "<td>" . ($pac->Nome ?? 'NULL') . "</td>";
            echo "<td>" . ($pac->CPF ?? 'NULL') . "</td>";
            echo "<td>" . ($pac->Telefone ?? 'NULL') . "</td>";
            echo "<td>" . ($pac->Data_Nascimento ?? 'NULL') . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<span class='error'>❌ Nenhum paciente encontrado!</span>";
    }

    echo "<h2 style='color:green;'>✅ Testes concluídos!</h2>";
    echo "<p>Se os dados aparecem em (2) mas não em (5), o problema está no DAO.</p>";
    echo "<p>Se aparecem em (5) mas não na lista, o problema está na VIEW.</p>";
    
} catch (Exception $e) {
    echo "<span class='error'><h2>❌ ERRO</h2>" . $e->getMessage() . "</span>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
?>