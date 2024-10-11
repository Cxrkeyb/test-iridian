<?php

namespace App\Controller;

use App\Entity\MensajeContacto;
use App\Form\MensajeContactoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request, EntityManagerInterface $entityManager): Response
    {
        $mensajeContacto = new MensajeContacto();
        $form = $this->createForm(MensajeContactoType::class, $mensajeContacto);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Validar que el correo no haya enviado más de 1 mensaje en el día
            $todayStart = new \DateTimeImmutable('today');
            $todayEnd = new \DateTimeImmutable('tomorrow');
            
            $existingMessage = $entityManager->getRepository(MensajeContacto::class)
                ->createQueryBuilder('m')
                ->where('m.correo = :correo')
                ->andWhere('m.createdAt >= :start AND m.createdAt < :end')
                ->setParameter('correo', $mensajeContacto->getCorreo())
                ->setParameter('start', $todayStart)
                ->setParameter('end', $todayEnd)
                ->getQuery()
                ->getOneOrNullResult();
            if ($existingMessage) {
                $this->addFlash('error', 'Ya has enviado un mensaje hoy. Intenta de nuevo mañana.');
                return $this->redirectToRoute('app_contact');
            }

            $mensajeContacto->setCreatedAt(new \DateTimeImmutable());
            $entityManager->persist($mensajeContacto);
            $entityManager->flush();

            $this->addFlash('success', 'Mensaje enviado con éxito.');
            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
