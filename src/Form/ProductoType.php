<?php

namespace App\Form;

use App\Entity\Producto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ProductoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, [
                'required' => true,
                'attr' => ['maxlength' => 255],
                'constraints' => [
                    new Assert\NotBlank(message: 'El nombre es obligatorio.'),
                    new Assert\Length(min: 2, max: 255, minMessage: 'El nombre debe tener al menos {{ limit }} caracteres.', maxMessage: 'El nombre no puede superar {{ limit }} caracteres.'),
                ],
            ])
            ->add('precio', IntegerType::class, [
                'required' => true,
                'attr' => ['min' => 1, 'max' => 2147483647],
                'constraints' => [
                    new Assert\NotNull(message: 'El precio es obligatorio.'),
                    new Assert\Range(min: 1, max: 2147483647, notInRangeMessage: 'El precio debe estar entre {{ min }} y {{ max }}.'),
                ],
            ])
            ->add('descripcion', TextType::class, [
                'required' => true,
                'attr' => ['maxlength' => 255],
                'constraints' => [
                    new Assert\NotBlank(message: 'La descripción es obligatoria.'),
                    new Assert\Length(min: 3, max: 255, minMessage: 'La descripción debe tener al menos {{ limit }} caracteres.', maxMessage: 'La descripción no puede superar {{ limit }} caracteres.'),
                ],
            ])
            ->add('estado', null, [
                // False es un estado válido; NotNull distingue "inactivo" de "sin informar".
                'required' => false,
                'constraints' => [
                    new Assert\NotNull(message: 'Debe indicar el estado del producto.'),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Producto::class,
        ]);
    }
}
