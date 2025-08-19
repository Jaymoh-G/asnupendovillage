<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    protected static ?string $navigationGroup = 'Settings & Users';

    protected static ?string $navigationLabel = 'Roles';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Role Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Role Name')
                            ->required()
                            ->maxLength(255)
                            ->unique('roles', 'name', function ($record) {
                                return $record;
                            })
                            ->placeholder('e.g., Editor, Admin, Super Admin'),

                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->maxLength(500)
                            ->placeholder('Brief description of this role\'s purpose'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Permissions')
                    ->description('Select the permissions this role should have')
                    ->schema([
                        Forms\Components\CheckboxList::make('permissions')
                            ->label('Permissions')
                            ->relationship('permissions', 'name')
                            ->options([
                                'view_content' => 'View Content',
                                'create_content' => 'Create Content',
                                'edit_content' => 'Edit Content',
                                'delete_content' => 'Delete Content',
                                'view_media' => 'View Media',
                                'create_media' => 'Create Media',
                                'edit_media' => 'Edit Media',
                                'delete_media' => 'Delete Media',
                                'view_users' => 'View Users',
                                'create_users' => 'Create Users',
                                'edit_users' => 'Edit Users',
                                'delete_users' => 'Delete Users',
                                'view_roles' => 'View Roles',
                                'create_roles' => 'Create Roles',
                                'edit_roles' => 'Edit Roles',
                                'delete_roles' => 'Delete Roles',
                                'view_settings' => 'View Settings',
                                'edit_settings' => 'Edit Settings',
                                'view_donations' => 'View Donations',
                                'edit_donations' => 'Edit Donations',
                                'delete_donations' => 'Delete Donations',
                                'access_filament' => 'Access Filament',
                                'manage_system' => 'Manage System',
                            ])
                            ->columns(3)
                            ->gridDirection('row')
                            ->searchable()
                            ->bulkToggleable()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        // Debug: Log user info when accessing roles table
        if (app()->environment('local') && Auth::check()) {
            $user = Auth::user();
            Log::info('RoleResource accessed by user: ' . $user->email . ' (ID: ' . $user->id . ')');
            Log::info('User roles: ' . $user->getRoleNames()->implode(', '));
        }

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Role Name')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(50)
                    ->searchable()
                    ->wrap(),

                Tables\Columns\TextColumn::make('permissions_count')
                    ->label('Permissions')
                    ->counts('permissions')
                    ->badge()
                    ->color('success'),

                Tables\Columns\TextColumn::make('users_count')
                    ->label('Users')
                    ->counts('users')
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('permissions')
                    ->label('Filter by Permission')
                    ->multiple()
                    ->relationship('permissions', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\Action::make('view_users')
                    ->label('View Users')
                    ->icon('heroicon-o-users')
                    ->color('info')
                    ->url(function (Role $record) {
                        return route('filament.admin.resources.users.index', ['filter[roles]' => $record->name]);
                    })
                    ->openUrlInNewTab()
                    ->visible(function (Role $record) {
                        return $record->users_count > 0;
                    }),

                Tables\Actions\EditAction::make()
                    ->color('primary'),

                Tables\Actions\DeleteAction::make()
                    ->color('danger')
                    ->visible(function (Role $record) {
                        return $record->name !== 'Super Admin' && $record->users_count === 0;
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
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->withCount(['permissions', 'users']);
    }
}
