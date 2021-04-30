<?php

namespace Acme\Setting\Classes;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Validator;
use Mail;
use Backend\Models\User;

class MessageController extends Controller
{
  /**
   *
   *
   * @return Response
   */
  public function send(Request $request)
  {

    $rules = [
      'name'  => 'required|min:4|max:50',
      'phone' => 'required|min:11|max:50',
      'question' => 'max:100',
      'email'  => 'email',
      'content'  => 'min:20|max:500',
    ];

    $messages = [
      'required' => 'Поле обязательно к заполнению!',
      'min'      => 'Минимум :min символов!',
      'max'      => 'Максимум :max символов!',
      'email'    => 'Некорректный e-mail',
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {

      $validatorErrors = $validator->errors()->toArray();
      return response()->json(array_merge(['status' => 'error'], $validatorErrors));

    } else {
      Mail::send('acme.setting::mail.message', $request->all(), function($message) use($request) {
        $subject = $request->get('question') ? $request->get('question') : 'Заявка с сайта';
        $message->to($this->getUserMail(), 'Admin Person');
        $message->subject($subject);
      });

      return response()->json(['status' => 'success', 'message' => 'Сообщение успешно отправлено!']);
    }
  }

  public function getUserMail()
  {
    return User::where('is_superuser', 1)->value('email');
  }
}
