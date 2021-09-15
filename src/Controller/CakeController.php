<?php

namespace App\Controller;

use App\Domain\Currency\Convertor;
use App\Domain\Validators\CakeValidator;
use App\Entity\Cake;
use App\Forms\Types\CakeType;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CakeController extends AbstractController
{
    protected Convertor $convertor;

    public function __construct(Convertor $convertor)
    {
        $this->convertor = $convertor;
    }

    public function list(): Response
    {
       $cakes = $this->getDoctrine()
           ->getRepository(Cake::class)
           ->findAll();
        
        return $this->render('cake/list.html.twig',
        [
            'cakes' => $cakes,
            'convertor' => $this->convertor
        ]);
    }

    public function show(int $id)
    {
        $cake = $this->getDoctrine()
            ->getRepository(Cake::class)
            ->find($id);

        /**
         * no number and no special char
         */
        if (!$cake instanceof Cake) {
            throw new NotFoundHttpException('cake not found for the given id');
        }

        return $this->render('cake/detail.html.twig',
        [
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
            $em = $this->getDoctrine()->getManager();
            $cake = $form->getData();
            $validator = new CakeValidator();
            /**
             * @var Session $session
             */
            $session = $request->getSession();
            if ($validator->checkName($cake->getName())) {
                $em->persist($cake);
                $em->flush();
                $session->getFlashBag()->add('success', 'Bravo !');
                return $this->redirectToRoute('app_cake_list');
            } else {
                $session->getFlashBag()->add('error', 'Quelque chose ne va pas.');
            }
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