<?php

namespace App\Garages\Database;

use Illuminate\Database\Connection as BaseConnection;

class Connection extends BaseConnection
{
    /**
     * @inheritDoc
     */
    public function query()
    {
        return new Builder(
            $this,
            $this->getQueryGrammar(),
            $this->getPostProcessor()
        );
    }
}
