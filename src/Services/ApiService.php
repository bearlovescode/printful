<?php
    namespace Bearlovescode\Printful\Services;

    use Bearlovescode\Printful\Clients\ApiClient;
    use Bearlovescode\Printful\Models\IConfiguration;

    abstract class ApiService
    {
        protected ApiClient $client;

        public function __construct(
            protected readonly IConfiguration $config
        )
        {
            $this->setUpClient();
        }

        private function setUpClient(): void
        {
            if (empty($this->client)) {
                $this->client = new ApiClient($this->config);
            }
        }
    }