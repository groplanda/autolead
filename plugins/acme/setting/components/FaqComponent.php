<?php namespace Acme\Setting\Components;

use Cms\Classes\ComponentBase;
use Acme\Setting\Models\Faq;
use Response;

class FaqComponent extends ComponentBase {

    public $faq;

    public function componentDetails() {
      return [
        'name'          => 'Ответ-вопрос',
        'description'   => 'Добавить блок ответ-вопрос'
      ];
    }

    public function onRun() {
      $faq = new Faq;
      $this->faq = $faq::orderBy('sort_order', 'asc')->get();
    }

}