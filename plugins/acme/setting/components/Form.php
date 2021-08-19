<?php namespace Acme\Setting\Components;

use Cms\Classes\ComponentBase;
use Input;
use Mail;
use Validator;
use ValidationException;
use Flash;
use Backend\Models\User;
use Acme\Setting\Models\Testimonial;
use Acme\Setting\Models\Message;

class Form extends ComponentBase {

  public function componentDetails()
  {
    return [
        'name' => 'Контактная форма',
        'description' => 'Контактная форма'
    ];
  }

  public function defineProperties() {
    return [
        'formType' => [
            'title'             => 'Тип формы',
            'type'              => 'dropdown',
            'default'           => 'main',
            'placeholder' => 'Выберите тип',
            'options'     => [ 'main'=> 'Форма главная', 'modal'=>'Форма модал', 'testimonials'=>'Форма Отзывов']
        ]
    ];
  }

  public function onRender() {
    $view = $this->property('formType');
    if($view == 'modal') {
      return $this->renderPartial('@_modal.htm');
    }
    if($view == 'testimonials') {
      return $this->renderPartial('@_testimonials.htm');
    }
  }

  public function getUserMail() {
    return User::where('is_superuser', 1)->value('email');
  }

  public function onSend() {

    $rules = [
      'name'  => 'required|min:4|max:50',
      'phone' => 'required|min:11|max:50',
      'question' => 'max:100',
      'email'  => 'email',
      'content'  => 'min:20|max:500'
    ];

    $messages = [
      'required' => 'Поле обязательно к заполнению!',
      'min'      => 'Минимум :min символов!',
      'max'      => 'Максимум :max символов!',
      'email'    => 'Некорректный e-mail'
    ];

    $validator = Validator::make(Input::all(), $rules, $messages);

    if ($validator->fails()) {
      Flash::error('Произошла ошибка!');
      throw new ValidationException($validator);
    } else {

      $vars = [
        'name' => Input::get('name'),
        'phone' => Input::get('phone'),
        'question' => Input::get('question'),
        'email' => Input::get('email'),
        'content' => Input::get('content')
      ];

      Mail::send('acme.setting::mail.message', $vars, function($message) use($vars) {
        $subject = $vars['question'] ? $vars['question'] : 'Заявка с сайта';
        $message->to($this->getUserMail(), 'Admin Person');
        $message->subject($subject);
      });

      $mess = new Message();
      $mess->name = $vars['name'];
      $mess->phone = $vars['phone'];
      $mess->question = $vars['question'];
      $mess->email = $vars['email'];
      $mess->content = $vars['content'];
      $mess->save();

      Flash::success('Сообщение успешно отправлено!');
    }
  }

  public function onAddTestimonial() {

    $rules = [
      'name'  => 'required|min:4|max:50',
      'avatar'  => 'required|image|mimes:jpeg,bmp,png|max:10240',
      'description'  => 'required|min:20|max:500'
    ];

    $messages = [
      'required' => 'Поле обязательно к заполнению!',
      'min'      => 'Минимум :min символов!',
      'description.max'      => 'Максимум :max символов!',
      'mimes' => 'Только изображение jpeg,bmp,png',
      'image' => 'Только изображение',
      'avatar.max' => 'Картинка должна быть не более 10MB'
    ];

    $validator = Validator::make(Input::all(), $rules, $messages);

    if ($validator->fails()) {
      Flash::error('Произошла ошибка!');
      throw new ValidationException($validator);
    } else {

      $vars = [
        'name' => Input::get('name'),
        'avatar' => Input::file('avatar'),
        'description' => Input::get('description')
      ];

      $testimonial = new Testimonial();

      $testimonial->name = $vars['name'];
      $testimonial->description = $vars['description'];
      $testimonial->created_at = time();
      $testimonial->status = 0;

      if (Input::has('avatar')) {
        $testimonial->avatar = $vars['avatar'];
      }

      $result = $testimonial->save();

      if ($result) {
        Flash::success('Отзыв успешно добавлен!');

        Mail::send('acme.setting::mail.testimonial', $vars, function($message) {
          $subject = 'Новый отзыв с сайта';
          $message->to($this->getUserMail(), 'Admin Person');
          $message->subject($subject);
        });

      } else {
        Flash::error('Произошла ошибка!');
        throw new ValidationException($validator);
      }
    }
  }

}