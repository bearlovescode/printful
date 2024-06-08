<?php
    namespace Bearlovescode\Printful\Services;

    use Bearlovescode\Printful\Models\PrintfulStore;
    use GuzzleHttp\Psr7\Request;

    class StoreService extends ApiService
    {
        public function changePackingSlip() {}

        public function getAllStoreData(): array
        {
            $result = [];

            $req = new Request('GET', '/stores/');
            $data = $this->client->handle($req);

            if (isset($data->result))
            {
                foreach ($data->result as $store)
                    $result[] = new PrintfulStore($store);
            }

            return $result;
        }

        public function getStoreData(string $id): PrintfulStore|null
        {
            $req = new Request('GET', sprintf('/stores/%s', $id));

            $data = $this->client->handle($req);

            if (isset($data->result))
                return new PrintfulStore($data->result);

            return null;
        }
    }