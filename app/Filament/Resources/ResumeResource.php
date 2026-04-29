<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResumeResource\Pages;
use App\Models\Resume;
use App\Services\LanguageService;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ResumeResource extends Resource
{
    protected static ?string $model = Resume::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';
    protected static ?int $navigationSort = 2;

    public static function getModelLabel(): string
    {
        return __('admin.resources.resume');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.resumes');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.resources.resumes');
    }

    public static function form(Schema $schema): Schema
    {
        $languages = app(LanguageService::class)->getAvailableLanguages();

        return $schema->components([
            \Filament\Schemas\Components\Tabs::make('ResumeTabs')
                ->columnSpanFull()
                ->tabs([
                    \Filament\Schemas\Components\Tabs\Tab::make(__('admin.sections.language_summary'))
                        ->icon('heroicon-m-language')
                        ->schema([
                            Forms\Components\Select::make('language')
                                ->label(__('admin.fields.language'))
                                ->required()
                                ->options(array_combine($languages, $languages))
                                ->native(false)
                                ->unique(Resume::class, 'language', ignoreRecord: true)
                                ->helperText(__('admin.fields.one_resume_per_language')),

                            Forms\Components\Toggle::make('is_active')
                                ->label(__('admin.fields.resume_active'))
                                ->default(true)
                                ->columnSpanFull(),

                            Forms\Components\Textarea::make('summary')
                                ->label(__('admin.fields.summary'))
                                ->rows(4)
                                ->columnSpanFull(),
                        ]),

                    \Filament\Schemas\Components\Tabs\Tab::make(__('admin.sections.experience'))
                        ->icon('heroicon-m-briefcase')
                        ->schema([
                            Forms\Components\Repeater::make('experience')
                                ->label(__('admin.sections.experience'))
                                ->schema([
                                    Forms\Components\TextInput::make('title')->required()->label(__('admin.fields.job_title')),
                                    Forms\Components\TextInput::make('company')->required()->label(__('admin.fields.company')),
                                    Forms\Components\TextInput::make('period')->required()->label(__('admin.fields.period')),
                                    Forms\Components\Textarea::make('description')->label(__('admin.fields.description'))->rows(2),
                                ])
                                ->columns(2)
                                ->columnSpanFull(),
                        ]),

                    \Filament\Schemas\Components\Tabs\Tab::make(__('admin.sections.education'))
                        ->icon('heroicon-m-academic-cap')
                        ->schema([
                            Forms\Components\Repeater::make('education')
                                ->label(__('admin.sections.education'))
                                ->schema([
                                    Forms\Components\TextInput::make('degree')->required()->label(__('admin.fields.degree')),
                                    Forms\Components\TextInput::make('institution')->required()->label(__('admin.fields.institution')),
                                    Forms\Components\TextInput::make('period')->required()->label(__('admin.fields.period')),
                                ])
                                ->columns(3)
                                ->columnSpanFull(),
                        ]),

                    \Filament\Schemas\Components\Tabs\Tab::make(__('admin.sections.skills'))
                        ->icon('heroicon-m-wrench-screwdriver')
                        ->schema([
                            Forms\Components\Repeater::make('skills')
                                ->label(__('admin.sections.skills'))
                                ->schema([
                                    Forms\Components\TextInput::make('name')
                                        ->required()
                                        ->label(__('admin.fields.name'))
                                        ->columnSpan(1),

                                    Forms\Components\Select::make('level')
                                        ->label(__('admin.fields.level'))
                                        ->options([
                                            'beginner'     => __('admin.fields.level_beginner'),
                                            'intermediate' => __('admin.fields.level_intermediate'),
                                            'advanced'     => __('admin.fields.level_advanced'),
                                            'expert'       => __('admin.fields.level_expert'),
                                        ])
                                        ->native(false)
                                        ->columnSpan(1),

                                    Forms\Components\Select::make('category')
                                        ->label(__('admin.fields.skill_category'))
                                        ->options(fn () => \App\Models\Category::where('type', 'skill')->pluck('name', 'slug')->toArray())
                                        ->native(false)
                                        ->columnSpan(1),

                                    Forms\Components\TextInput::make('icon')
                                        ->label(__('admin.fields.skill_icon'))
                                        ->placeholder(__('admin.placeholders.skill_icon_example'))
                                        ->helperText(__('admin.fields.skill_icon_helper'))
                                        ->columnSpan(1),

                                    Forms\Components\Toggle::make('show_on_homepage')
                                        ->label(__('admin.fields.show_on_homepage'))
                                        ->default(false)
                                        ->columnSpan(2),
                                ])
                                ->columns(2)
                                ->columnSpanFull(),
                        ]),

                    \Filament\Schemas\Components\Tabs\Tab::make(__('admin.sections.certifications'))
                        ->icon('heroicon-m-document-check')
                        ->schema([
                            Forms\Components\Repeater::make('certifications')
                                ->label(__('admin.sections.certifications'))
                                ->schema([
                                    Forms\Components\TextInput::make('name')->required()->label(__('admin.fields.name')),
                                    Forms\Components\TextInput::make('issuer')->label(__('admin.fields.issuer')),
                                    Forms\Components\TextInput::make('year')->label(__('admin.fields.year')),
                                    Forms\Components\Select::make('category')
                                        ->label(__('admin.fields.category'))
                                        ->options(fn () => \App\Models\Category::where('type', 'certification')->pluck('name', 'slug')->toArray())
                                        ->nullable()
                                        ->native(false),
                                ])
                                ->columns(2)
                                ->columnSpanFull(),
                        ]),

                    \Filament\Schemas\Components\Tabs\Tab::make('PDF')
                        ->icon('heroicon-m-document-arrow-down')
                        ->schema([
                            Forms\Components\FileUpload::make('pdf_path')
                                ->label(__('admin.fields.pdf_path'))
                                ->acceptedFileTypes(['application/pdf'])
                                ->directory('resumes')
                                ->disk('public')
                                ->columnSpanFull(),
                        ]),
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

                Tables\Columns\TextColumn::make('summary')
                    ->label(__('admin.fields.summary'))
                    ->limit(60),

                Tables\Columns\IconColumn::make('pdf_path')
                    ->label(__('admin.fields.has_pdf'))
                    ->boolean()
                    ->getStateUsing(fn ($record) => ! empty($record->pdf_path)),

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
            'index'  => Pages\ListResumes::route('/'),
            'create' => Pages\CreateResume::route('/create'),
            'edit'   => Pages\EditResume::route('/{record}/edit'),
        ];
    }
}
