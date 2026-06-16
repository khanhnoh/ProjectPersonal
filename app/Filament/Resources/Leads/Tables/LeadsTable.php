<?php
/**
 * Module: Lead & Scope Management (Module 1)
 * Feature: Leads table — pipeline view với SAP scope và deployment info
 */

namespace App\Filament\Resources\Leads\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LeadsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer_name')
                    ->label('Khách hàng')
                    ->searchable()
                    ->weight('bold'),

                TextColumn::make('company')
                    ->label('Công ty')
                    ->searchable(),

                TextColumn::make('industry')
                    ->label('Ngành')
                    ->formatStateUsing(fn ($state) => self::industryLabel($state))
                    ->badge()
                    ->color('gray'),

                TextColumn::make('sap_modules')
                    ->label('SAP Modules')
                    ->formatStateUsing(function ($state) {
                        if (empty($state)) return '—';
                        $modules = is_array($state) ? $state : json_decode($state, true) ?? [];
                        return implode(', ', $modules);
                    })
                    ->wrap(),

                TextColumn::make('deployment_type')
                    ->label('Deployment')
                    ->formatStateUsing(fn ($state) => self::deploymentLabel($state))
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'public_cloud'  => 'info',
                        'private_cloud' => 'warning',
                        'on_premise'    => 'gray',
                        'hybrid'        => 'success',
                        default         => 'gray',
                    }),

                TextColumn::make('status')
                    ->label('Pipeline')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'prospect'  => 'gray',
                        'qualified' => 'info',
                        'proposal'  => 'warning',
                        'won'       => 'success',
                        'lost'      => 'danger',
                        default     => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => ucfirst($state))
                    ->sortable(),

                TextColumn::make('legacy_erp')
                    ->label('Legacy ERP')
                    ->formatStateUsing(fn ($state) => self::legacyErpLabel($state))
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('annual_revenue')
                    ->label('Revenue')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->label('Pipeline Status')
                    ->options([
                        'prospect'  => 'Prospect',
                        'qualified' => 'Qualified',
                        'proposal'  => 'Proposal',
                        'won'       => 'Won',
                        'lost'      => 'Lost',
                    ]),
                SelectFilter::make('industry')
                    ->label('Ngành nghề')
                    ->options([
                        'manufacturing'  => 'Sản xuất',
                        'retail'         => 'Bán lẻ / Phân phối',
                        'chemical_pharma'=> 'Hóa chất / Dược phẩm',
                        'oil_gas'        => 'Dầu khí',
                        'construction'   => 'Xây dựng / EPC',
                        'financial'      => 'Tài chính / Ngân hàng',
                        'utilities'      => 'Tiện ích',
                        'public_sector'  => 'Nhà nước',
                        'healthcare'     => 'Y tế',
                        'fmcg'           => 'FMCG',
                        'logistics'      => 'Logistics',
                        'other'          => 'Khác',
                    ]),
                SelectFilter::make('deployment_type')
                    ->label('Deployment')
                    ->options([
                        'public_cloud'  => 'Public Cloud',
                        'private_cloud' => 'Private Cloud',
                        'on_premise'    => 'On-Premise',
                        'hybrid'        => 'Hybrid',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    private static function industryLabel(?string $state): string
    {
        return match ($state) {
            'manufacturing'   => 'Sản xuất',
            'retail'          => 'Bán lẻ / Phân phối',
            'chemical_pharma' => 'Hóa chất / Dược phẩm',
            'oil_gas'         => 'Dầu khí',
            'construction'    => 'Xây dựng / EPC',
            'financial'       => 'Tài chính',
            'utilities'       => 'Tiện ích',
            'public_sector'   => 'Nhà nước',
            'healthcare'      => 'Y tế',
            'fmcg'            => 'FMCG',
            'logistics'       => 'Logistics',
            default           => $state ?? '—',
        };
    }

    private static function deploymentLabel(?string $state): string
    {
        return match ($state) {
            'public_cloud'  => 'Public Cloud',
            'private_cloud' => 'Private Cloud',
            'on_premise'    => 'On-Premise',
            'hybrid'        => 'Hybrid',
            default         => $state ?? '—',
        };
    }

    private static function legacyErpLabel(?string $state): string
    {
        return match ($state) {
            'sap_ecc'     => 'SAP ECC / R3',
            'oracle_ebs'  => 'Oracle EBS',
            'ms_dynamics' => 'MS Dynamics',
            'bravo'       => 'Bravo ERP',
            'misa'        => 'MISA',
            'fast'        => 'Fast ERP',
            'inhouse'     => 'In-house',
            'none'        => 'Excel / Manual',
            default       => $state ?? '—',
        };
    }
}
