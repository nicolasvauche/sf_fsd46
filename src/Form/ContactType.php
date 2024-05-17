<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('senderName', TextType::class, [
                'label' => 'Votre nom',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Ex: Santa Barbara',
                    'class' => 'form-control',
                ],
            ])
            ->add('senderEmail', EmailType::class, [
                'label' => 'Votre email',
                'attr' => [
                    'placeholder' => 'Ex: jr.ewings@santabarbara.com',
                    'class' => 'form-control',
                ],
            ])
            ->add('subject', TextType::class, [
                'label' => 'Sujet de votre message',
                'attr' => [
                    'placeholder' => 'Ex: Je voudrais vous demander quelque chose',
                    'class' => 'form-control',
                ],
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Votre message',
                'attr' => [
                    'placeholder' => 'Bonjour,',
                    'class' => 'form-control',
                    'rows' => 7,
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
