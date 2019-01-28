<?php

namespace Cocorico\CoreBundle\Event;

use Cocorico\CoreBundle\Form\Type\HolidayType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Validator\Constraints\Isbn;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class BookingListingNewFormSubscriber implements EventSubscriberInterface
{
    /**
     * @param ListingFormBuilderEvent $event
     */
    public function onListingNewFormBuild(ListingFormBuilderEvent $event): void
    {
        $builder = $event->getFormBuilder();

        $builder
            ->add(
                'isbn',
                'isbn10', [
                    'constraints' => new Isbn(),
                ]
            );

        $builder->add('holidays', CollectionType::class, [
            'allow_add' => true,
            'allow_delete' => true,
            'entry_type' => HolidayType::class
        ]);
    }


    public static function getSubscribedEvents(): array
    {
        return [
            ListingFormEvents::LISTING_NEW_FORM_BUILD => ['onListingNewFormBuild', 0],
        ];
    }
}
