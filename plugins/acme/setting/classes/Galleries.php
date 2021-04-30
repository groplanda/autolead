<?php namespace Acme\Setting\Classes;

use Acme\Setting\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class Galleries extends Controller {

  public $pageObject;
  public $title;
  public $content;

  public function getGallery($slug) {

    $gallery = Gallery::where('slug', $slug)->with(['images'])->first();
    return $gallery;

  }

}