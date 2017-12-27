<?php

declare(strict_types=1);

namespace UMA\RPC\Tests\Fixture;

use UMA\RPC\Internal\Request;
use UMA\RPC\Internal\Response;
use UMA\RPC\Procedure;
use UMA\RPC\Success;

class Adder implements Procedure
{
    public function execute(Request $request): Response
    {
        $accumulator = 0;

        /** @var int[] $numbers */
        $numbers = $request->params();

        foreach ($numbers as $integer) {
            $accumulator += $integer;
        }

        return new Success($request->id(), $accumulator);
    }

    public function paramSpec(): ?\stdClass
    {
        return \json_decode(<<<'JSON'
{
  "$schema": "http://json-schema.org/schema#",

  "type": "array",
  "minItems": 1,
  "items": { "type": "integer" }
}
JSON
        );
    }
}