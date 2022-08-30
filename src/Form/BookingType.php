<?php

namespace App\Form;

use App\Entity\Booking;
use App\Entity\Room;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('beginAt', DateType::class, [
                'label' => 'Date de début',
                'widget' => 'single_text'
            ])
            ->add('endAt', DateType::class, [
                'label' => 'Date de fin',
                'widget' => 'single_text'
            ])
            ->add('room', EntityType::class,[
                'label' => 'Qu\'elle chambre ?',
                'class' => Room::class,
                'choice_label' => function($room){
                    return $room->getName() . ' (' . $room->getPrice() . '/ par nuit) €';
                }
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
