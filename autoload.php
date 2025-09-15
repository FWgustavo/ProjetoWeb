<?php

spl_autoload_register(function ($cadastro_usuario) {
    $arquivo = BASE_DIR . '/' . $cadastro_usuario . '.php';
    if (file_exists($arquivo)) {
        include $arquivo;
    } else
    {
        throw new Exception("Arquivo '$arquivo' não encontrado.");
    }
});