<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class DashController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(ProjectRepository $pr)
    {
        $projects = $pr->findBy([],["status"=>"ASC"],15);
        return $this->render('dash/index.html.twig', [
            'controller_name' => 'DashController',
            'projects'  =>  $projects
        ]);
    }
}
