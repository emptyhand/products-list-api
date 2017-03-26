<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Entity\ProductsList;
use Doctrine\DBAL\Schema\View;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\RouteResource;

/**
 * @RouteResource("Product")
 * Class ProductsController
 * @package AppBundle\Controller
 */
class ProductsController extends FOSRestController
{
    /**
     * @param int $id
     * @return ProductsList
     */
    private function getList(int $id): ProductsList
    {
        return $this->getDoctrine()
            ->getRepository('AppBundle:ProductsList')
            ->find($id);
    }

    /**
     * @param int $listId
     * @param int $id
     * @return Product
     */
    public function getAction(int $listId, int $id): Product
    {
        return $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->findOneBy([
                'id' => $id,
                'list' => $this->getList($listId)
            ]);
    }

    /**
     * @param int $listId
     * @return array
     */
    public function cgetAction(int $listId): array
    {
        return $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->findBy(['list' => $this->getList($listId)]);
    }

    /**
     * @param int $listId
     * @param Request $request
     * @return Product
     */
    public function postAction(int $listId, Request $request): Product
    {
        $model = new Product();
        $model->setName($request->get('name'));
        $model->setQuantity($request->get('quantity'));
        $model->setAdded($request->get('added'));
        $model->setList($this->getList($listId));

        $em = $this->getDoctrine()->getManager();
        $em->persist($model);
        $em->flush();

        return $model;
    }

    /**
     * @param int $listId
     * @param int $id
     * @param Request $request
     * @return Product
     */
    public function putAction(int $listId, int $id, Request $request): Product
    {
        $model = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->find($id);

        $model->setName($request->get('name'));
        $model->setQuantity($request->get('quantity'));
        $model->setAdded($request->get('added'));
        $model->setList($this->getList($listId));

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $model;
    }

    /**
     * @param int $listId
     * @param int $id
     * @return View
     */
    public function deleteAction(int $listId, int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->findOneBy([
                'list' => $this->getList($listId),
                'id' => $id
            ]);

        if (empty($product)) {
            return new View("user not found", Response::HTTP_NOT_FOUND);
        } else {
            $em->remove($product);
            $em->flush();
        }
        return new View("deleted successfully", Response::HTTP_OK);
    }
}
