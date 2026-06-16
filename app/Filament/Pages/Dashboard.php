<?php
/**
 * Module: Dashboard
 * Feature: Custom 4-column dashboard grid overriding Filament default
 */

namespace App\Filament\Pages;

class Dashboard extends \Filament\Pages\Dashboard
{
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-home';

    protected static ?string $title = 'SAP Sales Hub';

    public function getColumns(): int | array
    {
        return [
            'default' => 1,
            'md'      => 2,
            'xl'      => 4,
        ]; // Responsive: mobile 1-col, tablet 2-col, desktop 4-col
    }
}
