<?php

namespace App\Controller;

// use App\Entity\User;
use App\Entity\ActivityRegistrations;
use App\Repository\ActivitiesRepository;
use App\Repository\ActivityRegistrationsRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserDashboardController extends AbstractController
{
    #[Route('/user/dashboard', name: 'app_user_dashboard')]
    public function index(ActivitiesRepository $activitiesRepository, ActivityRegistrationsRepository $registrationRepository): Response
    {
        $activities = $activitiesRepository->findAll();

        $user = $this->getUser();

        // find all sub activities by fk : user id
        $registrations = $registrationRepository->findBy(['user' => $user]);

        return $this->render('user_dashboard/index.html.twig', [
            'activities' => $activities,
            'registrations' => $registrations,
        ]);
    }

    #[Route('/user/subscribe/{id}', name: 'app_user_subscribe_activity', methods: ['POST'])]
    public function subscribe(int $id, ActivitiesRepository $activitiesRepository, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
    
        if (!$user) {
            // Handle unauthenticated user
            return $this->redirectToRoute('app_login');
        }
    
        $activity = $activitiesRepository->find($id);
    
        if (!$activity) {
            throw $this->createNotFoundException('No activity found for id ' . $id);
        }
    
        // Now, creating a new ActivityRegistration entity
        $registration = new ActivityRegistrations();
        $registration->setUser($user); // Sets the user entity
        $registration->setActivity($activity); // Sets the activity entity
        $registration->setRegistrationDate(new \DateTime());
    
        $entityManager->persist($registration);
        $entityManager->flush();
    
        return $this->redirectToRoute('app_user_dashboard');
    }

}
