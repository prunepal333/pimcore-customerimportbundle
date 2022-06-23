<?php

namespace App\Controller;

use Pimcore\Controller\FrontendController;
use Pimcore\Model\Asset;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Pimcore\Model\DataObject;
use Pimcore\Model\Element;
use Symfony\Component\Routing\Annotation\Route;

class BrandController extends FrontendController
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
        $brands = new DataObject\Brand\Listing;

        return [
            "brands" => $brands
        ];
    }
    /**
     * @Template
     *
     * @param Request $request
     *
     * @return array
     */
    public function createBrandAction($name, $logo)
    {
        $brand = new DataObject\Brand;

        $brand->setKey(\Pimcore\Model\Element\Service::getValidKey('Hershey', 'object'));

        //➔ Assign the class
        $brand->setParentId(42);

        $brand->setName($name);

        $hersheyLogo = $this->brandLogoFromFile($logo, $name);

        // $hersheyLogo = \Pimcore\Model\Asset::getById();
        $brand->setLogo($hersheyLogo);

        $this->redirectToRoute("/brands");
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
        $brand = DataObject\Brand::getById($id);
        return [
            'brand' => $brand
        ];
    }

    private function brandLogoFromFile($file, $assetName): ?Asset
    {
        $asset = new \Pimcore\Model\Asset();

        $asset->setFileName($assetName);
        $asset->setData(file_get_contents($file));

        $asset->setParent(\Pimcore\Model\Asset::getByPath("/brands"));

        if ($asset->save())
            return $asset->getId();
        return null;
    }
}


// You call library's code whereas framework calls your code.
//  With library, you have choices to make.
//  With framework, you have orders to follow with some liberty ( if provided by the framework)
