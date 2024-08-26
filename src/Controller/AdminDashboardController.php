<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminDashboardController extends AbstractController
{

    #[Route('/admin/dashboard', name: 'app_admin_dashboard')]
    public function index(Request $request, UserRepository $repository): Response
    {
        $users = $repository->findAll();
        
        return $this->render('admin_dashboard/index.html.twig', [
            'users' => $users,
        ]);
    }

    // #[Route('/admin/activate/{id}', name: 'app_admin_activate_user', methods: ['POST'])]
    // public function activate(int $id, User $user, UserRepository $repository): Response
    // {
    //     $form = $this->createForm(AdminDashboardActivationType::class)
    //     // get User
    //     // $user = $repository->find($id);
    //     // // dd($user);

    //     // if (!$user) {
    //     //     throw $this->createNotFoundException('No user found for id ' . $id);
    //     // }

    //     // $user->setName('true');
    //     // dd($user);

    //     // return $this->redirectToRoute('app_admin_dashboard');
    //     return $this->render('app_admin_dashboard', [
    //         'form' => $form
    //     ]);
    // }

    #[Route('/admin/activate/{id}', name: 'app_admin_activate_user', methods: ['POST'])]
    public function activate(int $id, UserRepository $repository, EntityManagerInterface $entityManager): Response
    {
    $user = $repository->find($id);

    if (!$user) {
        throw $this->createNotFoundException('No user found for id ' . $id);
    }

    // Activate the user
    $user->setActive(true);
    $entityManager->flush();

    return $this->redirectToRoute('app_admin_dashboard');
}

}
