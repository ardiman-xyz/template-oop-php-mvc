<?php

namespace Ardiman\BelajarPhpMvc\Controller;


class ProductController
{
    public function categories(string $product, string $categoriId): void
    {
        echo "product : $product, cetegory id : $categoriId " . PHP_EOL;
    }
}
