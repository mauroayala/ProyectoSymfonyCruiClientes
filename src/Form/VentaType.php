<?php

namespace App\Form;

use App\Entity\Venta;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class VentaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('precio', IntegerType::class, [
                'required' => true,
                'attr' => ['min' => 1, 'max' => 2147483647],
                'constraints' => [
                    new Assert\NotNull(message: 'El precio es obligatorio.'),
                    new Assert\Range(min: 1, max: 2147483647, notInRangeMessage: 'El precio debe estar entre {{ min }} y {{ max }}.'),
                ],
            ])
            ->add('producto', TextType::class, [
                'required' => true,
                'attr' => ['maxlength' => 300],
                'constraints' => [
                    new Assert\NotBlank(message: 'El producto es obligatorio.'),
                    new Assert\Length(min: 2, max: 300, minMessage: 'El producto debe tener al menos {{ limit }} caracteres.', maxMessage: 'El producto no puede superar {{ limit }} caracteres.'),
                ],
            ])
            ->add('fecha', DateType::class, [
                'required' => true,
                'widget' => 'single_text',
                'constraints' => [
                    new Assert\NotNull(message: 'La fecha es obligatoria.'),
                ],
            ])
            ->add('cantidad', IntegerType::class, [
                'required' => true,
                'attr' => ['min' => 1, 'max' => 999],
                'constraints' => [
                    new Assert\NotNull(message: 'La cantidad es obligatoria.'),
                    new Assert\Range(min: 1, max: 999, notInRangeMessage: 'La cantidad debe estar entre {{ min }} y {{ max }}.'),
                ],
            ])
            ->add('dni', IntegerType::class, [
                'required' => true,
                'attr' => ['min' => 10000000, 'max' => 99999999],
                'constraints' => [
                    new Assert\NotNull(message: 'El DNI es obligatorio.'),
                    new Assert\Range(min: 10000000, max: 99999999, notInRangeMessage: 'El DNI debe contener exactamente 8 números.'),
                ],
            ])
            ->add('medioDePago', TextType::class, [
                'required' => true,
                'attr' => ['maxlength' => 255],
                'constraints' => [
                    new Assert\NotBlank(message: 'El medio de pago es obligatorio.'),
                    new Assert\Length(min: 2, max: 255, minMessage: 'El medio de pago debe tener al menos {{ limit }} caracteres.', maxMessage: 'El medio de pago no puede superar {{ limit }} caracteres.'),
                ],
            ])
            ->add('direccion', TextType::class, [
                'required' => true,
                'attr' => ['maxlength' => 255],
                'constraints' => [
                    new Assert\NotBlank(message: 'La dirección es obligatoria.'),
                    new Assert\Length(min: 3, max: 255, minMessage: 'La dirección debe tener al menos {{ limit }} caracteres.', maxMessage: 'La dirección no puede superar {{ limit }} caracteres.'),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Venta::class,
        ]);
    }
}
