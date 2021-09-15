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
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CakeController extends AbstractController
{
    public function __construct(Convertor $convertor, ContainerInterface $container)
    {
        $this->convertor = $convertor;
        $this->container = $container;
    }

    public function list(): Response
    {
       $cakes = $this->container->get('doctrine')
           ->getRepository(Cake::class)
           ->findAll();
        
        return $this->container->get('twig')->render('cake/list.html.twig',
        [
            'cakes' => $cakes,
            'convertor' => $this->convertor
        ]);
    }

    public function show(int $id)
    {
        $cake = $this->get('doctrine')
            ->getRepository(Cake::class)
            ->find($id);

        /**
         * no number and no special char
         */
        if (!$cake instanceof Cake) {
            throw new NotFoundHttpException('cake not found for the given id');
        }

        return $this->container->get('twig')->render('cake/detail.html.twig',
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
            if ($validator->checkName($cake->getName())) {
                $em->persist($cake);
                $em->flush();
                $session = $request->getSession();
                $session->getFlashBag()->add('success', 'Bravo !');
                return $this->redirectToRoute('app_cake_list');
            } else {
                $session = $request->getSession();
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