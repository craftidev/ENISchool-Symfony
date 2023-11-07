<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/create', 'create')]
    public function create(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response
    {
        $wish = new Wish();
        $wish -> setDateCreated(new \DateTime());
        $wishForm = $this -> createForm(WishType::class, $wish);
        $wishForm -> handleRequest($request);

        if ($wishForm->isSubmitted() && $wishForm->isValid()) {
            $entityManager -> persist($wish);
            $entityManager -> flush();

            $this -> addFlash('success', 'Wish was successfully created');
            return $this -> redirectToRoute('wish_detail', ['id' => $wish -> getId()]);
        }

        return $this->render('main/wish/create.html.twig', [
            'wishForm' => $wishForm -> createView()
        ]);
    }
}
