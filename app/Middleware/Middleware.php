<?php

namespace Ardiman\BelajarPhpMvc\Middleware;

interface Middleware
{
    public function before(): void;
}
