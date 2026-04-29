<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkResource\Pages;
use App\Models\Category;
use App\Models\Work;
use App\Services\LanguageService;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class WorkResource extends Resource
{
    protected static ?string $model = Work::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-briefcase';
    protected static ?int $navigationSort = 1;

    public static function getModelLabel(): string
    {
        return __('admin.resources.work');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.works');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.resources.works');
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

                Forms\Components\TextInput::make('slug')
                    ->label(__('admin.fields.slug'))
                    ->required()
                    ->maxLength(255)
                    ->unique(Work::class, 'slug', ignoreRecord: true),

                Forms\Components\Select::make('language')
                    ->label(__('admin.fields.language'))
                    ->required()
                    ->options(array_combine($languages, $languages))
                    ->native(false),

                Forms\Components\Select::make('category_id')
                    ->label(__('admin.fields.category'))
                    ->relationship('category', 'name', fn($query) => $query->where('type', 'work'))
                    ->searchable()
                    ->preload()
                    ->nullable(),

                Forms\Components\DateTimePicker::make('published_at')
                    ->label(__('admin.fields.published_at'))
                    ->nullable(),

                Forms\Components\TextInput::make('sort_order')
                    ->label(__('admin.fields.sort_order'))
                    ->numeric()
                    ->default(0),
            ])->columns(3),

            \Filament\Schemas\Components\Section::make(__('admin.sections.content'))->schema([
                Forms\Components\Builder::make('description')
                    ->label(__('admin.fields.description'))
                    ->blocks([
                        Forms\Components\Builder\Block::make('rich_text')
                            ->label(__('admin.fields.builder_rich_text'))
                            ->schema([
                                Forms\Components\RichEditor::make('content')
                                    ->label(__('admin.sections.content'))
                                    ->required(),
                            ]),
                        Forms\Components\Builder\Block::make('feature_grid')
                            ->label(__('admin.fields.builder_feature_grid'))
                            ->schema([
                                Forms\Components\Repeater::make('features')
                                    ->label(__('admin.fields.features'))
                                    ->schema([
                                        Forms\Components\TextInput::make('icon')->label(__('admin.fields.icon_class')),
                                        Forms\Components\TextInput::make('title')->label(__('admin.fields.title'))->required(),
                                        Forms\Components\Textarea::make('text')->label(__('admin.fields.description')),
                                    ])
                                    ->columns(3),
                            ]),
                        Forms\Components\Builder\Block::make('challenge_solution')
                            ->label(__('admin.fields.builder_challenge_solution'))
                            ->schema([
                                Forms\Components\RichEditor::make('challenge')->label(__('admin.fields.the_challenge')),
                                Forms\Components\RichEditor::make('solution')->label(__('admin.fields.the_solution')),
                            ])->columns(1),
                    ])
                    ->columnSpanFull(),
            ]),

            \Filament\Schemas\Components\Section::make(__('admin.sections.media'))->schema([
                Forms\Components\FileUpload::make('cover_image')
                    ->label(__('admin.fields.cover_image'))
                    ->image()
                    ->directory('works/covers')
                    ->disk('public')
                    ->columnSpanFull(),

                Forms\Components\Repeater::make('images')
                    ->label(__('admin.fields.gallery_images'))
                    ->relationship('images')
                    ->schema([
                        Forms\Components\FileUpload::make('path')
                            ->label(__('admin.fields.image'))
                            ->image()
                            ->directory('works/gallery')
                            ->disk('public')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('caption')
                            ->label(__('admin.fields.caption'))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('sort_order')
                            ->label(__('admin.fields.sort_order'))
                            ->numeric()
                            ->default(0),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('video_url')
                    ->label(__('admin.fields.video_url'))
                    ->url()
                    ->maxLength(500)
                    ->columnSpanFull(),
            ]),

            \Filament\Schemas\Components\Section::make(__('admin.sections.links'))->schema([
                Forms\Components\Repeater::make('links')
                    ->label(__('admin.sections.links'))
                    ->schema([
                        Forms\Components\TextInput::make('label')
                            ->label(__('admin.fields.label'))
                            ->required()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('url')
                            ->label(__('admin.fields.url'))
                            ->required()
                            ->url()
                            ->maxLength(500),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]),
        ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover_image')
                    ->label(__('admin.fields.cover_image'))
                    ->circular(),

                Tables\Columns\TextColumn::make('title')
                    ->label(__('admin.fields.title'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('language')
                    ->label(__('admin.fields.language'))
                    ->badge()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('category.name')
                    ->label(__('admin.fields.category'))
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_published')
                    ->label(__('admin.fields.is_published'))
                    ->boolean(),

                Tables\Columns\TextColumn::make('published_at')
                    ->label(__('admin.fields.published_at'))
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label(__('admin.fields.sort_order'))
                    ->sortable(),
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
            ])
            ->defaultSort('sort_order');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorks::route('/'),
            'create' => Pages\CreateWork::route('/create'),
            'edit' => Pages\EditWork::route('/{record}/edit'),
        ];
    }
}
