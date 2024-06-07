<?php
    namespace Bearlovescode\Printful\Models;

    use Bearlovescode\Datamodels\DataModel;

    class PrintfulStore extends DataModel
    {
        public int $id;
        public string $type;
        public string $name;
    }