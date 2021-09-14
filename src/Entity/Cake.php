<?php

namespace App\Entity;

use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class Cake
{
    protected TextType $name;
    protected TextType $description;
    protected MoneyType $price;
    protected TextType $image;
}