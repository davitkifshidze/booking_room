<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'max' => [
        'array' => ':attribute ველში არ უნდა იყოს :max ერთეულზე მეტი.',
        'numeric' => ':attribute ველი არ უნდა იყოს :max-ზე მეტი.',
        'string' => ':attribute ველი არ უნდა იყოს :max სიმბოლოზე მეტი.',
    ],
    'min' => [
        'array' => ':attribute ველში უნდა იყოს მინიმუმ :min ელემენტი.',
        'numeric' => ':attribute ველი უნდა იყოს მინიმუმ :min.',
        'string' => ':attribute ველი უნდა იყოს მინიმუმ :min სიმბოლო.',
    ],
    'required' => ':attribute ველი აუცილებელია.',
    'string' => ':attribute ველი უნდა იყოს სტრიქონი.',
    'unique' => ':attribute უკვე დაკავებულია.',
    'numeric' => ':attribute ველი უნდა შეიცავდეს მხოლოდ რიცხვებს.',
    'regex' => ':attribute ფორმატი არასწორია',
    'digits' => ':attribute უნდა შეიცავდეს :digits რიცხვს',


    'size' => [
        'numeric' => ':attribute ველი უნდა შეიცავდეს :size რიცხვს',
        'string' => ':attribute ველი უნდა შეიცავდეს :size სიმბოლოს.',
    ],

    'attributes' => [
        'name' => 'სახელწოდება',
        'surname' => 'გვარი',
        'personal_number' => 'პირადი ნომერი',
        'password' => 'პაროლი',
    ],


];
