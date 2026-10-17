<?php

namespace App\Filament\Concerns;

trait SortsReportRows
{
    public ?string $reportSortColumn = null;

    public string $reportSortDirection = 'asc';

    abstract protected function sortableReportColumns(): array;

    public function sortReport(string $column): void
    {
        if (! in_array($column, $this->sortableReportColumns(), true)) {
            return;
        }

        $this->reportSortDirection = $this->reportSortColumn === $column && $this->reportSortDirection === 'asc'
            ? 'desc' : 'asc';
        $this->reportSortColumn = $column;
    }

    protected function sortedReportRows(array $rows): array
    {
        if (! in_array($this->reportSortColumn, $this->sortableReportColumns(), true)) {
            return $rows;
        }

        return collect($rows)->sortBy(
            $this->reportSortColumn,
            SORT_NATURAL | SORT_FLAG_CASE,
            $this->reportSortDirection === 'desc',
        )->values()->all();
    }
}
