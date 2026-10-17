@props(['column'])
<th {{ $attributes }} aria-sort="{{ $this->reportSortColumn === $column ? ($this->reportSortDirection === 'asc' ? 'ascending' : 'descending') : 'none' }}">
    <button type="button" wire:click="sortReport('{{ $column }}')">
        {{ $slot }}
        <span aria-hidden="true">{{ $this->reportSortColumn === $column ? ($this->reportSortDirection === 'asc' ? '↑' : '↓') : '↕' }}</span>
    </button>
</th>
