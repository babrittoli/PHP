<?php
// Hash gerado com password_hash() - peguei da documentção do PHP, achie mais fácil ...
$usuarios = [
    'admin' => password_hash('1234', PASSWORD_DEFAULT),
    'user'  => password_hash('senha123', PASSWORD_DEFAULT)
];
?>