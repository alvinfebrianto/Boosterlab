<?php

namespace Tests\Unit;

use App\Http\Requests\StorePengukuranRequest;
use App\Http\Requests\UpdatePengukuranRequest;
use Tests\TestCase;

class UpdatePengukuranRequestTest extends TestCase
{
    public function test_rules_match_store_pengukuran_request()
    {
        $storeRequest = new StorePengukuranRequest();
        $updateRequest = new UpdatePengukuranRequest();

        $this->assertEquals($storeRequest->rules(), $updateRequest->rules());
    }

    public function test_authorize_returns_true()
    {
        $request = new UpdatePengukuranRequest();

        $this->assertTrue($request->authorize());
    }
}
