<?php
// public/gerar_hash.php

// A senha que queremos usar
$senha = 'cliente123';

// Gera a hash usando o algoritmo padrão e mais seguro do PHP
$hash_gerada = password_hash($senha, PASSWORD_DEFAULT);

// Exibe a hash na tela para que possamos copiá-la
echo "<h1>Hash Gerada com Sucesso</h1>";
echo "<p>Use a hash abaixo para atualizar o banco de dados para o usuário 'cliente'.</p>";
echo "<hr>";
echo "<p><strong>Senha:</strong> " . htmlspecialchars($senha) . "</p>";
echo "<p><strong>Hash Gerada:</strong></p>";
echo '<input type="text" value="' . htmlspecialchars($hash_gerada) . '" size="70" readonly style="padding: 5px; font-family: monospace;">';
echo "<hr>";
?>
