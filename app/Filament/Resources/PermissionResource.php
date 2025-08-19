<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PermissionResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Spatie\Permission\Models\Permission;

class PermissionResource extends Resource
{
    protected static ?string $model = Permission::class;

    protected static ?string $navigationIcon = 'heroicon-o-key';

    protected static ?string $navigationGroup = 'Settings & Users';

    protected static ?string $navigationLabel = 'Permissions';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Permission Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Permission Name')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->placeholder('e.g., view_content, create_users'),

                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->maxLength(500)
                            ->placeholder('Brief description of what this permission allows'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Role Assignments')
                    ->description('Roles that currently have this permission')
                    ->schema([
                        Forms\Components\Placeholder::make('roles_info')
                            ->content(function ($record) {
                                if (!$record || !$record->exists) {
                                    return 'Save the permission first to see role assignments.';
                                }

                                $roles = $record->roles;
                                if ($roles->count() === 0) {
                                    return 'No roles currently have this permission.';
                                }

                                $roleNames = $roles->pluck('name')->implode(', ');
                                return "Roles with this permission: {$roleNames}";
                            })
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Permission Name')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(50)
                    ->searchable()
                    ->wrap(),

                Tables\Columns\TextColumn::make('roles_count')
                    ->label('Roles')
                    ->counts('roles')
                    ->badge()
                    ->color('success'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('roles')
                    ->label('Filter by Role')
                    ->multiple()
                    ->relationship('roles', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\Action::make('view_roles')
                    ->label('View Roles')
                    ->icon('heroicon-o-shield-check')
                    ->color('info')
                    ->url(function (Permission $record): string {
                        return route('filament.admin.resources.roles.index', ['filter[permissions]' => $record->name]);
                    })
                    ->openUrlInNewTab()
                    ->visible(function (Permission $record): bool {
                        return $record->roles_count > 0;
                    }),

                Tables\Actions\EditAction::make()
                    ->color('primary'),

                Tables\Actions\DeleteAction::make()
                    ->color('danger')
                    ->visible(function (Permission $record): bool {
                        return $record->roles()->count() === 0;
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(function () {
                            return auth()->check() && auth()->user()->hasRole('Super Admin');
                        }),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListPermissions::route('/'),
            'create' => Pages\CreatePermission::route('/create'),
            'edit' => Pages\EditPermission::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->withCount('roles');
    }
}

