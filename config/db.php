<?php
//Aqui va la conexión a la base de datos
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=localhost;dbname=censo', //datos de la conexion
    'username' => 'postgres', //usuario de base de datos
    'password' => 'postgres', //contraseña de acceso a base de datos
    'charset' => 'utf8',
];
