<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DaysRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $error = true;
        foreach($value as $v){
            foreach($v as $item){
                if($item['isOpen']){
                    if(!isset($item['open']) || !isset($item['close'])){
                        $error = false;
                    }
                }
            }
        }
        return $error;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Fill out all the fields where days are open in availibility.';
    }
}
