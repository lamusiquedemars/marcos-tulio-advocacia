<?php

namespace Tests\Unit;

use App\Filament\Concerns\SortsReportRows;
use PHPUnit\Framework\TestCase;

class ReportSortingTest extends TestCase
{
    public function test_reports_keep_default_order_until_clicked_and_sort_raw_numbers(): void
    {
        $report = new class
        {
            use SortsReportRows;

            protected function sortableReportColumns(): array
            {
                return ['name', 'size'];
            }

            public function rows(array $rows): array
            {
                return $this->sortedReportRows($rows);
            }
        };
        $rows = [['name' => 'Zulu', 'size' => 100], ['name' => 'Alpha', 'size' => 20]];
        $this->assertSame($rows, $report->rows($rows));
        $report->sortReport('size');
        $this->assertSame([20, 100], array_column($report->rows($rows), 'size'));
        $report->sortReport('size');
        $this->assertSame([100, 20], array_column($report->rows($rows), 'size'));
        $report->sortReport('name');
        $this->assertSame(['Alpha', 'Zulu'], array_column($report->rows($rows), 'name'));
        $report->sortReport('calculated_summary');
        $this->assertSame('name', $report->reportSortColumn);
    }
}
