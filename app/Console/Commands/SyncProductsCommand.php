<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Http;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Support\Facades\Log;

class SyncProductsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync products from fakestoreapi.com';

    private function output($massege)
    {
        $this->info($massege);
        Log::info($massege);
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->output('Start Sync');

        $response = Http::get('https://fakestoreapi.com/products');
        foreach ($response->json() as $item) {
            $this->output('Sync for Category: ' . strval($item["category"]));
            $category = Category::firstOrCreate(['name' => $item['category']]);

            $this->output('Sync product data for: ' .
                'title: ' . $item['title'] . '; ' .
                'description: ' . $item['description'] . '; ' .
                'price: ' . $item['price'] . '; ' .
                'image: ' . $item['image'] . '; ' .
                'category_id: ' . $category->id . '; ' .
                'rating: ' . json_encode($item["rating"]));

            Product::updateOrCreate([
                'title' => $item['title'],
                'description' => $item['description'],
                'price' => $item['price'],
                'image' => $item['image'],
                'category_id' => $category->id,
                'rating' => json_encode($item["rating"])
            ]);
        }

        $this->output('Products synced successfully!');

        return Command::SUCCESS;
    }
}
