<?php

namespace App\Exceptions;

use Exception;

class NodeSystemException extends Exception
{
    public function __construct($message = "An error occurred with the Node system.", $code = 0, Exception $previous = null)
    {
        // يمكنك تخصيص الرسالة هنا أو استخدام الرسالة الافتراضية
        parent::__construct($message, $code, $previous);
    }
}
