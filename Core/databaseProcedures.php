<?php

namespace Core;

class databaseProcedures
{
    function __construct()
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $mysqli = new mysqli("localhost", "root", "1234", "myapp");
    }
}