<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use App\Services\LanguageService;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-tag';
    protected static ?int $navigationSort = 4;

    public static function getModelLabel(): string
    {
        return __('admin.resources.category');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.categories');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.resources.categories');
    }

    public static function form(Schema $schema): Schema
    {
        $languages = app(LanguageService::class)->getAvailableLanguages();

        return $schema->components([
            Forms\Components\Select::make('type')
                ->label(__('admin.fields.type'))
                ->required()
                ->options([
                    'page' => __('admin.fields.type_page'),
                    'work' => __('admin.fields.type_work'),
                    'skill' => __('admin.fields.type_skill'),
                    'certification' => __('admin.fields.type_certification'),
                ])
                ->default('work')
                ->native(false),

            Forms\Components\TextInput::make('name')
                ->label(__('admin.fields.name'))
                ->required()
                ->maxLength(255)
                ->live(onBlur: true)
                ->afterStateUpdated(fn (\Filament\Schemas\Components\Utilities\Set $set, ?string $state) =>
                    $set('slug', Str::slug($state))
                ),

            Forms\Components\TextInput::make('slug')
                ->label(__('admin.fields.slug'))
                ->required()
                ->maxLength(255),

            Forms\Components\Select::make('language')
                ->label(__('admin.fields.language'))
                ->required()
                ->options(array_combine($languages, $languages))
                ->native(false),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label(__('admin.fields.name'))->searchable()->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->label(__('admin.fields.type'))
                    ->formatStateUsing(fn ($state) => match($state) {
                        'page' => __('admin.fields.type_page'),
                        'work' => __('admin.fields.type_work'),
                        'skill' => __('admin.fields.type_skill'),
                        'certification' => __('admin.fields.type_certification'),
                        default => $state,
                    })
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')->label(__('admin.fields.slug')),
                Tables\Columns\TextColumn::make('language')->label(__('admin.fields.language'))->badge()->color('success'),
                Tables\Columns\TextColumn::make('works_count')
                    ->counts('works')
                    ->label(__('admin.resources.works')),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label(__('admin.fields.type'))
                    ->options([
                        'page' => __('admin.fields.type_page'),
                        'work' => __('admin.fields.type_work'),
                        'skill' => __('admin.fields.type_skill'),
                        'certification' => __('admin.fields.type_certification'),
                    ]),
                Tables\Filters\SelectFilter::make('language')
                    ->label(__('admin.fields.language'))
                    ->options(function () {
                        $langs = app(\App\Services\LanguageService::class)->getAvailableLanguages();
                        return array_combine($langs, $langs);
                    })
                    ->native(false),
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit'   => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
