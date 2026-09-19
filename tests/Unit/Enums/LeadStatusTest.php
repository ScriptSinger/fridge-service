<?php

namespace Tests\Unit\Enums;

use App\Enums\LeadStatus;
use Tests\TestCase;

class LeadStatusTest extends TestCase
{
    public function test_irrelevant_is_excluded_from_stats(): void
    {
        $this->assertFalse(LeadStatus::Irrelevant->countsTowardStats());
    }

    /**
     * @dataProvider realStatusesProvider
     */
    public function test_every_other_status_counts_toward_stats(LeadStatus $status): void
    {
        $this->assertTrue($status->countsTowardStats());
    }

    public static function realStatusesProvider(): array
    {
        return [
            [LeadStatus::New],
            [LeadStatus::InProgress],
            [LeadStatus::Scheduled],
            [LeadStatus::Closed],
            [LeadStatus::Declined],
        ];
    }
}
