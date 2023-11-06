<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('', 'main_')]
class MainController extends AbstractController
{
    #[Route('/', 'home')]
    public function home()
    {
        return $this -> render('main/home.html.twig');
    }

    #[Route('/about_us', 'about_us')]
    public function about_us(): Response
    {
        $jsonPath = $this -> getParameter('kernel.project_dir') . '/src/Data/team.json';
        $jsonData = file_get_contents($jsonPath);
        $data = json_decode($jsonData, true);

        return $this->render('main/about_us.html.twig', [
            'contributors' => $data
        ]);
    }
}
