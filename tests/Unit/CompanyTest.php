<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Company;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_company_has_a_path()
    {
        $company = factory(Company::class)->create([
            'name' => 'leia yoda'
        ]);

        $this->assertEquals('/companies/leia-yoda', $company->path());
    }
}
