<?php
use Acme\Setting\Models\Service;
use Acme\Setting\Models\Contact;
use Acme\Setting\Models\Testimonial;
use Acme\Setting\Models\Faq;

Route::prefix('/api')->group(function () {
  Route::get('/post/{name}', 'Acme\Setting\Classes\Posts@getPost');
  Route::get('/gallery/{slug}', 'Acme\Setting\Classes\Galleries@getGallery');
  Route::get('/services', function () {
    $services = Service::with(['file'])->orderBy('sort_order', 'asc')->get();
    return $services;
  });
  Route::get('/contacts', function () {
    $contacts = Contact::with(['town'])->get();
    return $contacts;
  });
  Route::get('/contacts/{id}', function ($id) {
    return Contact::whereHas('town', function ($query) use ($id) {
      return $query->where('id', '=', $id);
    })->with(['town'])->first();
  });
  Route::post('/send-message', 'Acme\Setting\Classes\MessageController@send');
  Route::get('/testimonials', function () {
    $testimonials = Testimonial::with(['avatar'])->orderBy('sort_order', 'asc')->where('status', 1)->get();
    return $testimonials;
  });
  Route::post('/add-testimonial', 'Acme\Setting\Classes\TestimonialController@send');
  Route::get('/faq', function () {
    return Faq::orderBy('sort_order', 'asc')->get();
  });
});
