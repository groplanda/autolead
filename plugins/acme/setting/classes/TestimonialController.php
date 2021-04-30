<?php

namespace Acme\Setting\Classes;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Validator;
use Backend\Models\User;
use Acme\Setting\Models\Testimonial;

class TestimonialController extends Controller
{
  /**
   *
   *
   * @return Response
   */
  public function send(Request $request)
  {

    $rules = [
      'name'  => 'required|min:10|max:50',
      'avatar'  => 'required|mimes:jpeg,bmp,png|file|max:512',
      'description'  => 'required|min:21|max:500'
    ];

    $messages = [
      'required' => 'Поле обязательно к заполнению!',
      'min'      => 'Минимум :min символов!',
      'max'      => 'Максимум :max символов!',
      'email'    => 'Некорректный e-mail',
      'mimes' => 'Только изображение!',
      'file' => 'Аватар должен быть файлом'
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
      $validatorErrors = $validator->errors()->toArray();
      return response()->json(array_merge(['status' => 'error'], $validatorErrors));
    } else {

      $testimonial = new Testimonial();

      $testimonial->name = $request->get('name');
      $testimonial->description = $request->get('description');
      $testimonial->created_at = time();
      $testimonial->status = 0;

      if ($request->hasFile('avatar')) {
        $testimonial->avatar = $request->file('avatar');
      }

      $result = $testimonial->save();

      if ($result) {
        return response()->json(['status' => 'success', 'message' => 'Отзыв успешно добавлен!']);
      } else {
        $validatorErrors = $validator->errors()->toArray();
        return response()->json(array_merge(['status' => 'error'], $validatorErrors));
      }
    }
  }

  public function getUserMail()
  {
    return User::where('is_superuser', 1)->value('email');
  }
}