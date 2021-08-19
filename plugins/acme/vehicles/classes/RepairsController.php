<?php

namespace Acme\Vehicles\Classes;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Validator;
use Backend\Models\User;
use Acme\Vehicles\Models\Repair;

class RepairsController extends Controller
{
  /**
   *
   *
   * @return Response
   */

  public function add(Request $request)
  {

    $rules = [
      'title'  => 'required|min:3|max:50',
      'standing' => 'required|min:3|max:50',
      'mileage' => 'required|numeric',
      'price'  => 'required|numeric',
      'description'  => 'max:2500',
      'vehicle_id' => 'required',
      'images.*' => 'image|mimes:jpeg,bmp,png|max:10240'
    ];

    $messages = [
      'required' => 'Поле обязательно к заполнению!',
      'min'      => 'Минимум :min символов!',
      'description.max' => 'Максимум :max символов!',
      'email'    => 'Некорректный e-mail',
      'numeric'  => 'Поле должен быть числом',
      'image'    => 'Файл должен быть изображением',
      'mimes'    => 'Допускается jpeg,bmp,png',
      'max' => 'Картинка должна быть не более 10MB'
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {

      $validatorErrors = $validator->errors()->toArray();
      return response()->json(array_merge(['status' => 'error'], $validatorErrors));
    } else {
      $this->insertRepair($request);
      return response()->json(['status' => 'success', 'message' => 'Ремонт успешно добавлен']);
    }
  }

  // public function update(Request $request)
  // {

  //   $rules = [
  //     'brand'  => 'required|min:3|max:50',
  //     'model' => 'required|min:3|max:50',
  //     'year' => 'required|numeric',
  //     'color'  => 'required|min:3|max:50',
  //     'description'  => 'max:500',
  //     'vin' => Rule::unique('acme_vehicles_vehicle', 'vin')->ignore($request->get('id'))
  //   ];

  //   $messages = [
  //     'required' => 'Поле обязательно к заполнению!',
  //     'min'      => 'Минимум :min символов!',
  //     'max'      => 'Максимум :max символов!',
  //     'email'    => 'Некорректный e-mail',
  //     'numeric'  => 'Год должен быть числом',
  //     'unique'   => 'Поле должно быть уникальным'
  //   ];

  //   $validator = Validator::make($request->all(), $rules, $messages);

  //   if ($validator->fails()) {

  //     $validatorErrors = $validator->errors()->toArray();
  //     return response()->json(array_merge(['status' => 'error'], $validatorErrors));
  //   } else {
  //     $this->updateVehicle($request);

  //     return response()->json(['status' => 'success', 'message' => 'Автомобиль успешно изменен']);
  //   }
  // }

  private function insertRepair($request) {

    $repair = new Repair;
    $repair->title        = $request->get('title');
    $repair->status       = $request->get('standing');
    $repair->mileage      = $request->get('mileage');
    $repair->price        = $request->get('price');
    $repair->description  = $request->get('description');
    $repair->spare_parts  = $request->get('spare_parts');
    $repair->vehicle_id   = $request->get('vehicle_id');

    $files = $request->file('images');

    if ($files) {
      foreach ($files as $file) {
        $repair->images = $file;
      }
    }

    return $repair->save();
  }

  // private function updateVehicle($request) {

  //   $vehicle = Vehicle::find($request->get('id'));
  //   $vehicle->brand = $request->get('brand');
  //   $vehicle->color = $request->get('color');
  //   $vehicle->description = $request->get('description');
  //   $vehicle->model = $request->get('model');
  //   $vehicle->vin = $request->get('vin');
  //   $vehicle->year = $request->get('year');
  //   $vehicle->user_id = $request->get('user_id');

  //   if ($request->hasFile('image')) {
  //     $vehicle->image = $request->file('image');
  //   }

  //   if ($request->get('image') == "remove" && isset($vehicle->image)) {
  //     $vehicle->image->delete();
  //   }

  //   $query = $vehicle->save();
  //   return $query;
  // }

  public function getUserMail()
  {
    return User::where('is_superuser', 1)->value('email');
  }
}
