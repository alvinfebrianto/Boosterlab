<?php

namespace Tests\Unit;

use App\Http\Requests\StoreAnakRequest;
use App\Http\Requests\UpdateAnakRequest;
use Tests\TestCase;

class UpdateAnakRequestTest extends TestCase
{
    public function test_rules_match_store_anak_request()
    {
        $storeRequest = new StoreAnakRequest();
        $updateRequest = new UpdateAnakRequest();

        $this->assertEquals($storeRequest->rules(), $updateRequest->rules());
    }

    public function test_authorize_returns_true()
    {
        $request = new UpdateAnakRequest();

        $this->assertTrue($request->authorize());
    }
}
