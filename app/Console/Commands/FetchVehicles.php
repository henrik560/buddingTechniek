<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Statamic\Facades\Entry;
use Symfony\Component\DomCrawler\Crawler;

class FetchVehicles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:vehicles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch all vehicles from the live server';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $content = file_get_contents('https://buddingtechniek.nl/occasions');

        $crawler = new Crawler($content);
        $vehiclesList = $crawler->filter('body .grid .product_item_frame');

        $vehicles = $vehiclesList->each(function (Crawler $vehicleCrawler) {
            $vehicleUrl = collect($vehicleCrawler->filter('.product_info .product_contact_info_wrapper a')->attr('href'))->first();

            return $this->fetchVehicleImage($vehicleUrl);
        });

        $a = collect($vehicles)->each(function ($v) {
            Entry::make()
                ->collection('vehicles')
                ->data([
                    'title' => $v['title'],
                    'price_notk' => $v['price'] == '',
                    'price' => $v['price'] == '' ? 0 : $v['price'],
                    'thumbnail' => 'vehicles/'.$v['title'].'/'.basename($v['images'][0]),
                    'images' => collect($v['images'])->each(function ($img) {
                        return 'vehicles/'.$v['title'].'/'.basename($img);
                    }),
                ])
                ->save();
        });

        Log::emergency('vehicles', [$vehicles]);

        return Command::SUCCESS;
    }

    private function fetchVehicleImage($vehicleUrl)
    {
        $vehicle_detail_page = file_get_contents('https://buddingtechniek.nl/'.$vehicleUrl);

        $content = new Crawler($vehicle_detail_page);

        $vehicleName = str_replace(' ', '_', trim(collect($content->filter('.product_details_header_title'))->first()->nodeValue));
        $price = preg_replace('/[^0-9]/', '', trim(collect($content->filter('.product_details_header_price_text'))->first()->nodeValue));

        $imageParents = $content->filter('.body .product_sliderfooter_images_container .product_sliderfooter .product_slider_item');
        $images = $imageParents->each(function (Crawler $image) use ($vehicleName) {
            $base64Src = collect($image->filter('img'))->last()->getAttribute('src');

            return $this->convertBase64ToPng($base64Src, $vehicleName);
        });

        $specifications = ['test' => 'test'];

        return [
            'name' => $vehicleName,
            'images' => $images,
            'specs' => $specifications,
            'price' => $price,
        ];
    }

    private function convertBase64ToPng(string $data, string $vehicleName)
    {
        $fileBin = file_get_contents($data);
        $mimeType = str_replace('image/', '', mime_content_type($data));

        $filename = uniqid().'.'.$mimeType;

        // Create a new file and write the decoded data to it
        file_put_contents($filename, $fileBin);

        // Specify the destination directory path
        $destinationDirectory = app_path('Console/Commands/Vehicles/'.$vehicleName);

        // Create the destination directory if it doesn't exist
        if (! is_dir($destinationDirectory)) {
            mkdir($destinationDirectory, 0777, true);
        }

        // Move the file to the destination directory
        $newFilePath = $destinationDirectory.'/'.$filename;
        rename($filename, $newFilePath);

        return $newFilePath;
    }
}
