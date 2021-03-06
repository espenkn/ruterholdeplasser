<?php

$boards = [
    'ruter.kleinelectronics.no' => 'https://tavla.en-tur.no/dashboard/@59-926348,10-776113/eyJkaXN0YW5jZSI6IjU1OCIsImhpZGRlblN0YXRpb25zIjpbXSwiaGlkZGVuU3RvcHMiOlsiTlNSOlN0b3BQbGFjZTo2NDUxIiwiTlNSOlN0b3BQbGFjZTo1ODE2MiIsIk5TUjpTdG9wUGxhY2U6NTgyNTUiLCJOU1I6U3RvcFBsYWNlOjY0NTMiXSwiaGlkZGVuUm91dGVzIjpbXSwiaGlkZGVuTW9kZXMiOltdLCJuZXdTdGF0aW9ucyI6W10sIm5ld1N0b3BzIjpbXX0=',
    'leoruter.kleinelectronics.no' => 'https://tavla.en-tur.no/dashboard/@59-960075,10-784728/',
];

if (!array_key_exists($_SERVER['SERVER_NAME'], $boards))
{

    if (version_compare(PHP_VERSION, '7.3.0') >= 0) 
    {
        $_SERVER['SERVER_NAME'] = array_key_first($boards);
    }
    else 
    {
        $_SERVER['SERVER_NAME'] = array_keys($boards)[0];
    }
}

header('Location: ' . $boards[$_SERVER['SERVER_NAME']]);

