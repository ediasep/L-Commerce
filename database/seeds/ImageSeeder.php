<?php

use Illuminate\Database\Seeder;
use App\Image;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// IPhone
        Image::create([
        	'url' => 'https://s3.amazonaws.com/coursestorm/live/media/6136d95f8b9e11e8ad90128eb53bca3c',
        	'product_id' => 1
        ]);


        Image::create([
        	'url' => 'https://i.kinja-img.com/gawker-media/image/upload/s--jCjUgKLr--/c_fill,fl_progressive,g_center,h_900,q_80,w_1600/wvntfdaqvmza9drnqoyg.jpg',
        	'product_id' => 1
        ]);

        // MacBook
        Image::create([
        	'url' => 'https://cdn.thewirecutter.com/wp-content/uploads/2018/06/which-macbook-should-i-buy-lowres-2197-1.jpg',
        	'product_id' => 2
        ]);

        Image::create([
        	'url' => 'https://cdn.pocket-lint.com/r/s/970x/assets/images/139487-laptops-review-macbook-pro-with-touch-bar-review-image2-jnbywktbtq.jpg',
        	'product_id' => 2
        ]);


        // ASUS ROG
        Image::create([
        	'url' => 'https://s.republika.co.id/uploads/images/inpicture_slide/asus-rog-ilustrasi-_180202053250-944.jpg',
        	'product_id' => 3
        ]);

        Image::create([
        	'url' => 'https://souqcms.s3.amazonaws.com/spring/images/2016/Asus/ROG-GL552VW-CN624T-Gaming-Laptop-Core-i7-6700HQ-15.6-Inch-Gray-Metal/5-asus-rog-gl552vw-cn624t-gaming-laptop-core-i7-15.6-inch-gray-metal.jpg',
        	'product_id' => 3
        ]);

        // G9 Pro Android and IOS Smartwatch
        Image::create([
        	'url' => 'https://www.lg.com/us/images/smart-watches/md05800429/gallery/medium01.jpg',
        	'product_id' => 4
        ]);

        Image::create([
        	'url' => 'https://www.lg.com/us/images/smart-watches/md05800429/gallery/small05.jpg',
        	'product_id' => 4
        ]);

        // INSIGNIA Smart TV
        Image::create([
        	'url' => 'https://assets.pcmag.com/media/images/392525-insignia-ns-55dr420na16.jpg?width=792&height=504',
        	'product_id' => 5
        ]);

        // Bluetooth Wireless Headphone
        Image::create([
        	'url' => 'https://cdn.shopify.com/s/files/1/0857/5574/files/Trekz_large.jpg?6568248188156668121',
        	'product_id' => 6
        ]);

        Image::create([
        	'url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTnV6Ds5tgoBap43aGFE7KyN3J-0gRCJIBE7oBVu0qiqD4iCwxi',
        	'product_id' => 6
        ]);
    }
}
