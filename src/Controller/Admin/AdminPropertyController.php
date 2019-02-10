<?php
/**
 * Created by PhpStorm.
 * User: leazygomalas
 * Date: 07/02/2019
 * Time: 21:36
 */

namespace App\Controller\Admin;

use App\Entity\Option;
use App\Form\PropertyType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPropertyController extends AbstractController
{
    /**
     * @var PropertyRepository
     */
    private $repository;

    public function __construct(PropertyRepository $repository)
    {

        $this->repository = $repository;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/admin", name="admin.property.index")
     */
    public function index()
    {
        $properties = $this->repository->findAll();
        return $this->render('admin/property/index.html.twig', compact('properties'));
    }

    /**
     * @Route("/admin/property/create" , name="admin.property.new")
     */
    public function new(Request $request, ObjectManager $manager)
    {
        $property = new Property();
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($property);
            $manager->flush();
            $this->addFlash('success', 'Bien ajouté avec succès');
            return $this->redirectToRoute('admin.property.index');
        }
        return $this->render('admin/property/new.html.twig', [
            'property' => $property,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/property/{id}", name="admin.property.edit", methods="GET|POST")
     */
    public function edit(Property $property, Request $request, ObjectManager $manager)
    {
        //$option = new Option();
        //$property->addOption($option);

        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            //dd($option);
            //$manager->persist($property);
            $manager->flush();
            $this->addFlash('success', 'Bien modifié avec succès');
            return $this->redirectToRoute('admin.property.index');
        }
        return $this->render('admin/property/edit.html.twig', [
            'property' => $property,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/property/{id}", name="admin.property.delete", methods="DELETE")
     */
    public function delete(Property $property, Request $request, ObjectManager $manager)
    {
        $submittedToken = $request->request->get('_token');
        if ($this->isCsrfTokenValid('delete'. $property->getId(), $submittedToken)) {
            $manager->remove($property);
            $manager->flush();
            $this->addFlash('success', 'Bien supprimé avec succès');
        }

        return $this->redirectToRoute('admin.property.index');
    }
}