<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\Dump\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class EmailContactTest
 * @package AppBundle\Tests\Controller
 */
class EmailContactTest extends WebTestCase
{
    /**
     * @var Container
     */
    private $container;
    //bin/phpunit -c app/  src/AppBundle/Tests/Controller/EmailContactTest

    /**
     * @dataProvider PostProvider
     */
    public function testEmail($id, $emailExpected)
    {
        $client = static::createClient();
        $client->request('GET', '/email/validation/' . $id . '/contact');
        if ($emailExpected === '@gmail.com') {
            $this->assertEquals('@gmail.com', $emailExpected);
        } else {
            $this->assertNotEquals('@gmail.com', $emailExpected);
        }
    }

    /**
     * @return array
     */
    public function PostProvider()
    {
        self::bootKernel();
        $this->container = self::$kernel->getContainer();
        $em = $this->container->get('doctrine')->getManager();
        $contact = $em->getRepository('AppBundle:Contact')->findOneBy(array(), null, ['DESC', 1]);
        $id = $contact->getId();
        $email = $contact->getEmail();
        $emailExpected = strstr($email, '@');

        return [
            [$id, $emailExpected], // Successful case 1
            [$id, '@hotmail.com'], // wrong case 2 email !== @gmail.com
            [$id, null], // wrong case 3 email = null
            [$id, 123584], // wrong case 4 email !== @gmail.com
        ];
    }
}
