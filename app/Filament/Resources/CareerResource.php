<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CareerResource\Pages;
use App\Filament\Resources\CareerResource\RelationManagers;
use App\Models\Career;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CareerResource extends Resource
{
    protected static ?string $model = Career::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->label('Title')->required()->maxLength(255),
                Forms\Components\Textarea::make('description')->label('Description')->rows(4),
                Forms\Components\TextInput::make('location')->label('Location')->maxLength(255),
                Forms\Components\Select::make('type')
                    ->label('Type')
                    ->options([
                        'full-time' => 'Full-time',
                        'part-time' => 'Part-time',
                        'contract' => 'Contract',
                        'internship' => 'Internship',
                    ])->default('full-time')->required(),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'open' => 'Open',
                        'closed' => 'Closed',
                    ])->default('open')->required(),
                Forms\Components\DatePicker::make('application_deadline')->label('Application Deadline'),
                Forms\Components\TextInput::make('contact_email')->label('Contact Email')->email()->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('title')->label('Title')->searchable(),
                Tables\Columns\TextColumn::make('location')->label('Location'),
                Tables\Columns\BadgeColumn::make('type')->label('Type'),
                Tables\Columns\BadgeColumn::make('status')->label('Status'),
                Tables\Columns\TextColumn::make('application_deadline')->label('Deadline')->date(),
                Tables\Columns\TextColumn::make('contact_email')->label('Contact Email'),
                Tables\Columns\TextColumn::make('created_at')->label('Created')->dateTime()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListCareers::route('/'),
            'create' => Pages\CreateCareer::route('/create'),
            'view' => Pages\ViewCareer::route('/{record}'),
            'edit' => Pages\EditCareer::route('/{record}/edit'),
        ];
    }
}
