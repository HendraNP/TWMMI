<?php

namespace App\Filament\Resources\UserMailResource\Pages;

use App\Filament\Resources\UserMailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\UserMail;

use Illuminate\Support\Facades\Mail;
use App\Mail\ReplyToUserMessage;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Auth;

class EditUserMail extends EditRecord
{
    protected static string $resource = UserMailResource::class;

    public function mount(int|string $record): void
    {
        parent::mount($record);

        if ($this->record->flag === 'unread') {
            $this->record->flag = 'read';
            $this->record->save();
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getFormActions(): array
    {
        return [
        ];
    }


    protected function handleRecordUpdate($record, array $data): \Illuminate\Database\Eloquent\Model
    {
        // Save the reply to the database
        $record->reply = $data['reply'];
        $record->replied_by = Auth::id();
        $record->flag = 'replied'; // Set the flag to indicate the message has been replied to
        $record->save();

        // Send the reply via email
        //Mail::to($record->email)->send(new ReplyToUserMessage($record));

        return $record;
    }
}
