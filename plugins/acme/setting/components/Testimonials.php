<?php namespace Acme\Setting\Components;

use Cms\Classes\ComponentBase;
use Acme\Setting\Models\Testimonial;
use Response;

class Testimonials extends ComponentBase {

    public $testimonials;

    public function componentDetails() {
      return [
        'name'          => 'Блок отзывов',
        'description'   => 'Добавить блок с отзывами'
      ];
    }

    public function onRun() {
      $testimonials = new Testimonial;
      $this->testimonials = $testimonials::with(['avatar'])->orderBy('sort_order', 'asc')->where('status', 1)->get();
    }

}