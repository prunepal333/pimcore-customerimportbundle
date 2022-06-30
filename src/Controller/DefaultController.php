<?php

namespace App\Controller;

use App\Service\CSVParser2;
use App\Service\SeederInterface;
use Pimcore\Controller\FrontendController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
class DefaultController extends FrontendController
{
    /**
     *@Template 
     *
     * @param Request $request
     *
     * @return array
     */
    public function defaultAction(Request $request)
    {
        return [];
    }
}
