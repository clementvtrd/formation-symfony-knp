<?php

namespace App\Controller;

use App\Entity\Cake;
use App\Forms\Types\CakeType;
use Exception;
use PDOException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CakeController extends AbstractController
{
    public function list(): Response
    {
       $cakes = $this->getDoctrine()
           ->getRepository(Cake::class)
           ->findAll();
        
        return $this->render('cake/list.html.twig', [
            'cakes' => $cakes,
        ]);
    }

    public function show(int $id): Response
    {
        $cake = $this->getDoctrine()
            ->getRepository(Cake::class)
            ->find($id);

        if ($cake === false) {
            throw new NotFoundHttpException('cake not found for the given id');
        }

        return $this->render('cake/detail.html.twig', [
            'cake' => $cake
        ]);
    }

    /**
     * @throws Exception
     */
    public function create(Request $request): Response
    {
        $form = $this->createForm(CakeType::class, new Cake());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em = $this->getDoctrine()->getManager();
                $cake = $form->getData();
                $em->persist($cake);
                $em->flush();
            } catch(PDOException $e) {
                throw new Exception('PDO failed ' . $e);
            }

            $session = $request->getSession();

            $session->getFlashBag()->add('success', 'Bravo !');

            return $this->redirectToRoute('app_cake_list');
        }

        return $this->render('cake/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function search(Request $request): Response
    {
        $cakes = $this->getDoctrine()
            ->getRepository(Cake::class)
            ->findBy([
                "name" => $request->request->get("search")
            ]);

        return $this->render('cake/list.html.twig', [
            'cakes' => $cakes,
        ]);
    }
}