<?php
    namespace Bearlovescode\Printful\Models;

    use Bearlovescode\Datamodels\Auth\Token;
    use Bearlovescode\Datamodels\DataModel;
    use Psr\Http\Message\UriInterface;

    class Configuration extends DataModel implements IConfiguration
    {
        public UriInterface $apiUrl;
        public Token $apiKey;
        public ?string $appName;
        public bool $debug = false;

        public function __construct(array|object $data)
        {
            $this->setApiKeyAsToken($data);
            parent::__construct($data);
        }

        public function setApiKeyAsToken(&$data): void
        {
            if($data['apiKey'] instanceof Token)
            {
                $this->apiKey = $data['apiKey'];
                unset($data['apiKey']);
            }

            $key = '';

            if (is_array($data))
            {
                $key = $data['apiKey'];
                unset($data['apiKey']);
            }
            elseif (is_object($data))
            {
                $key = $data->apiKey;
                unset($data->apiKey);
            }

            else
            {
                throw new \Exception('Invalid API Key');
            }

            $this->apiKey = new ApiToken($key);
        }
    }