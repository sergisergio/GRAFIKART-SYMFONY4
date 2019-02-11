<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Property;
use App\Entity\PropertySearch;
use App\Form\ContactType;
use App\Form\PropertySearchType;
use App\Notification\ContactNotification;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(PaginatorInterface $paginator, Request $request)
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
        //$properties = $this->repository->findAllVisible();
        //dump($property);
        //$this->em->flush();


        // Créer un entité qui va représenter notre recherche
        // Créer un formulaire
        // Gérer le traitement dans le controller

        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);



        $properties = $paginator->paginate(
            $this->repository->findAllVisibleQuery($search),
            $request->query->getInt('page', 1),
            12
        );

        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties',
            'properties'   => $properties,
            'form'         => $form->createView()
        ]);
    }

    /**
     * @Route("/properties/{slug}-{id}", name="property_show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show(Property $property, $slug, Request $request, ContactNotification $notification): Response
    {
        if ($property->getSlug() !== $slug) {
            return $this->redirectToRoute('property_show', [
               'id' => $property->getId(),
               'slug' => $property->getSlug()
            ], 301);
        }

        $contact = new Contact();
        $contact->setproperty($property);
        $form = $this->createForm(ContactType::class,$contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $notification->notify($contact);
            $this->addFlash('success', 'Votre email a bien été envoyé');
            /*return $this->redirectToRoute('property_show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ]);*/
        }

        return $this->render('property/show.html.twig', [
            'property' => $property,
            'current_menu' => 'properties',
            'form' => $form->createView()
        ]);
    }
}
