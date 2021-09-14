<?php

namespace App\Forms\Types;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class CakeType extends AbstractType
{
 public function buildForm(FormBuilderInterface $builder, array $options)
 {
     // parent::buildForm($builder, $options); // TODO: Change the autogenerated stub
     $builder
         ->add("name", TextType::class, [
             "constraints" => [
                 new Assert\NotBlank(),
                 new Assert\Length([
                     "min" => 3,
                     "max" => 32
                 ])
             ]
         ])
         ->add("description", TextType::class, [
             "constraints" => [
                 new Assert\Length([
                     "max" => 255
                 ])
             ]
         ])
         ->add("price", MoneyType::class, [
             "constraints" => [
                 new Assert\Currency()
             ]
         ])
         ->add("image", FileType::class, [
             "required" => false,
             "constraints" => [
                 new Assert\AtLeastOneOf([
                     new Assert\Image(),
                     new Assert\Url()
                 ])
             ]
         ])
         ->add("submit", SubmitType::class);
 }
}