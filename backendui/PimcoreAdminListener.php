<?php
namespace App\EventListener;

use Pimcore\Event\BundleManager\PathsEvent;

class PimcoreAdminListener
{
    // public function addCSSFiles(PathsEvent $event)
    // {
    //     $event->setPaths(
    //         array_merge(
    //             $event->getPaths(),
    //             [
    //                 '/'
    //             ]
    //         )
    //     );
    // }

    public function addJSFiles(PathsEvent $event)
    {
        $event->setPaths(
            array_merge(
                $event->getPaths(),
                [
                    'helper.js'
                ]
            )
        );
    }
}