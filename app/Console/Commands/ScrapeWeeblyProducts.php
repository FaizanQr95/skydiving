<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\Product;

class ScrapeWeeblyProducts extends Command
{
    protected $signature = 'scrape:weebly';
    protected $description = 'Scrapes products from Weebly and saves to DB';

    public function handle()
    {
        $url = 'http://sgras.com/product/skydiving-gear-rental/3?cs=true&cst=custom';

        $client = new Client();
        $html = $client->get($url)->getBody()->getContents();

        $crawler = new Crawler($html);

        try {
            $title = $crawler->filter('h1')->first()->text();
            $description = $crawler->filter('.wsite-product-description')->first()->text();
            $priceText = $crawler->filter('.wsite-product-price')->first()->text();
            $image = $crawler->filter('.wsite-product-image img')->first()->attr('src');

            $price = floatval(preg_replace('/[^0-9.]/', '', $priceText));

            // Save to DB
            Product::create([
                'title' => $title,
                'description' => $description,
                'price' => $price,
                'image_url' => $image,
            ]);

            $this->info("✅ Product saved: $title");

        } catch (\Exception $e) {
            $this->error('❌ Error scraping: ' . $e->getMessage());
        }

        return Command::SUCCESS;
    }
}
