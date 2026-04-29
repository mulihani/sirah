<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfileResource\Pages\CreateProfile;
use App\Filament\Resources\ProfileResource\Pages\EditProfile;
use App\Filament\Resources\ProfileResource\Pages\ListProfiles;
use App\Models\Profile;
use App\Services\LanguageService;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProfileResource extends Resource
{
    protected static ?string $model = Profile::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-circle';
    protected static ?int $navigationSort = 1;

    public static function getModelLabel(): string
    {
        return __('admin.resources.profile');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.profiles');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.resources.profiles');
    }

    public static function form(Schema $schema): Schema
    {
        $languages = app(LanguageService::class)->getAvailableLanguages();

        return $schema->components([

            // ─── Language ───────────────────────────────────────────────
            \Filament\Schemas\Components\Section::make(__('admin.sections.language_summary'))->schema([
                Forms\Components\Select::make('language')
                    ->label(__('admin.fields.language'))
                    ->required()
                    ->options(array_combine($languages, $languages))
                    ->native(false)
                    ->unique(Profile::class, 'language', ignoreRecord: true)
                    ->helperText(__('admin.fields.one_profile_per_language')),
            ]),

            // ─── Hero Section ─────────────────────────────────────────
            \Filament\Schemas\Components\Section::make(__('admin.sections.hero'))->schema([
                Forms\Components\TextInput::make('title')
                    ->label(__('admin.fields.owner_title'))
                    ->placeholder(__('admin.placeholders.owner_title_example'))
                    ->maxLength(255),

                Forms\Components\TextInput::make('hero_title')
                    ->label(__('admin.fields.hero_title'))
                    ->placeholder(__('admin.placeholders.hero_title_example'))
                    ->maxLength(255),

                Forms\Components\TextInput::make('hero_subtitle')
                    ->label(__('admin.fields.hero_subtitle'))
                    ->placeholder(__('admin.placeholders.hero_subtitle_example'))
                    ->maxLength(255),

                Forms\Components\FileUpload::make('profile_photo')
                    ->label(__('admin.fields.profile_photo'))
                    ->image()
                    ->directory('profiles/photos')
                    ->disk('public')
                    ->imageEditor()
                    ->columnSpanFull(),
            ])->columns(2),

            // ─── About Section ────────────────────────────────────────
            \Filament\Schemas\Components\Section::make(__('admin.sections.about'))->schema([
                Forms\Components\TextInput::make('about_title')
                    ->label(__('admin.fields.about_heading'))
                    ->placeholder(__('admin.placeholders.about_heading_example'))
                    ->maxLength(255),

                Forms\Components\Textarea::make('about_me')
                    ->label(__('admin.fields.about_me'))
                    ->rows(5)
                    ->columnSpanFull(),

                Forms\Components\FileUpload::make('about_photo')
                    ->label(__('admin.fields.about_photo'))
                    ->image()
                    ->directory('profiles/about')
                    ->disk('public')
                    ->imageEditor()
                    ->columnSpanFull(),
            ]),

            // ─── Stats Section ────────────────────────────────────────
            \Filament\Schemas\Components\Section::make(__('admin.sections.stats'))->schema([
                Forms\Components\Repeater::make('stats')
                    ->label(__('admin.sections.stats'))
                    ->schema([
                        Forms\Components\TextInput::make('value')
                            ->label(__('admin.fields.stat_value'))
                            ->required()
                            ->placeholder(__('admin.placeholders.stat_value_example')),
                        Forms\Components\TextInput::make('label')
                            ->label(__('admin.fields.stat_label'))
                            ->required()
                            ->placeholder(__('admin.placeholders.stat_label_example')),
                    ])
                    ->columns(2)
                    ->maxItems(6)
                    ->columnSpanFull(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('language')
                    ->label(__('admin.fields.language'))
                    ->badge()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('hero_title')
                    ->label(__('admin.fields.hero_title'))
                    ->limit(40),

                Tables\Columns\ImageColumn::make('profile_photo')
                    ->label(__('admin.fields.profile_photo'))
                    ->disk('public')
                    ->circular(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('admin.fields.published_at'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListProfiles::route('/'),
            'create' => CreateProfile::route('/create'),
            'edit'   => EditProfile::route('/{record}/edit'),
        ];
    }
}
