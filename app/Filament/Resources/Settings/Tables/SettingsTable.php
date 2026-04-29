<?php

namespace App\Filament\Resources\Settings\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Actions\EditAction;

class SettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('owner_name')
                    ->label(__('admin.fields.owner_name')),
                TextColumn::make('contact_email')
                    ->label(__('admin.fields.contact_email')),
                TextColumn::make('default_language')
                    ->label(__('admin.fields.default_language')),
                IconColumn::make('site_active')
                    ->label(__('admin.fields.site_active'))
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                //
            ])
            ->paginated(false);
    }
}
