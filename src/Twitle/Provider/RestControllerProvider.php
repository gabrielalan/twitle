<?php
namespace Twitle\Provider;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;

class RestControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $restV1 = $app['controllers_factory'];

		$restV1->get('/', 'Twitle\Controller\Entries::getAll');
		$restV1->post('/', 'Twitle\Controller\Entries::save');

        return $restV1;
    }
}