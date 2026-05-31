<?php

namespace Tests\Unit;

use App\Http\Requests\StorePengukuranRequest;
use Tests\TestCase;

class StorePengukuranRequestTest extends TestCase
{
    public function test_rules_contain_all_required_fields()
    {
        $request = new StorePengukuranRequest();
        $rules = $request->rules();

        $this->assertArrayHasKey('berat', $rules);
        $this->assertArrayHasKey('tinggi', $rules);
    }

    public function test_berat_is_required_and_numeric()
    {
        $request = new StorePengukuranRequest();
        $rules = $request->rules();

        $this->assertContains('required', $rules['berat']);
        $this->assertContains('numeric', $rules['berat']);
    }

    public function test_tinggi_is_required_and_numeric()
    {
        $request = new StorePengukuranRequest();
        $rules = $request->rules();

        $this->assertContains('required', $rules['tinggi']);
        $this->assertContains('numeric', $rules['tinggi']);
    }

    public function test_authorize_returns_true()
    {
        $request = new StorePengukuranRequest();

        $this->assertTrue($request->authorize());
    }

}
