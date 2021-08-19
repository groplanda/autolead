<?php namespace Acme\Setting\Components;

use Cms\Classes\ComponentBase;
use Acme\Setting\Models\Service;
use Response;

class Services extends ComponentBase {

    public $services;

    public function componentDetails() {
      return [
        'name'          => 'Блок услуги',
        'description'   => 'Добавить блок с услугами'
      ];
    }

    public function onRun() {
      $services = new Service;
      $this->services = $services::with(['file'])->orderBy('sort_order', 'asc')->get();
    }

}