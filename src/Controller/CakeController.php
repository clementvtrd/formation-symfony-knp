<?php

namespace App\Controller;

use App\Forms\Types\CakeType;
use Exception;
use PDOException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CakeController extends AbstractController
{
    private $pdo;

    public function list() 
    {
       $cakes = $this->getPdo()
            ->query('SELECT * FROM cake ORDER BY created_at DESC')
            ->fetchALl()
        ;
        
        return $this->render('Cake/list.html.twig', [
            'cakes' => $cakes,
        ]);
    }

    public function show($id)
    {

        $sql = 'SELECT * FROM cake WHERE id = :id';

        $sth = $this->getPdo()->prepare($sql);
        $sth->execute([':id' => $id]);
        $cake = $sth->fetch();

        if ($cake === false) {
            throw new NotFoundHttpException('Cake not found for the given id');
        }

        return $this->render('Cake/detail.html.twig', [
            'cake' => $cake
        ]);
    }

    public function create(Request $request) 
    {
        $form = $this->createForm(CakeType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $data = $form->getData();

            $sql = "INSERT INTO cake (name, description, price, created_at, image) VALUES (?,?,?,?,?)";

            try {
                $stmt= $this->getPdo()->prepare($sql);
                $stmt->execute([$data["name"], $data["description"], $data["price"], $data["image"], time()]);
            } catch(PDOException $e) {
                throw new Exception('PDO failed ' . $e);
            }

            $session = $request->getSession();

            $session->getFlashBag()->add('success', 'Bravo !');

            return $this->redirectToRoute('app_cake_list');
        }

        return $this->render('Cake/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    private function getPdo() 
    {
        if (null === $this->pdo) {
            $this->pdo = new \PDO($this->getParameter('database'));
        }

        return $this->pdo;
    } 
}