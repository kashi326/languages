<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class OtherLangsRule implements Rule
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
        if(count($value) > 0){
            foreach($value as $v){
                if(!isset($v['language']['name']) || !isset($v['level']['name'])){
                    $error = false;
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
        return 'Fill out all the fields in other languages';
    }
}
