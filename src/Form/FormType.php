<?php

namespace App\Form;

use App\Entity\Form;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;

class FormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('nomEtablissement', TextType::class)
            ->add('tel', TelType::class)
            ->add('email', EmailType::class)
            ->add('quantite', IntegerType::class)
            ->add("recaptcha", EWZRecaptchaType::class, array(
                "attr" => array(
                    "options" => array(
                        "theme" => "light",
                        "type" => "image",
                        "size" => "normal",
                        "defer" => true,
                        "async" => true,
                        )
                    ),
                    "mapped" => false,
                    "constraints" => array(
                        new RecaptchaTrue()
                    )
                ));
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Form::class,
        ]);
    }
}
