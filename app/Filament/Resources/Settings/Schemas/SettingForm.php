<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make(__('admin.sections.general'))->schema([
                    Forms\Components\TextInput::make('owner_name')
                        ->label(__('admin.fields.owner_name'))
                        ->required()
                        ->maxLength(100),

                    Forms\Components\TextInput::make('contact_email')
                        ->label(__('admin.fields.contact_email'))
                        ->email()
                        ->required()
                        ->maxLength(255),

                    Forms\Components\Select::make('default_language')
                        ->label(__('admin.fields.default_language'))
                        ->options(['en' => 'English', 'ar' => 'العربية'])
                        ->native(false)
                        ->required(),

                    Forms\Components\Toggle::make('show_site_name')
                        ->label(__('admin.fields.show_site_name'))
                        ->default(true),


                    Forms\Components\FileUpload::make('site_favicon')
                        ->label(__('admin.fields.site_favicon'))
                        ->image()
                        ->avatar()
                        ->imageEditor()
                        ->imageEditorAspectRatioOptions(['1:1'])
                        ->disk('public')
                        ->directory('settings'),

                    Forms\Components\FileUpload::make('site_logo')
                        ->label(__('admin.fields.site_logo'))
                        ->image()
                        ->disk('public')
                        ->directory('settings'),

                ])->columns(2),

                \Filament\Schemas\Components\Section::make(__('admin.sections.maintenance_mode'))->schema([
                    Forms\Components\Toggle::make('site_active')
                        ->label(__('admin.fields.site_active'))
                        ->default(true),

                    Forms\Components\RichEditor::make('maintenance_message')
                        ->label(__('admin.fields.maintenance_message'))
                        ->toolbarButtons([
                            'bold',
                            'italic',
                            'h2',
                            'h3',
                            'underline',
                            'strike',
                            'link',
                            'bulletList',
                            'orderedList',
                            'undo',
                            'redo',
                        ])
                        ->columnSpanFull()
                        ->placeholder(__('admin.maintenance.default_message')),
                ])->columns(2),
            ]);
    }
}
