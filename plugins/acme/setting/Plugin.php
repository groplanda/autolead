<?php namespace Acme\Setting;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
  public function registerComponents() {
    return [
      'Acme\Setting\Components\Services' => 'services',
      'Acme\Setting\Components\Form' => 'form',
      'Acme\Setting\Components\Testimonials' => 'testimonials',
      'Acme\Setting\Components\GalleryComponent' => 'gallery',
      'Acme\Setting\Components\FaqComponent' => 'faq'
    ];
  }

  public function registerSettings() {}
}
