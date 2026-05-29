<?php

namespace Tests\Unit;

use App\Http\Requests\StoreAnakRequest;
use Tests\TestCase;

class StoreAnakRequestTest extends TestCase
{
    public function test_rules_contain_all_required_fields()
    {
        $request = new StoreAnakRequest();
        $rules = $request->rules();

        $this->assertArrayHasKey('nama', $rules);
        $this->assertArrayHasKey('gender', $rules);
        $this->assertArrayHasKey('tanggal_lahir', $rules);
        $this->assertArrayHasKey('berat_lahir', $rules);
        $this->assertArrayHasKey('tinggi_lahir', $rules);
    }

    public function test_nama_is_required()
    {
        $request = new StoreAnakRequest();
        $rules = $request->rules();

        $this->assertContains('required', $rules['nama']);
    }

    public function test_gender_is_required()
    {
        $request = new StoreAnakRequest();
        $rules = $request->rules();

        $this->assertContains('required', $rules['gender']);
    }

    public function test_tanggal_lahir_is_required_and_date()
    {
        $request = new StoreAnakRequest();
        $rules = $request->rules();

        $this->assertContains('required', $rules['tanggal_lahir']);
        $this->assertContains('date', $rules['tanggal_lahir']);
    }

    public function test_berat_lahir_is_required_and_numeric()
    {
        $request = new StoreAnakRequest();
        $rules = $request->rules();

        $this->assertContains('required', $rules['berat_lahir']);
        $this->assertContains('numeric', $rules['berat_lahir']);
    }

    public function test_tinggi_lahir_is_required_and_numeric()
    {
        $request = new StoreAnakRequest();
        $rules = $request->rules();

        $this->assertContains('required', $rules['tinggi_lahir']);
        $this->assertContains('numeric', $rules['tinggi_lahir']);
    }

    public function test_authorize_returns_true()
    {
        $request = new StoreAnakRequest();

        $this->assertTrue($request->authorize());
    }
}
