<?php

namespace App\Filament\Resources\BANTAssessments;

use App\Filament\Resources\BANTAssessments\Pages\CreateBANTAssessment;
use App\Filament\Resources\BANTAssessments\Pages\EditBANTAssessment;
use App\Filament\Resources\BANTAssessments\Pages\ListBANTAssessments;
use App\Filament\Resources\BANTAssessments\Schemas\BANTAssessmentForm;
use App\Filament\Resources\BANTAssessments\Tables\BANTAssessmentsTable;
use App\Models\BANTAssessment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BANTAssessmentResource extends Resource
{
    protected static ?string $model = BANTAssessment::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-chart-bar';
    protected static string|\UnitEnum|null $navigationGroup = 'Step 1 · Lead & BANT';
    protected static ?string $navigationLabel = 'BANT Assessment';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return BANTAssessmentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BANTAssessmentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBANTAssessments::route('/'),
            'create' => CreateBANTAssessment::route('/create'),
            'edit' => EditBANTAssessment::route('/{record}/edit'),
        ];
    }
}
