<?php

namespace Tests\Unit;

use App\Http\Requests\StoreAnakRequest;
use App\Http\Requests\UpdateAnakRequest;
use Tests\TestCase;

class UpdateAnakRequestTest extends TestCase
{
    public function test_rules_contain_editable_fields_only()
    {
        $request = new UpdateAnakRequest();
        $rules = $request->rules();

        $this->assertArrayHasKey('nama', $rules);
        $this->assertArrayHasKey('gender', $rules);
        $this->assertArrayHasKey('tanggal_lahir', $rules);
        $this->assertArrayNotHasKey('berat_lahir', $rules);
        $this->assertArrayNotHasKey('tinggi_lahir', $rules);
    }

    public function test_authorize_returns_true()
    {
        $request = new UpdateAnakRequest();

        $this->assertTrue($request->authorize());
    }
}
