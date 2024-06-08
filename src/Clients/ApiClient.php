<?php
    namespace Bearlovescode\Printful\Clients;

    use Bearlovescode\Printful\Exceptions\PrintfulApiException;
    use Bearlovescode\Printful\Models\IConfiguration;
    use GuzzleHttp\Client;
    use Psr\Http\Message\RequestInterface;

    class ApiClient
    {
        private IConfiguration $config;
        private Client $client;

        public function __construct(IConfiguration $config)
        {
            $this->config = $config;

            $clientOptions = [
                'base_uri' => $this->config->apiUrl
            ];

            $this->client = new Client($clientOptions);
        }

        /*
         *
         * @param RequestInterface $request
         * @param array $overrides http request option overrides.
         * @throws \Bearlovescode\Printful\Exceptions\PrintfulApiException
         */
        public function handle(RequestInterface $request, array $overrides = []): object
        {

            $res = $this->client->send($request, $this->buildRequestOptions($overrides));
            $data = json_decode($res->getBody()->getContents());

            if ($res->getStatusCode() !== 200) {
                $this->handleApiError($data);
            }
            return json_decode($data);
        }

        private function buildRequestOptions(array $overrides = []): array
        {
            $options = [
                'headers' => [
                    'user-agent' => $this->config->appName ?? '',
                    'accept' => 'application/json'
                ],
                'debug' => $this->config->debug
            ];

            if (!empty($this->config->apiKey))
                $options['headers']['authorization'] =
                    sprintf('Bearer %s', $this->config->apiKey->value);

            return array_merge($options, $overrides);
        }

        public function handleApiError(object $data): void
        {
            throw new PrintfulApiException($data);
        }
    }