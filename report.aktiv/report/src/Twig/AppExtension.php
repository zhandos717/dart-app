<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use \Tamtamchik\SimpleFlash\Flash;

class AppExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('area', [$this, 'calculateArea']),
            new TwigFunction('flash', [Flash::class, 'message']),
        ];
    }


    public function calculateArea()
    {
        return flash();
    }
}
