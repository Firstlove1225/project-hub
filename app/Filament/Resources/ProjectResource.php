<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $label = 'โปรเจกต์';

    protected static ?string $pluralLabel = 'โปรเจกต์ทั้งหมด';

    protected static ?string $navigationLabel = 'โปรเจกต์';

    protected static ?string $navigationGroup = 'การจัดการโปรเจกต์';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('ข้อมูลโปรเจกต์')
                    ->description('กรอกรายละเอียดเกี่ยวกับโปรเจกต์ของคุณ')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('ชื่อโปรเจกต์')
                            ->placeholder('เช่น เว็บแอปพลิเคชันจัดการโปรเจกต์')
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->label('ชื่อ URL (Slug)')
                            ->placeholder('เช่น web-app-project-management')
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->label('สถานะ')
                            ->options([
                                'draft' => 'ฉบับร่าง',
                                'in_progress' => 'กำลังพัฒนา',
                                'completed' => 'เสร็จสมบูรณ์',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('description')
                            ->label('รายละเอียด')
                            ->placeholder('อธิบายเกี่ยวกับโปรเจกต์นี้โดยละเอียด')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('repository_link')
                            ->label('ลิงก์ Repository')
                            ->placeholder('เช่น https://github.com/your-username/your-project')
                            ->url()
                            ->suffixIcon('heroicon-m-link'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('ชื่อโปรเจกต์')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('สถานะ')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'draft' => 'gray',
                        'in_progress' => 'warning',
                        'completed' => 'success',
                    })
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('repository_link')
                    ->label('ลิงก์ Repository')
                    ->url(fn(Project $record): ?string => $record->repository_link)
                    ->openUrlInNewTab()
                    ->icon('heroicon-m-link')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('วันที่สร้าง')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('สถานะ')
                    ->options([
                        'draft' => 'ฉบับร่าง',
                        'in_progress' => 'กำลังพัฒนา',
                        'completed' => 'เสร็จสมบูรณ์',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('แก้ไข'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('ลบที่เลือก'),
                ]),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('สร้างโปรเจกต์ใหม่'),
            ]);
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
            'index' => Pages\ListProjects::route('/'), // รายการโปรเจกต์
            'create' => Pages\CreateProject::route('/create'), // สร้างโปรเจกต์ใหม่
            'edit' => Pages\EditProject::route('/{record}/edit'), // แก้ไขโปรเจกต์
        ];
    }
}
