<?php

namespace App\EventListener;

use App\Entity\Formation;
use App\Repository\FormationRepository;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use CalendarBundle\Entity\Event;
use CalendarBundle\Event\CalendarEvent;

class CalendarListener
{
    private $formationRepository;
    private $router;

    public function __construct(
        FormationRepository $formationRepository,
        UrlGeneratorInterface $router
    ) {
        $this->formationRepository = $formationRepository;
        $this->router = $router;
    }

    public function load(CalendarEvent $calendar): void
    {
        $start = $calendar->getStart();
        $end = $calendar->getEnd();
        $filters = $calendar->getFilters();

        // Modify the query to fit to your entity and needs
        // Change formation.beginAt by your start date property
        // $formations = $this->formationRepository
        //     ->createQueryBuilder('formation')
        //     ->where('formation.dateDebut BETWEEN :start and :end')
        //     // ->and('formation.dateDebut BETWEEN :start and :end')
        //     ->setParameter('start', $start->format('Y-m-d H:i:s'))
        //     ->setParameter('end', $end->format('Y-m-d H:i:s'))
        //     ->getQuery()
        //     ->getResult()
        // ;

        $formations = $this->formationRepository
        ->createQueryBuilder('formation')
        ->where('formation.dateDebut BETWEEN :start and :end')
        ->orWhere('formation.dateFin BETWEEN :start and :end')
        ->orWhere(':end BETWEEN formation.dateDebut and formation.dateFin')
        ->setParameter('start', $start->format('Y-m-d H:i:s'))
        ->setParameter('end', $end->format('Y-m-d H:i:s'))
        ->getQuery()
        ->getResult();

        foreach ($formations as $formation) {
            // this create the events with your data (here formation data) to fill calendar
            $formationEvent = new Event(
                $formation->getNom(),
                $formation->getDateDebut(),
                $formation->getDateFin() // If the end date is null or not defined, a all day event is created.
            );

            /*
             * Add custom options to events
             *
             * For more information see: https://fullcalendar.io/docs/event-object
             * and: https://github.com/fullcalendar/fullcalendar/blob/master/src/core/options.ts
             */

            $formationEvent->setOptions([
                'backgroundColor' => 'orange',
                'borderColor' => 'orange',
                'font-color' => 'black'
            ]);
            $formationEvent->addOption(
                'url',
                $this->router->generate('showInfoSession', [
                    'id' => $formation->getId(),
                ])
            );

            // finally, add the event to the CalendarEvent to fill the calendar
            $calendar->addEvent($formationEvent);
        }
    }
}