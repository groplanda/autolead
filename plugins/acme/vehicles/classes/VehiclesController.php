<?php

namespace Acme\Vehicles\Classes;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Validator;
use Mail;
use Backend\Models\User;
use Acme\Vehicles\Models\Vehicle;
use Illuminate\Validation\Rule;

class VehiclesController extends Controller
{
  /**
   *
   *
   * @return Response
   */

  public function add(Request $request)
  {

    $rules = [
      'brand'  => 'required|min:3|max:50',
      'model' => 'required|min:3|max:50',
      'year' => 'required|numeric',
      'color'  => 'required|min:3|max:50',
      'description'  => 'max:500',
      'vin' => Rule::unique('acme_vehicles_vehicle', 'vin')
    ];

    $messages = [
      'required' => 'Поле обязательно к заполнению!',
      'min'      => 'Минимум :min символов!',
      'max'      => 'Максимум :max символов!',
      'email'    => 'Некорректный e-mail',
      'numeric'  => 'Год должен быть числом',
      'unique'   => 'Поле должно быть уникальным'
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {

      $validatorErrors = $validator->errors()->toArray();
      return response()->json(array_merge(['status' => 'error'], $validatorErrors));
    } else {
      $this->insertVehicle($request);


      // Mail::send('acme.setting::mail.message', $request->all(), function($message) use($request) {
      //   $subject = $request->get('question') ? $request->get('question') : 'Заявка с сайта';
      //   $message->to($this->getUserMail(), 'Admin Person');
      //   $message->subject($subject);
      // });

      return response()->json(['status' => 'success', 'message' => 'Автомобиль успешно добавлен']);
    }
  }

  public function update(Request $request)
  {

    $rules = [
      'brand'  => 'required|min:3|max:50',
      'model' => 'required|min:3|max:50',
      'year' => 'required|numeric',
      'color'  => 'required|min:3|max:50',
      'description'  => 'max:500',
      'vin' => Rule::unique('acme_vehicles_vehicle', 'vin')->ignore($request->get('id'))
    ];

    $messages = [
      'required' => 'Поле обязательно к заполнению!',
      'min'      => 'Минимум :min символов!',
      'max'      => 'Максимум :max символов!',
      'email'    => 'Некорректный e-mail',
      'numeric'  => 'Год должен быть числом',
      'unique'   => 'Поле должно быть уникальным'
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {

      $validatorErrors = $validator->errors()->toArray();
      return response()->json(array_merge(['status' => 'error'], $validatorErrors));
    } else {
      $this->updateVehicle($request);

      return response()->json(['status' => 'success', 'message' => 'Автомобиль успешно изменен']);
    }
  }

  private function insertVehicle($request) {

    $vehicle = new Vehicle;
    $vehicle->brand = $request->get('brand');
    $vehicle->color = $request->get('color');
    $vehicle->description = $request->get('description');
    $vehicle->model = $request->get('model');
    $vehicle->vin = $request->get('vin');
    $vehicle->year = $request->get('year');
    $vehicle->user_id = $request->get('user_id');

    $files = $request->file('image');

    if ($files) {
      foreach ($files as $file) {
        $vehicle->image = $file;
      }
    }

    $query = $vehicle->save();
    return $query;
  }

  private function updateVehicle($request) {

    $vehicle = Vehicle::find($request->get('id'));
    $vehicle->brand = $request->get('brand');
    $vehicle->color = $request->get('color');
    $vehicle->description = $request->get('description');
    $vehicle->model = $request->get('model');
    $vehicle->vin = $request->get('vin');
    $vehicle->year = $request->get('year');
    $vehicle->user_id = $request->get('user_id');

    if ($request->get('image') == "remove" && isset($vehicle->image)) {
      $vehicle->image->delete();
    } else {
      $files = $request->file('image');
      if ($files) {
        foreach ($files as $file) {
          $vehicle->image = $file;
        }
      }
    }

    $query = $vehicle->save();
    return $query;
  }

  public function getUserMail()
  {
    return User::where('is_superuser', 1)->value('email');
  }
}
