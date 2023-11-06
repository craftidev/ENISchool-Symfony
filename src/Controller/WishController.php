<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/wish', 'wish_')]
class WishController extends AbstractController
{
    #[Route('/list', 'list')]
    public function list()
    {
        return $this->render('main/wish/list.html.twig');
    }

    #[Route('/detail', 'detail')]
    public function detail($id): Response
    {
        return $this->render('main/wish/detail.html.twig', [
            'id' => $id
        ]);
    }
}
