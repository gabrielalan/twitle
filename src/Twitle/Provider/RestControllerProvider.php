<?php
namespace Twitle\Provider;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;

class RestControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $restV1 = $app['controllers_factory'];

		$restV1->get('/entries', 'Twitle\Controller\Entries::getAll');
		$restV1->post('/entries', 'Twitle\Controller\Entries::save');
		$restV1->delete('/entries/{id}', 'Twitle\Controller\Entries::delete');

        return $restV1;
    }
}