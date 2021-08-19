<?php namespace Acme\Setting\Components;

use Cms\Classes\ComponentBase;
use Acme\Setting\Models\Gallery;
use Response;

class GalleryComponent extends ComponentBase {

  public $gallery;

  public function componentDetails() {
      return [
          'name'          => 'Галерея',
          'description'   => 'Отображение галереи фотографий'
      ];
  }

  public function defineProperties() {
      return [
          'galleryName' => [
              'title'             => 'Выберите галерею',
              'type'              => 'dropdown',
              'default'           => ''
          ],
          'galleryType' => [
              'title'             => 'Внешний вид',
              'type'              => 'dropdown',
              'default'           => 'home',
              'placeholder' => 'Выберите тип',
              'options'     => ['home'=>'Главная', 'grid'=>'Плитка']

          ]
      ];
  }

  public function onRender() {
    $view = $this->property('galleryType');
    if($view == 'grid') {
        return $this->renderPartial('@_grid.htm');
    }
  }

  public function getGalleryNameOptions() {
    return Gallery::all()->lists('title', 'id');
  }

  public function onRun() {
    $gallery = new Gallery;
    $this->gallery = $gallery->where( 'id', '=', $this->property('galleryName') )->first();
  }

}