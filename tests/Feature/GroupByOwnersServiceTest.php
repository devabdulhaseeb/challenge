<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\GroupByOwnersService;

class GroupByOwnersServiceTest extends TestCase
{
    public function testGroupByOwners()
    {
        $files = [
            "insurance.txt" => "Company A",
            "letter.docx" => "Company A",
            "Contract.docx" => "Company B",
        ];

        $groupByOwnersService = new GroupByOwnersService();
        $result = $groupByOwnersService->groupByOwners($files);

        $this->assertEquals([
            "Company A" => ["insurance.txt", "letter.docx"],
            "Company B" => ["Contract.docx"],
        ], $result);
        
        echo json_encode($result, JSON_PRETTY_PRINT);

    }
}
