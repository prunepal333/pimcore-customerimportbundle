<?php

namespace App\Controller;

use Pimcore\Controller\FrontendController;
use Pimcore\Model\Asset;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Pimcore\Model\DataObject;
use Pimcore\Model\Element;

class ProductController extends FrontendController
{
    /**
     * @Template
     *
     * @param Request $request
     *
     * @return array
     */
    public function listAction(Request $request)
    {
        $products = new DataObject\Product\Listing;
        
        return [
            "products" => $products
        ];
    }
    /**
     * @Template
     *
     * @param Request $request
     *
     * @return array
     */
    public function detailAction(Request $request)
    {
        $id = $request->get('id');
        $product = DataObject\Product::getById($id);
        
        return [
            "product" => $product
        ];
    }
}
// You call library's code whereas framework calls your code.
//  With library, you have choices to make.
//  With framework, you have orders to follow with some liberty ( if provided by the framework)
