<?php

namespace App\Controller;

use App\Repository\WishRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/wish', 'wish_')]
class WishController extends AbstractController
{
    #[Route('', 'list')]
    public function list(WishRepository $wishRepository): Response
    {
        $wishes = $wishRepository -> findBy([], ['dateCreated' => 'DESC']);
        return $this->render('main/wish/list.html.twig', [
            'wishes' => $wishes
        ]);
    }

    #[Route('/detail/{id}', 'detail')]
    public function detail(int $id, WishRepository $wishRepository): Response
    {
        $wish = $wishRepository -> find($id);
        
        return $this->render('main/wish/detail.html.twig', [
            'wish' => $wish
        ]);
    }
}
