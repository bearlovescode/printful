<?php
    namespace Bearlovescode\Printful\Services;

    use Bearlovescode\Printful\Models\PrintfulStore;
    use GuzzleHttp\Psr7\Request;

    class StoreService extends ApiService
    {
        public function changePackingSlip() {}

        public function getAllStoreData() {}

        public function getStoreData(string $id): PrintfulStore|null
        {
            $req = new Request('GET', sprintf('/stores/%s', $id));

            $data = $this->client->handle($req);

            if (isset($data->result))
                return new PrintfulStore($data->result);

            return null;
        }
    }