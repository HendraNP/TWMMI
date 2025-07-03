<?php
namespace App\Filament\Traits;

use Filament\Actions\Action;

trait HasViewHistoryAction
{
    public function getViewHistoryAction(): Action
    {
        return Action::make('viewHistory')
            ->label('View History')
            ->modalHeading('Change History')
            ->modalSubmitAction(false)
            ->slideOver() // Optional: use modal() or slideOver()
            ->modalContent(view('components.model-history', [
                'record' => $this->record,
            ]));
    }
}
