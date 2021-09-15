<?php

namespace spec\App\Controller;

use App\Controller\CakeController;
use App\Domain\Currency\Convertor;
use App\Entity\Cake;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Twig\Environment;

class CakeControllerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CakeController::class);
    }

    function let(Convertor $convertor, ContainerInterface $container)
    {
        $this->beConstructedWith($convertor, $container);
    }

    function it_displays_a_cake
    (
        ManagerRegistry $registry,
        EntityRepository $repository,
        Cake $cake,
        ResponseInterface $interface,
        ContainerInterface $container,
        Environment $twig
    )
    {
        $container->get('doctrine')->willReturn($registry);
        $container->get('twig')->willReturn($twig);

        $registry->getRepository(Argument::any())->willReturn($repository);
        $repository->find(1)->willReturn($cake);
        
        $twig->render(Argument::any(), Argument::any())->willReturn("My response");
        $this->show(1)->shouldReturn("My response");
    }



    function it_throws_error_when_cake_is_not_found
    (
        ManagerRegistry $registry,
        EntityRepository $repository,
        ContainerInterface $container,
        Environment $twig
    )
    {
        $container->get('doctrine')->willReturn($registry);
        $container->get('twig')->willReturn($twig);

        $registry->getRepository(Argument::any())->willReturn($repository);
        $repository->find(8)->willReturn(null);
        
        $this->shouldThrow(NotFoundHttpException::class)->during("show", ["id" => 8]);
    }
}
