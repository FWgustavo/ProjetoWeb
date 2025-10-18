<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Simular usuário logado para teste
$_SESSION['usuario_logado'] = (object)[
    'Id' => 1,
    'Nome' => 'Teste',
    'Email' => 'teste@teste.com'
];

include "config.php";
include "autoload.php";

echo "<h1>Teste de Conexão e Consultas</h1>";
echo "<style>body{font-family:Arial;padding:20px;} .success{color:green;} .error{color:red;} pre{background:#f5f5f5;padding:10px;border-radius:5px;}</style>";

try {
    // Teste 1: Conexão
    echo "<h2>1. Testando Conexão</h2>";
    $dao = new App\DAO\MedicoDAO();
    $conexao = App\DAO\DAO::getConexao();
    
    if($conexao) {
        echo "<span class='success'>✅ Conexão com banco estabelecida!</span><br><br>";
    } else {
        echo "<span class='error'>❌ Falha na conexão!</span><br>";
        exit;
    }
    
    // Teste 2: Verificar se a tabela existe
    echo "<h2>2. Verificando Tabela 'medico'</h2>";
    try {
        $sql = "SHOW TABLES LIKE 'medico'";
        $stmt = $conexao->prepare($sql);
        $stmt->execute();
        $exists = $stmt->fetch();
        
        if($exists) {
            echo "<span class='success'>✅ Tabela 'medico' existe!</span><br>";
        } else {
            echo "<span class='error'>❌ Tabela 'medico' NÃO existe!</span><br>";
            echo "<p>Execute o script SQL para criar as tabelas.</p>";
            exit;
        }
    } catch(Exception $e) {
        echo "<span class='error'>❌ Erro ao verificar tabela: " . $e->getMessage() . "</span><br>";
        exit;
    }
    
    // Teste 3: Contar registros
    echo "<h2>3. Contando Registros na Tabela 'medico'</h2>";
    try {
        $sql = "SELECT COUNT(*) as total FROM medico";
        $stmt = $conexao->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        echo "<span class='success'>✅ Total de médicos cadastrados: " . $result['total'] . "</span><br>";
        
        if($result['total'] == 0) {
            echo "<p style='color:orange;'>⚠️ Não há médicos cadastrados. Vamos inserir um de teste...</p>";
            
            $sqlInsert = "INSERT INTO medico (nome, crm, especialidade, telefone, email) 
                          VALUES ('Dr. Teste', '12345-SP', 'Clínico Geral', '(11) 99999-9999', 'teste@teste.com')";
            $conexao->exec($sqlInsert);
            echo "<span class='success'>✅ Médico de teste inserido!</span><br>";
        }
    } catch(Exception $e) {
        echo "<span class='error'>❌ Erro ao contar registros: " . $e->getMessage() . "</span><br>";
        echo "<pre>SQL: $sql</pre>";
        exit;
    }
    
    // Teste 4: Query direta com FETCH_ASSOC
    echo "<h2>4. Testando Query Direta (FETCH_ASSOC)</h2>";
    try {
        $sql = "SELECT * FROM medico ORDER BY nome LIMIT 5";
        $stmt = $conexao->prepare($sql);
        
        if (!$stmt) {
            echo "<span class='error'>❌ Erro ao preparar statement</span><br>";
            print_r($conexao->errorInfo());
            exit;
        }
        
        echo "<span class='success'>✅ Statement preparado</span><br>";
        
        $result = $stmt->execute();
        if (!$result) {
            echo "<span class='error'>❌ Erro ao executar query</span><br>";
            print_r($stmt->errorInfo());
            exit;
        }
        
        echo "<span class='success'>✅ Query executada</span><br>";
        
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "<span class='success'>📊 Registros encontrados: " . count($rows) . "</span><br>";
        
        if (count($rows) > 0) {
            echo "<pre>";
            print_r($rows);
            echo "</pre>";
        }
    } catch(Exception $e) {
        echo "<span class='error'>❌ Erro: " . $e->getMessage() . "</span><br>";
        echo "<pre>" . $e->getTraceAsString() . "</pre>";
    }
    
    // Teste 5: Usando fetchAll com FETCH_CLASS
    echo "<h2>5. Testando fetchAll com FETCH_CLASS</h2>";
    try {
        $stmt2 = $conexao->prepare("SELECT * FROM medico ORDER BY nome LIMIT 5");
        $stmt2->execute();
        
        echo "<span class='success'>✅ Query executada</span><br>";
        
        $objetos = $stmt2->fetchAll(PDO::FETCH_CLASS, "App\\Model\\Medico");
        echo "<span class='success'>✅ fetchAll com FETCH_CLASS funcionou!</span><br>";
        echo "<span class='success'>📊 Objetos retornados: " . count($objetos) . "</span><br>";
        
        if (count($objetos) > 0) {
            echo "<h3>Primeiro objeto:</h3>";
            echo "<pre>";
            print_r($objetos[0]);
            echo "</pre>";
        }
    } catch (Exception $e) {
        echo "<span class='error'>❌ Erro no fetchAll: " . $e->getMessage() . "</span><br>";
        echo "<pre>" . $e->getTraceAsString() . "</pre>";
    }
    
    // Teste 6: Usando o DAO diretamente
    echo "<h2>6. Testando MedicoDAO->select()</h2>";
    try {
        $medicoDAO = new App\DAO\MedicoDAO();
        $medicos = $medicoDAO->select();
        
        echo "<span class='success'>✅ MedicoDAO->select() funcionou!</span><br>";
        echo "<span class='success'>📊 Médicos retornados: " . count($medicos) . "</span><br>";
        
        if (count($medicos) > 0) {
            echo "<h3>Lista de Médicos:</h3>";
            echo "<table border='1' cellpadding='10' style='border-collapse:collapse;'>";
            echo "<tr><th>ID</th><th>Nome</th><th>CRM</th><th>Especialidade</th><th>Telefone</th><th>Email</th></tr>";
            foreach($medicos as $medico) {
                echo "<tr>";
                echo "<td>" . ($medico->Id ?? 'N/A') . "</td>";
                echo "<td>" . ($medico->Nome ?? 'N/A') . "</td>";
                echo "<td>" . ($medico->CRM ?? 'N/A') . "</td>";
                echo "<td>" . ($medico->Especialidade ?? 'N/A') . "</td>";
                echo "<td>" . ($medico->Telefone ?? 'N/A') . "</td>";
                echo "<td>" . ($medico->Email ?? 'N/A') . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    } catch (Exception $e) {
        echo "<span class='error'>❌ Erro no MedicoDAO->select(): " . $e->getMessage() . "</span><br>";
        echo "<h4>Stack trace:</h4><pre>" . $e->getTraceAsString() . "</pre>";
    }
    
    // Teste 7: Estrutura da tabela
    echo "<h2>7. Estrutura da Tabela 'medico'</h2>";
    try {
        $stmt3 = $conexao->prepare("DESCRIBE medico");
        $stmt3->execute();
        $estrutura = $stmt3->fetchAll(PDO::FETCH_ASSOC);
        echo "<pre>";
        print_r($estrutura);
        echo "</pre>";
    } catch(Exception $e) {
        echo "<span class='error'>❌ Erro: " . $e->getMessage() . "</span><br>";
    }
    
    echo "<h2 style='color:green;'>✅ Todos os testes concluídos!</h2>";
    echo "<p><strong>Próximo passo:</strong> Acesse <a href='/medico'>a lista de médicos</a> para testar a página real.</p>";
    
} catch (Exception $e) {
    echo "<h2 style='color:red;'>❌ ERRO GERAL</h2>";
    echo "<p style='color:red;'>" . $e->getMessage() . "</p>";
    echo "<h3>Stack trace:</h3><pre>" . $e->getTraceAsString() . "</pre>";
}
?>