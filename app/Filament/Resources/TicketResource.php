<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketResource\Pages;
use App\Filament\Resources\TicketResource\Widgets\TicketStatsOverview;
use App\Models\Ticket;
use BackedEnum;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-ticket';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Incident Details')
                    ->schema([
                        TextInput::make('title')
                            ->searchable()
                            ->required()
                            ->maxLength(255),
                        Select::make('type')
                            ->options([
                                'Hardware' => 'Hardware',
                                'Software' => 'Software',
                                'Network' => 'Network',
                                'Security' => 'Security',
                                'Other' => 'Other',
                            ])
                            ->searchable()
                            ->required(),
                        Select::make('priority')
                            ->options([
                                'Low' => 'Low',
                                'Medium' => 'Medium',
                                'High' => 'High',
                                'Critical' => 'Critical',
                            ])
                            ->searchable()
                            ->required(),
                        DateTimePicker::make('incident_date')
                            ->searchable()
                            ->required(),
                        RichEditor::make('description')
                            ->required()
                            ->columnSpanFull(),
                        FileUpload::make('attachments')
                            ->multiple()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('Status & Assignment')
                    ->schema([
                        Select::make('status')
                            ->options([
                                'Open' => 'Open',
                                'In Progress' => 'In Progress',
                                'On Hold' => 'On Hold',
                                'Resolved' => 'Resolved',
                                'Closed' => 'Closed',
                            ])
                            ->default('Open')
                            ->required(),
                        Select::make('assigned_to')
                            ->relationship('assignedTo', 'name')
                            ->searchable()
                            ->preload(),
                        Select::make('reported_by')
                            ->relationship('reportedBy', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        RichEditor::make('solution')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Resolved' => 'success',
                        'Closed' => 'gray',
                        'In Progress' => 'info',
                        'On Hold' => 'warning',
                        'Open' => 'danger',
                        default => 'gray',
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        'Resolved', 'Completed' => 'heroicon-m-check-circle',
                        'Closed' => 'heroicon-m-lock-closed',
                        'In Progress', 'Active' => 'heroicon-m-play',
                        'On Hold' => 'heroicon-m-pause',
                        'Open' => 'heroicon-m-exclamation-circle',
                        'Cancelled' => 'heroicon-m-x-mark',
                        default => 'heroicon-m-question-mark-circle',
                    })
                    ->sortable(),
                TextColumn::make('priority')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Critical' => 'danger',
                        'High' => 'warning',
                        'Medium' => 'info',
                        'Low' => 'success',
                        default => 'gray',
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        'Critical' => 'heroicon-m-fire',
                        'High' => 'heroicon-o-chevron-up',
                        'Medium' => 'heroicon-o-minus',
                        'Low' => 'heroicon-o-chevron-down',
                        default => 'heroicon-o-question-mark-circle',
                    })
                    ->sortable(),
                TextColumn::make('incident_date')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('assignedTo.name')
                    ->label('Assigned To')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('reportedBy.name')
                    ->label('Reported By')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('priority')
                    ->options([
                        'Low' => 'Low',
                        'Medium' => 'Medium',
                        'High' => 'High',
                        'Critical' => 'Critical',
                    ]),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getWidgets(): array
    {
        return [
            TicketStatsOverview::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}
