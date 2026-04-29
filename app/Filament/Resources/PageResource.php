<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use App\Services\LanguageService;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-duplicate';
    protected static ?int $navigationSort = 3;

    public static function getModelLabel(): string
    {
        return __('admin.resources.page');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.pages');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.resources.pages');
    }

    public static function form(Schema $schema): Schema
    {
        $languages = app(LanguageService::class)->getAvailableLanguages();

        return $schema->components([
            \Filament\Schemas\Components\Section::make(__('admin.sections.basic_info'))->schema([
                Forms\Components\TextInput::make('title')
                    ->label(__('admin.fields.title'))
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(
                        fn(\Filament\Schemas\Components\Utilities\Set $set, ?string $state) =>
                        $set('slug', Str::slug($state))
                    ),

                Forms\Components\TextInput::make('link_title')
                    ->label(__('admin.fields.link_title'))
                    ->nullable()
                    ->maxLength(255),

                Forms\Components\TextInput::make('slug')
                    ->label(__('admin.fields.slug'))
                    ->required()
                    ->maxLength(255)
                    ->unique(Page::class, 'slug', ignoreRecord: true),

                Forms\Components\Select::make('language')
                    ->label(__('admin.fields.language'))
                    ->required()
                    ->options(array_combine($languages, $languages))
                    ->native(false),

                Forms\Components\Select::make('category_id')
                    ->label(__('admin.fields.category'))
                    ->relationship('category', 'name', fn($query) => $query->where('type', 'page'))
                    ->searchable()
                    ->preload()
                    ->nullable(),

                Forms\Components\Select::make('display_position')
                    ->label(__('admin.fields.display_position'))
                    ->options([
                        'none' => __('admin.fields.position_none'),
                        'header' => __('admin.fields.position_header'),
                        'footer' => __('admin.fields.position_footer'),
                        'both' => __('admin.fields.position_both'),
                    ])
                    ->default('none')
                    ->native(false),

                Forms\Components\Toggle::make('is_published')
                    ->label(__('admin.fields.is_published'))
                    ->default(true),
            ])->columns(2),

            \Filament\Schemas\Components\Section::make(__('admin.sections.content'))->schema([
                Forms\Components\RichEditor::make('content')
                    ->label(__('admin.fields.content'))
                    ->columnSpanFull(),
            ]),
        ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label(__('admin.fields.title'))->searchable()->sortable(),
                Tables\Columns\TextColumn::make('link_title')->label(__('admin.fields.link_title'))->searchable()->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('language')
                    ->label(__('admin.fields.language'))
                    ->badge()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('display_position')
                    ->label(__('admin.fields.display_position'))
                    ->formatStateUsing(fn($state) => match ($state) {
                        'header' => __('admin.fields.position_header'),
                        'footer' => __('admin.fields.position_footer'),
                        'both' => __('admin.fields.position_both'),
                        default => __('admin.fields.position_none'),
                    })
                    ->badge()
                    ->color('gray'),
                Tables\Columns\TextColumn::make('category.name')->label(__('admin.fields.category')),
                Tables\Columns\IconColumn::make('is_published')->label(__('admin.fields.is_published'))->boolean(),
                Tables\Columns\TextColumn::make('updated_at')->label(__('admin.fields.published_at'))->dateTime()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('language')
                    ->label(__('admin.fields.language'))
                    ->options(
                        array_combine(
                            app(LanguageService::class)->getAvailableLanguages(),
                            app(LanguageService::class)->getAvailableLanguages()
                        )
                    ),
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
