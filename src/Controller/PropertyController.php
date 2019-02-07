<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    /**
     * @var PropertyRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(PropertyRepository $repository, ObjectManager $em)
    {

        $this->repository = $repository;
        $this->em = $em;
    }
    /**
     * @Route("/properties", name="property_index")
     */
    public function index()
    {
        /*$property = new Property();
        $property->setTitle('Mon premier bien')
            ->setPrice('200000')
            ->setRooms(4)
            ->setBedrooms(3)
            ->setDescription('Une petite description')
            ->setSurface(60)
            ->setFloor(4)
            ->setHeat(1)
            ->setCity('Montpellier')
            ->setAddress('Avenue Gambetta')
            ->setPostalCode('34000');

        $em = $this->getDoctrine()->getManager();
        $em->persist($property);
        $em->flush();*/

        //$repository = $this->getDoctrine()->getRepository(Property::class);

        //dump($repository);
        $properties = $this->repository->findAllVisible();
        //dump($property);
        $this->em->flush();

        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties',
            'properties' => $properties
        ]);
    }

    /**
     * @Route("/properties/{slug}-{id}", name="property_show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show(Property $property, $slug): Response
    {
        //$property = $this->repository->find($id);
        if ($property->getSlug() !== $slug) {
            return $this->redirectToRoute('property_show', [
               'id' => $property->getId(),
               'slug' => $property->getSlug()
            ], 301);
        }
        return $this->render('property/show.html.twig', [
            'property' => $property,
            'current_menu' => 'properties'
        ]);
    }
}
