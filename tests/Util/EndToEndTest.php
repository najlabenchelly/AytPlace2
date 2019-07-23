<?php


namespace App\Tests\Util;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EndToEndTest extends WebTestCase
{
    public function testEndToHome()
    {
        $client = self::createClient();

        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testHomeSlider()
    {
        $client = self::createClient();
        $crawler = $client->request('GET', '/');

        $nb = $crawler->filter('a:contains("En savoir plus")')->count();

        $this->assertGreaterThan(3, $nb);
    }

    public function testEndToAds()
    {
        $client = self::createClient();

        $client->request('GET', '/ads');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testEndToAd()
    {
        $client = self::createClient();

        $client->request('GET', '/ads/aut-dolorem');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testEndToUserProfile()
    {
        $client = self::createClient();

        $client->request('GET', '/user/agathe-bouvier');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testAccessToAdmin()
    {
        $client = self::createClient();

        $client->request('GET', '/admin');

        $this->assertTrue($client->getResponse()->isRedirect());
    }
}
