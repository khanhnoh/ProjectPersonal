<?php
/**
 * Module: Dashboard
 * Feature: Custom 4-column dashboard với welcome header và pipeline summary
 */

namespace App\Filament\Pages;

use App\Models\Lead;

class Dashboard extends \Filament\Pages\Dashboard
{
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-home';

    protected static ?string $title = 'Dashboard';

    public function getHeading(): string
    {
        $name = auth()->user()?->name ?? 'Admin';

        return "Welcome, {$name}";
    }

    public function getSubheading(): ?string
    {
        $active   = Lead::whereIn('status', ['qualified', 'proposal'])->count();
        $prospect = Lead::where('status', 'prospect')->count();

        return "Pipeline: {$active} deals đang active · {$prospect} prospects chờ BANT assessment";
    }

    public function getColumns(): int | array
    {
        return [
            'default' => 1,
            'md'      => 2,
            'xl'      => 4,
        ];
    }
}
