<?php


namespace App\Controller;

use App\Entity\AreaContacto;
use App\Form\AreaContactoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AreaContactoController extends AbstractController
{
    #[Route('/nueva-area-contacto', name: 'nueva_area_contacto')]
    public function nuevaAreaContacto(Request $request, EntityManagerInterface $entityManager): Response
    {
        $areaContacto = new AreaContacto();

        $form = $this->createForm(AreaContactoType::class, $areaContacto);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($areaContacto);
            $entityManager->flush();

            return $this->redirectToRoute('area_contacto_exito');
        }

        return $this->render('area_contacto/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/area-contacto-exito', name: 'area_contacto_exito')]
    public function areaContactoExito(): Response
    {
        return new Response('Área de contacto creada con éxito.');
    }
}
