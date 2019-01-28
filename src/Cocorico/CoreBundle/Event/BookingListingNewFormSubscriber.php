<?php

namespace Cocorico\CoreBundle\Event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Validator\Constraints\Isbn;

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
    }


    public static function getSubscribedEvents(): array
    {
        return [
            ListingFormEvents::LISTING_NEW_FORM_BUILD => ['onListingNewFormBuild', 0],
        ];
    }
}
