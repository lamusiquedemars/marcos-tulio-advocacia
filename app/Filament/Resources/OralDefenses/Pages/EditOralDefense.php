<?php

namespace App\Filament\Resources\OralDefenses\Pages;

use App\Filament\Resources\OralDefenses\OralDefenseResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOralDefense extends EditRecord
{
    protected static string $resource = OralDefenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()->label('Excluir'),
        ];
    }
}
