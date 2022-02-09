<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/
Artisan::command('importCategoriesFromFile', function(){

    $file = fopen('categories.csv', 'r');

    $i = 0;
    $insert = [];
    while ($row = fgetcsv($file, 1000, ';')) {
        
        if ($i++ == 0) {
            $bom = pack('H*','EFBBBF');
            $row = preg_replace("/^$bom/", '', $row);
            $columns = $row;
            continue;
        }

        $data = array_combine($columns, $row);
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $insert[] = $data;
    }

    Category::insert($insert);
});

Artisan::command('parseEcatalog', function(){
    $url = 'https://www.e-katalog.ru/list/122/pr-1358/';

    $data = file_get_contents($url);

    $dom = new DOMDocument();
    @$dom->loadHTML($data);
    
    $xpath = new DomXPath($dom);
    $totalProductsString = $xpath->query("//span[@class='t-g-q]")[0]->nodeValue ?? false;

    $output = preg_match_all('/\d+/', $totalProductsString, $matches);

    $totalProducts = (int) $matches[0][0];

    $divs = $xpath->query("//div[@class='model-short-div list-item--goods   ']");

    $productsOnOnePage = $divs->length;
    $pages = ceil($totalProducts / $productsOnOnePage);

    $products = [];

    foreach ($divs as $div) {
        $a = $xpath->query("descendant::a[@class='model-short-title no-u']", $div);
        $name = $a[0]->nodeValue;
        
        $price = 0;
        $ranges = $xpath->query("descendant::div[@class='model-price-range']", $div);

        if ($ranges->length == 1) {
            foreach ($ranges[0]->childNodes as $child) {
                if ($child->nodeName == 'a') {
                $price = 'от' . $child->nodeValue;
                }
            }
        }
        $ranges = $xpath->query("descendant::div[@class='pr31 ib']", $div);
        if ($ranges->length == 1) {
            $price = $ranges[0]->nodeValue;
        }
        $products[] = [
            'name' => $name,
            'price' => $price,
        ];
    }

    for ($i=1; $i < $pages; $i++) {
        $nextUrl = "$url&page_=$i";
        $data = file_get_contents($nextUrl);
        $dom = new DOMDocument();
        @$dom->loadHTML($data);
    
        $xpath = new DomXPath($dom);
        $divs = $xpath->query("//div[@class='model-short-div list-item--goods   ']");
        foreach ($divs as $div) {
            $a = $xpath->query("descendant::a[@class='model-short-title no-u']", $div);
            $name = $a[0]->nodeValue;
            
            $price = 0;
            $ranges = $xpath->query("descendant::div[@class='model-price-range']", $div);
    
            if ($ranges->length == 1) {
                foreach ($ranges[0]->childNodes as $child) {
                    if ($child->nodeName == 'a') {
                    $price = 'от' . $child->nodeValue;
                    }
                }
            }
            $ranges = $xpath->query("descendant::div[@class='pr31 ib']", $div);
            if ($ranges->length == 1) {
                $price = $ranges[0]->nodeValue;
            }
            $products[] = [
                'name' => $name,
                'price' => $price,
            ];
        }
    }
    $file = fopen('videocards.csv', 'w');
    foreach ($products as $product) {
        fputcsv($file, $product, ';');
        fclose($file);
    }
});

Artisan::command('massCategoriesInsert', function() {
    
    $categories = [
        [
            'name' => 'Видеокарты',
            'description' => 'какие-то видеокарты',
            'created_at' => date('Y-m-d H:i:s')
        ],
        [
            'name' => 'Процессоры',
            'description' => 'какие-то процессоры',
            'created_at' => date('Y-m-d H:i:s')
        ]
    ];

    Category:: insert($categories);
});

Artisan::command('updateCategory', function() {
    
    Category::where('id', 2)->update([
        'name' => 'Процессоры'
    ]);
});

Artisan::command('deleteCategories', function() {
    
    //$category = Categories::find(1);
    //$category->delete();
    Category::whereNotNull('id')->delete();    
});

Artisan::command('createCategory', function() {
    $category = new Category([
        'name'=>'Видеокарты',
        'description'=> 'Ждем rtx 3050'
    ]);
    $category->save();
});

Artisan::command('massProductsInsert', function() {
    
    $products = [
        [
            'name' => 'RX300',
            'description' => 'классная видеокарта',
            'category' => 'Видеокарты',
            'picture' => 'no_picture',
            'created_at' => date('Y-m-d H:i:s')
        ],
        [
            'name' => 'RX600',
            'description' => 'вообще отличная видеокарта',
            'category' => 'Видеокарты',
            'picture' => 'no_picture',
            'created_at' => date('Y-m-d H:i:s')
        ]
    ];

    Product:: insert($products);
});

Artisan::command('updateProduct', function() {
    
    Product::where('id', 2)->update([
        'name' => 'Процессоры'
    ]);
});

Artisan::command('deleteProduct', function() {
    
    //$category = Categories::find(1);
    //$category->delete();
    Product::whereNotNull('id')->delete();    
});

Artisan::command('createProduct', function() {
    $product = new Product([
        'name'=>'RX800',
        'description'=> 'Самая лучшая видеокарта',
        'category'=>'ghghghgh',
        'picture'=>'no_picture'
    ]);
    $product->save();
});

Artisan::command('inspire', function () {
    $user = User::find(2);
    $addresses = $user->addresses->filter(function ($address) {
        return $address->main;
    })->pluck ('address');

    $addresses = $user->addresses()->where('main',1)->get();
    

    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
