<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocialLinkResource\Pages;
use App\Models\SocialLink;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SocialLinkResource extends Resource
{
    protected static ?string $model = SocialLink::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-link';
    protected static ?int $navigationSort = 6;

    public static function getNavigationGroup(): ?string
    {
        return __('admin.resources.navigation_group');
    }

    public static function getModelLabel(): string
    {
        return __('admin.resources.social_link');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.social_links');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.resources.social_links');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('platform')
                ->label(__('admin.fields.platform'))
                ->required()
                ->maxLength(50)
                ->placeholder('GitHub, Twitter, LinkedIn...'),

            Forms\Components\TextInput::make('url')
                ->label(__('admin.fields.url'))
                ->required()
                ->url()
                ->maxLength(500),

            Forms\Components\TextInput::make('icon')
                ->label(__('admin.fields.icon'))
                ->maxLength(100)
                ->placeholder('fa-brands fa-linkedin')
                ->helperText('استخدم أكواد FontAwesome (مثل: fa-brands fa-github) أو Devicon.'),

            Forms\Components\TextInput::make('sort_order')
                ->label(__('admin.fields.sort_order'))
                ->numeric()
                ->default(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('platform')->label(__('admin.fields.platform'))->sortable()->searchable(),
                Tables\Columns\TextColumn::make('url')->label(__('admin.fields.url'))->limit(40),
                Tables\Columns\TextColumn::make('icon')->label(__('admin.fields.icon')),
                Tables\Columns\TextColumn::make('sort_order')->label(__('admin.fields.sort_order'))->sortable(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListSocialLinks::route('/'),
            'create' => Pages\CreateSocialLink::route('/create'),
            'edit'   => Pages\EditSocialLink::route('/{record}/edit'),
        ];
    }
}
