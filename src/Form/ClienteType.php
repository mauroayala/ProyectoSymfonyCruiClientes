<?php

namespace App\Form;

use App\Entity\Cliente;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ClienteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        //primer parte nombre de la columna
        //segundo tipo de dato
        
        // fecha tipo DateType::class,
        // texto tipo TextType::class,
        //email tipo EmailType::class,
        // no es obligatorio 'required' => false,
        //si es obbligatorio 'required' => true,
        // 'attr' validaciones de html5
        //valido del lado del servidor constraints
        //valido un email valido Assert\Email

        
            ->add('nombre', TextType::class, 
            [ 'required' => true,
              'attr' => ['maxlength' => 255,'minlength' => 2],
                'constraints' => [
                    new Assert\NotBlank(message: 'El nombre es obligatorio.'),
                    new Assert\Length(min: 2, max: 255, minMessage: 'El nombre debe tener al menos {{ limit }} caracteres.', maxMessage: 'El nombre no puede superar {{ limit }} caracteres.'),
                    new Assert\Regex(pattern: "/^[\p{L}][\p{L}\s'-]*$/u", message: 'El nombre solo puede contener letras, espacios, apóstrofes y guiones.'),
                ],
            ])


            
            ->add('apellido', TextType::class, [
                'required' => true,
                'attr' => ['maxlength' => 255,'minlength' => 2],
                'constraints' => [
                    new Assert\NotBlank(message: 'El apellido es obligatorio.'),
                    new Assert\Length(min: 2, max: 255, minMessage: 'El apellido debe tener al menos {{ limit }} caracteres.', maxMessage: 'El apellido no puede superar {{ limit }} caracteres.'),
                    new Assert\Regex(pattern: "/^[\p{L}][\p{L}\s'-]*$/u", message: 'El apellido solo puede contener letras, espacios, apóstrofes y guiones.'),
                ],
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'attr' => ['maxlength' => 255],
                'constraints' => [
                    new Assert\NotBlank(message: 'El correo electrónico es obligatorio.'),
                    new Assert\Email(message: 'Ingrese un correo electrónico válido.'),
                    new Assert\Length(max: 255, maxMessage: 'El correo electrónico no puede superar {{ limit }} caracteres.'),
                ],
            ])
            //menor o igual que
             
            // DateType::class, calanderio input type=date

            ->add('fechaNacimiento', DateType::class, [
                'required' => true,
                'widget' => 'single_text',
                'constraints' => [
                    new Assert\NotNull(message: 'La fecha de nacimiento es obligatoria.'),
                    new Assert\LessThanOrEqual('today', message:'La fecha de nacimiento no puede ser futura.'),
                ],
            ])
            ->add('domicilio', TextType::class, [
                'required' => true,
                'attr' => ['maxlength' => 255],
                'constraints' => [
                    new Assert\NotBlank(message: 'El domicilio es obligatorio.'),
                    new Assert\Length(min: 3, max: 255, minMessage: 'El domicilio debe tener al menos {{ limit }} caracteres.', maxMessage: 'El domicilio no puede superar {{ limit }} caracteres.'),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cliente::class,
        ]);
    }
}
