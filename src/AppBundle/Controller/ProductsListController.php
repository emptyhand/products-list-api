<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ProductsList;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations\RouteResource;

/**
 * Class ProductsListController
 * @RouteResource("List")
 * @package AppBundle\Controller
 */
class ProductsListController extends FOSRestController
{
    /**
     * @ApiDoc(
     *  resource=true,
     *  description="This is a description of your API method"
     * )
     * @return array
     */
    public function cgetAction(): array
    {
        return $this->getDoctrine()
            ->getRepository('AppBundle:ProductsList')
            ->findBy([], ['id'=>'DESC']);
    }

    /**
     * @ApiDoc(
     *  description="Get list"
     * )
     *
     * @param int $id
     * @return ProductsList
     */
    public function getAction(int $id): ProductsList
    {
        return $this->getDoctrine()
            ->getRepository('AppBundle:ProductsList')
            ->find($id);
    }

    /**
     * @ApiDoc(
     *  description="Create a new list",
     *  input="ProductList",
     *  output="Your\Namespace\Class"
     * )
     *
     * @param Request $request
     * @return ProductsList
     */
    public function postAction(Request $request): ProductsList
    {
        $model = new ProductsList();
        $model->setName($request->get('name'));
        $model->setCompleted($request->get('completed'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($model);
        $em->flush();

        return $model;
    }

    /**
     * @param int $id
     * @param Request $request
     * @return ProductsList
     */
    public function putAction(int $id, Request $request): ProductsList
    {
        $model = $this->getDoctrine()
            ->getRepository('AppBundle:ProductsList')
            ->find($id);

        $model->setName($request->get('name'));
        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $model;
    }

    /**
     * @param int $id
     * @return ProductsList
     */
    public function deleteAction(int $id): ProductsList
    {
        $model = $this->getDoctrine()
            ->getRepository('AppBundle:ProductsList')
            ->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($model);
        $em->flush();

        return $model;
    }
}
