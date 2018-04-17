<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte;
use App\Post;

class scrapeDantri extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:dantri';

    protected $category = [
        'van-hoa.htm',
        'kinh-doanh.htm',
    ];

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

       public function handle(){
        foreach ($this->category as $category) {
            print("lay cua danh muc".$category ."\n");
            $l = env("DAN_TRI")."/".$category;
            print($l."\n");
            $crawler = Goutte::request('GET', $l);
            $linkPost = $crawler->filter('a.fon6')->each(function ($node) {
              // print_r($node->text()."\n") ;
                return $node->attr("href");
        });

        foreach ($linkPost as $link ) {
            // print($link."\n") ;
            $l = env("DAN_TRI")."/".$link;

            self::scrapePost($l);
        }
        }

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
     public static function scrapePost($url)
    {
        $crawler = Goutte::request('GET', $url);
        $title = $crawler->filter('h1.fon31.mgb15')->each(function ($node) {
          
            return $node->text();
        });
        if(isset($title[0])){
            $title = $title[0];
        }
        // print_r("title lấy được là : " .$title[0]) ;

        $slug = str_slug($title);

            // $slug = $slug;

        // print_r($slug);

         $subtitle = $crawler->filter("h2.fon33.mt1.sapo")->each(function($node){
            return $node->text();
         });
        
        //  if(isset($subtitle[0])){
        //     $subtitle = $subtitle[0];
        // }


         $subtitle = str_replace('Dân trí','', $subtitle[0]);

         // print_r($subtitle);

        $body = $crawler->filter("div#divNewsContent")->each(function($node){
            return $node->text();
         })[0];
          if(isset($body)){
            $body = $body;
        }

        print_r("body lấy được là : ".$body);

        // $image = $crawler->filter("div.VCSortableInPreviewMode img")->each(function($node){
        //     return $node->attr('src');
        // })[0];
        // print_r($image);

        

        $data = [
            'title' => $title,
            'slug'  => $slug,
            'body' => $body,
            'subtitle' => $subtitle,
            // 'image' => $image,
            'category_id' => 1
        ];

        Post::create($data);

        print("Lấy dữ liệu thành công!!!!"."\n");



    }

 
}
