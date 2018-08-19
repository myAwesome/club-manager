<?php

namespace AppBundle\Service;


use Doctrine\Common\Annotations\Reader;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

class GSDriver
{
    /** @var Reader */
    private $reader;

    public function __construct(Reader $reader )
    {
        $this->reader = $reader;
    }

    /**
     * @param FilterControllerEvent $event
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        dump(__LINE__); die;
//        if (!is_array($controller = $event->getController())) {
//            return;
//        }
//
//        if ($controller[0] instanceof CountViewInterface) {
//            $method = new \ReflectionMethod($controller[0], $controller[1]);
//            foreach ($this->reader->getMethodAnnotations($method) as $annotations) {
//                if ($annotations instanceof CountView) {
//                    $redisKey = sprintf('count_view:%s', $event->getRequest()->getPathInfo());
//                    $this->redis->incr($redisKey);
//                }
//            }
//        }
    }
}