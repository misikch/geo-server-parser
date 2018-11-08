<?php

namespace App\Components;

use App\Config\Config;

class DbInit
{
    public function init()
    {
        $command = 'mysql -u ' . Config::DB_USERNAME . ' -p' . Config::DB_PASSWORD . ' <' . Config::ALTER_SQL_FILE;

        shell_exec($command);
    }
}