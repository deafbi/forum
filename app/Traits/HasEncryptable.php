<?php

namespace App\Traits;

use Illuminate\Support\Facades\Crypt;

trait HasEncryptable
{
    public function __get($key)
    {
        $value = parent::__get($key);

        if (in_array($key, $this->encryptable)) {
            return Crypt::decryptString($value);
        }

        return $value;
    }

    public function __set($key, $value)
    {
        if (in_array($key, $this->encryptable)) {
            $value = Crypt::encryptString($value);
        }

        parent::__set($key, $value);
    }
}
