<?php

namespace App\Http\Controllers;

use App\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use  Illuminate\Support\Facades\Validator;

class recordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'fname' => 'required',
            'sname' => 'required',
            'email' => 'required|email',
            'phone' => ['required', 'regex:/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/'],
            'show_date' => 'required'
            ]);
            
        // since we have no requirements for server-side validation
        // we just notify on problems on the server without specifying the problem field
        if ($validator->fails()) {
            return false;
        }
        
        $record = new Record;
        $record->name = $request->name;
        $record->fname = $request->fname;
        $record->sname = $request->sname;
        $record->phone = $request->phone;
        $record->email = $request->email;
        $record->show_date = $request->show_date;
        $record->save();

        $message = 'Поступил новый запрос на показ системы iFORA от ' .  $request->name . ' ' . $request->fname .
        ' пожалуйста, свяжитесь с ним по телефону ' . $request->phone;
        $this->sendEmail($message);

        return $record->wasChanged();
    }

    protected function sendEmail($message)
    {
        $to = "dmitriy.shaydurov@gmail.com";
        $subject = "Запрос на показ системы iFORA";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $headers .= 'From: <dmitriy.shaydurov@gmail.com>' . "\r\n";
        $headers .= 'Cc: dmitriy.shaydurov@gmail.com' . "\r\n";

        return mail($to, $subject, $message, $headers);
    }

    public function csvGenerate()
    {
        $records = Record::all()->toArray();
        $fileName =  date("d-m-Y-h-i-sa") . '.csv';
        $content = '';
        $dlim = ';';

        foreach ($records as $record) {
            $content .= $record['name'] . $dlim .
                        $record['fname'] . $dlim .
                        $record['fname'] . $dlim .
                        $record['phone'] . $dlim .
                        $record['email'] . $dlim .
                        $record['show_date'] . PHP_EOL;
        }
        Storage::disk('public')->put($fileName, iconv("UTF-8", "windows-1251", $content));
        return asset("storage/$fileName");
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Record $record)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function edit(Record $record)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Record $record)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record)
    {
        //
    }
}
