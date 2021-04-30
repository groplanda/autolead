<?php
use Acme\Setting\Models\Service;
use Acme\Setting\Models\Contact;
use Acme\Setting\Models\Testimonial;
use Acme\Setting\Models\Faq;

Route::get('api/post/{name}', 'Acme\Setting\Classes\Posts@getPost');

Route::get('api/gallery/{slug}', 'Acme\Setting\Classes\Galleries@getGallery');

Route::get('api/services', function () {
  $services = Service::with(['file'])->orderBy('sort_order', 'asc')->get();
  return $services;
});

Route::get('api/contacts', function () {
  $contacts = Contact::with(['town'])->get();
  return $contacts;
});

Route::post('api/send-message', 'Acme\Setting\Classes\MessageController@send');

Route::get('api/testimonials', function () {
  $testimonials = Testimonial::with(['avatar'])->orderBy('sort_order', 'asc')->where('status', 1)->get();
  return $testimonials;
});

Route::post('api/add-testimonial', 'Acme\Setting\Classes\TestimonialController@send');

Route::get('api/faq', function () {
  return Faq::orderBy('sort_order', 'asc')->get();
});