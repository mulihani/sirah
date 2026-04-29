<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Page;
use App\Models\Resume;
use App\Models\Work;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make(__('admin.widgets.stats.published_projects'), Work::count())
                ->description(__('admin.widgets.stats.published_projects_desc'))
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('primary'),

            Stat::make(__('admin.widgets.stats.categories'), Category::count())
                ->description(__('admin.widgets.stats.categories_desc'))
                ->descriptionIcon('heroicon-m-rectangle-group')
                ->color('success'),

            Stat::make(__('admin.widgets.stats.resume_elements'), Resume::count())
                ->description(__('admin.widgets.stats.resume_elements_desc'))
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('warning'),

            Stat::make(__('admin.widgets.stats.pages'), Page::count())
                ->description(__('admin.widgets.stats.pages_desc'))
                ->descriptionIcon('heroicon-m-document-text')
                ->color('info'),
        ];
    }
}
