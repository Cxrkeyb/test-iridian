<?php

namespace App\Controller;

use App\Entity\Cobertura;
use Doctrine\DBAL\Statement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class CoberturaController extends AbstractController
{
    #[Route('/insertar-poligono', name: 'insertar_poligono', methods: ['POST', 'GET'])]
    public function insertarPoligono(EntityManagerInterface $entityManager): JsonResponse
    {
        $polygon = 'POLYGON(( -74.0537967 4.706828, -74.0550198 4.699422, -74.0545782 4.6994764, -74.0539006 4.6994346, -74.0512591 4.698956, -74.0493163 4.6985925, -74.0476916 4.6981478, -74.0451969 4.6973285, -74.0439343 4.6967373, -74.0432036 4.6964491, -74.0414644 4.6961395, -74.0376749 4.695146, -74.0357523 4.6947512, -74.0238774 4.6912262, -74.0203193 4.7014128, -74.0287699 4.7020616, -74.0304902 4.7025676, -74.0337435 4.7036584, -74.0352014 4.7041208, -74.0355221 4.7042571, -74.036772 4.7045031, -74.0376623 4.7043042, -74.0384081 4.704193, -74.0404698 4.7039734, -74.0426872 4.7040676, -74.0433238 4.7041682, -74.0436332 4.7042153, -74.0440992 4.7042831, -74.0444395 4.7043263, -74.0445299 4.7043386, -74.0445572 4.7043335, -74.0456496 4.7045521, -74.0471767 4.7049842, -74.0487079 4.705415, -74.0512439 4.7061272, -74.0525079 4.7064746, -74.0531278 4.7066429, -74.0537967 4.706828))';

        $cobertura = new Cobertura();
        $cobertura->setArea($polygon);

        $entityManager->persist($cobertura);
        $entityManager->flush();

        return $this->json(['message' => 'Polígono insertado correctamente']);
    }

    #[Route('/verificar-punto/{lat}/{long}', name: 'verificar_punto', methods: ['GET'])]
    public function verificarPunto($lat, $long, EntityManagerInterface $entityManager): JsonResponse
    {
        $connection = $entityManager->getConnection();
    
        $sql = "SELECT ST_Contains(ST_GeomFromText(area), ST_GeomFromText(:point)) AS is_inside
        FROM cobertura
        WHERE id = 1";
    
        $stmt = $connection->executeQuery($sql, [
            'point' => 'POINT(' . $long . ' ' . $lat . ')'
        ]);
    
        $result = $stmt->fetchAssociative();
    
        if ($result === false) {
            return $this->json(['error' => 'No se encontró el resultado']);
        }
    
        $isInside = $result['is_inside'];
    
        return $this->json(['is_inside' => (bool)$isInside]);
    }
}
