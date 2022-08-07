<?php

class Route
{

    protected $actualPath;
    protected $actualMethod;

    protected $route = [];

    protected $notFound;

    function __construct($currentPath, $currentMethod)
    {
        $this->actualMethod = $currentMethod;
        $this->actualPath = $currentPath;

        $this->notFound = function() {
            http_response_code(404);
            echo '404 Not Found';
        };
    }
}
