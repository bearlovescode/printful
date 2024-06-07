<?php
    namespace Bearlovescode\Printful\Exceptions;

    class PrintfulApiException extends \Exception
    {
        public function __construct(object $response)
        {
            parent::__construct($response->error->message, $response->code);
        }
    }