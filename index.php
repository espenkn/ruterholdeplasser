<?php

$boards = [
    'ruter.kleinelectronics.no' => 'https://tavla.en-tur.no/dashboard/@59-926348,10-776113/eyJkaXN0YW5jZSI6IjU1OCIsImhpZGRlblN0YXRpb25zIjpbXSwiaGlkZGVuU3RvcHMiOlsiTlNSOlN0b3BQbGFjZTo2NDUxIiwiTlNSOlN0b3BQbGFjZTo1ODE2MiIsIk5TUjpTdG9wUGxhY2U6NTgyNTUiLCJOU1I6U3RvcFBsYWNlOjY0NTMiXSwiaGlkZGVuUm91dGVzIjpbXSwiaGlkZGVuTW9kZXMiOltdLCJuZXdTdGF0aW9ucyI6W10sIm5ld1N0b3BzIjpbXX0=',
    'leoruter.kleinelectronics.no' => 'https://tavla.en-tur.no/dashboard/@59-94538338903199,10-791405986479825/eyJkaXN0YW5jZSI6IjUyNiIsImhpZGRlblN0YXRpb25zIjpbXSwiaGlkZGVuU3RvcHMiOlsiTlNSOlN0b3BQbGFjZTo2MTQxIiwiTlNSOlN0b3BQbGFjZTo1OTY0MyIsIk5TUjpTdG9wUGxhY2U6NTgzMDYiLCJOU1I6U3RvcFBsYWNlOjU4MzA1IiwiTlNSOlN0b3BQbGFjZTo2MDI4Il0sImhpZGRlblJvdXRlcyI6W10sImhpZGRlbk1vZGVzIjpbXSwibmV3U3RhdGlvbnMiOltdLCJuZXdTdG9wcyI6WyJOU1I6U3RvcFBsYWNlOjU5NjQzIiwiTlNSOlN0b3BQbGFjZTo1ODMwOSIsIk5TUjpTdG9wUGxhY2U6NTk4NzgiLCJOU1I6U3RvcFBsYWNlOjU5NjQ4Il19',
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

