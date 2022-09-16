<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\FormMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Lead;


class LeadController extends Controller
{
    //
    public function store(Request $request){
        $data = $request->all();
        $data_rules = [
            'name' => 'required | max: 255',
            'email' => 'required | max: 255 | email',
            'message' => 'required | max: 500'
        ];
        $validator = Validator::make($data, $data_rules);

        if($validator->fails()){
            return response()->json(
                [
                    'success' => 'false',
                    'errors' => $validator->errors()
                ]
            );
        }

        $new_lead = new Lead();
        $new_lead->fill($data);
        $new_lead->save();


        Mail::to('test@test.it')->send(new FormMail());
        return response()->json(['success' => true]);
    }
}
