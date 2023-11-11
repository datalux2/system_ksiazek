<?php

namespace App\Form;

use App\Entity\Ksiazki;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class KsiazkiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Imię:'
            ])
            ->add('surname', TextType::class, [
                'label' => 'Nazwisko:'
            ])
            ->add('title', TextType::class, [
                'label' => 'Tytuł:'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Opis:',
                'attr' => ['cols' => '22', 'rows' => '5']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ksiazki::class,
        ]);
    }
}
