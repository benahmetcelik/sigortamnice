<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sliders = [
            [
                'title' => 'Profesyonel Yazılım Çözümleri',
                'description' => 'Modern teknolojiler ve uzman ekibimizle işinizi bir üst seviyeye taşıyoruz.',
                'image' => 'uploads/sliders/slider1.jpg',
                'button_text' => 'Hizmetlerimiz',
                'button_link' => '/services',
                'order' => 1,
                'status' => true,
            ],
            [
                'title' => 'Web Tasarım ve Geliştirme',
                'description' => 'Responsive tasarımlar ve modern web teknolojileriyle markanızı öne çıkarın.',
                'image' => 'uploads/sliders/slider2.jpg',
                'button_text' => 'Portfolyo',
                'button_link' => '/portfolio',
                'order' => 2,
                'status' => true,
            ],
            [
                'title' => 'Mobil Uygulama Geliştirme',
                'description' => 'iOS ve Android için native mobil uygulamalar geliştiriyoruz.',
                'image' => 'uploads/sliders/slider3.jpg',
                'button_text' => 'İletişim',
                'button_link' => '/contact',
                'order' => 3,
                'status' => true,
            ],
        ];

        foreach ($sliders as $slider) {
            Slider::create($slider);
        }
    }
}
