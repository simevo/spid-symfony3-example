<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{

    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testReservedGuest()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/reserved');

        $this->assertEquals(401, $client->getResponse()->getStatusCode());
        $this->assertContains('Authentication Required', $crawler->filter('body')->text());
    }

    public function testFullAccess()
    {
        $client = new \Goutte\Client();
        // Do more configuration for the Goutte client
        $driver = new \Behat\Mink\Driver\GoutteDriver($client);
        $session = new \Behat\Mink\Session($driver);
        // start the session
        $session->start();

        $page = $session->getPage();
        $session->visit('http://localhost:8000/acs');
        $this->assertTrue($session->getStatusCode() == 401);
        $noauthacscheck = (strpos($page->getHtml(), "Unauthenticated") > 0);
        $this->assertTrue($noauthacscheck);

        $session->visit('http://localhost:8000/reserved');
        $noauthcheck = (strpos($page->getHtml(), "Authentication Required") > 0);
        $this->assertTrue($noauthcheck);

        $session->visit('http://localhost:8000/login/testenv2');
        $page->fillField('username', 'test');
        $page->fillField('password', 'test');
        $page->pressButton('Invia');
        $page->pressButton('Invia');
        $page->pressButton('Continua');
        $fiscalnumbercheck = (strpos($page->getHtml(), "fiscalNumber") > 0);
        $this->assertTrue($fiscalnumbercheck);

        $session->visit('http://localhost:8000/reserved');
        $page = $session->getPage();
        $stuffcheck = (strpos($page->getHtml(), "Really reserved stuff here") > 0);
        $this->assertTrue($stuffcheck);

        /* FIXME: waiting for https://github.com/italia/spid-symfony-bundle/pull/9 */
        $session->visit('http://localhost:8000/acs');
        $page = $session->getPage();
        /*
          $stuffcheck = (strpos($page->getHtml(), "Really reserved stuff here") > 0);
          $this->assertTrue($stuffcheck);

         */
    }

    public function testMetadata()
    {
        $client = new \Goutte\Client();
        // Do more configuration for the Goutte client
        $driver = new \Behat\Mink\Driver\GoutteDriver($client);
        $session = new \Behat\Mink\Session($driver);
        // start the session
        $session->start();
        $session->visit('http://localhost:8000/metadata');
        $page = $session->getPage();
        $samlcheck = (strpos($page->getContent(), "urn:oasis:names:tc:SAML:2.0:metadata") > 0);
        $this->assertTrue($samlcheck);
    }

}
