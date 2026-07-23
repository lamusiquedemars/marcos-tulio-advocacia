<?php

namespace App\Filament\Resources\OralDefenses\Pages;

use App\Filament\Resources\OralDefenses\OralDefenseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOralDefenses extends ListRecords
{
    protected static string $resource = OralDefenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Adicionar conteúdo'),
        ];
    }
}
