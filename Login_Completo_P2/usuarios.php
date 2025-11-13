<?php
// Hash gerado com password_hash() - Peguei da documentação do PHP, achei mais simples
$usuarios = [
    'Marcos' => password_hash('1234', PASSWORD_DEFAULT),
    'Barbara'  => password_hash('1234', PASSWORD_DEFAULT)
];
?>