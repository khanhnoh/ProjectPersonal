<?php
/**
 * Module: Lead & Scope Management (Module 1)
 * Feature: Lead form — customer profile, SAP scope matrix, deployment & pipeline
 */

namespace App\Filament\Resources\Leads\Schemas;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LeadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Customer Profile')
                ->description('Thông tin khách hàng và hệ thống ERP hiện tại')
                ->icon('heroicon-o-building-office-2')
                ->columns(2)
                ->components([
                    TextInput::make('customer_name')
                        ->label('Tên khách hàng')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('company')
                        ->label('Tên công ty')
                        ->maxLength(255),
                    Select::make('industry')
                        ->label('Ngành nghề')
                        ->options(self::industryOptions())
                        ->searchable()
                        ->native(false),
                    Select::make('annual_revenue')
                        ->label('Doanh thu hàng năm (ước tính)')
                        ->options([
                            'lt_50b'    => '< 50 tỷ VND',
                            '50b_200b'  => '50 – 200 tỷ VND',
                            '200b_500b' => '200 – 500 tỷ VND',
                            '500b_1t'   => '500 tỷ – 1 nghìn tỷ VND',
                            'gt_1t'     => '> 1 nghìn tỷ VND',
                        ])
                        ->native(false),
                    Select::make('legacy_erp')
                        ->label('ERP hiện tại (Legacy)')
                        ->options([
                            'sap_ecc'    => 'SAP ECC / R3',
                            'oracle_ebs' => 'Oracle EBS',
                            'ms_dynamics'=> 'Microsoft Dynamics',
                            'bravo'      => 'Bravo ERP',
                            'misa'       => 'MISA',
                            'fast'       => 'Fast ERP',
                            'inhouse'    => 'Tự phát triển (In-house)',
                            'none'       => 'Không có (Excel / Manual)',
                            'other'      => 'Khác',
                        ])
                        ->native(false),
                    Grid::make(2)->components([
                        TextInput::make('email')
                            ->label('Email liên hệ')
                            ->email(),
                        TextInput::make('phone')
                            ->label('Số điện thoại')
                            ->tel(),
                    ]),
                ]),

            Section::make('SAP Scope Matrix')
                ->description('Chọn các phân hệ SAP cần triển khai — xác định đội ngũ Presales phù hợp')
                ->icon('heroicon-o-squares-2x2')
                ->components([
                    CheckboxList::make('sap_modules')
                        ->label('')
                        ->options(self::sapModuleOptions())
                        ->columns(3)
                        ->gridDirection('row'),
                ]),

            Section::make('Pipeline & Hạ tầng')
                ->description('Trạng thái pipeline và hình thức triển khai')
                ->icon('heroicon-o-chart-bar')
                ->columns(2)
                ->components([
                    Select::make('status')
                        ->label('Trạng thái Pipeline')
                        ->options([
                            'prospect'  => '🔵 Prospect',
                            'qualified' => '🟡 Qualified',
                            'proposal'  => '🟠 Proposal',
                            'won'       => '🟢 Won',
                            'lost'      => '🔴 Lost',
                        ])
                        ->default('prospect')
                        ->required()
                        ->native(false),
                    Select::make('deployment_type')
                        ->label('Hình thức triển khai')
                        ->options([
                            'public_cloud'  => 'Public Cloud (RISE with SAP)',
                            'private_cloud' => 'Private Cloud',
                            'on_premise'    => 'On-Premise',
                            'hybrid'        => 'Hybrid',
                        ])
                        ->native(false),
                    Textarea::make('description')
                        ->label('Ghi chú')
                        ->rows(3)
                        ->columnSpanFull(),
                ]),

        ]);
    }

    private static function industryOptions(): array
    {
        return [
            'manufacturing'  => 'Sản xuất (Manufacturing)',
            'retail'         => 'Bán lẻ / Phân phối (Retail & Distribution)',
            'chemical_pharma'=> 'Hóa chất / Dược phẩm',
            'oil_gas'        => 'Dầu khí (Oil & Gas)',
            'construction'   => 'Xây dựng / EPC',
            'financial'      => 'Tài chính / Ngân hàng',
            'utilities'      => 'Tiện ích (Utilities)',
            'public_sector'  => 'Cơ quan Nhà nước',
            'healthcare'     => 'Y tế / Bệnh viện',
            'fmcg'           => 'Hàng tiêu dùng nhanh (FMCG)',
            'logistics'      => 'Logistics / Vận tải',
            'other'          => 'Khác',
        ];
    }

    private static function sapModuleOptions(): array
    {
        return [
            'FICO' => 'FICO — Finance & Controlling',
            'MM'   => 'MM — Materials Management',
            'SD'   => 'SD — Sales & Distribution',
            'PP'   => 'PP — Production Planning',
            'EWM'  => 'EWM / WM — Warehouse Management',
            'QM'   => 'QM — Quality Management',
            'PM'   => 'PM — Plant Maintenance',
            'HR'   => 'HR / HCM — Human Capital Management',
            'PS'   => 'PS — Project System',
            'SRM'  => 'SRM — Supplier Relationship Management',
            'CRM'  => 'CRM — Customer Relationship',
            'BW'   => 'BW / BI — Business Intelligence',
            'GTS'  => 'GTS — Global Trade Services',
        ];
    }
}
