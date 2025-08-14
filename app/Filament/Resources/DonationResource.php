<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DonationResource\Pages;
use App\Filament\Resources\DonationResource\RelationManagers;
use App\Models\Donation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DonationResource extends Resource
{
    protected static ?string $model = Donation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Main Content';

    protected static ?string $navigationLabel = 'Donations';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('donor_name')->label('Donor Name')->maxLength(255),
                Forms\Components\TextInput::make('donor_email')->label('Donor Email')->email()->maxLength(255),
                Forms\Components\TextInput::make('donor_phone')->label('Donor Phone')->maxLength(30),
                Forms\Components\TextInput::make('amount')->label('Amount')->numeric()->required(),
                Forms\Components\TextInput::make('currency')->label('Currency')->maxLength(10)->default('KES'),
                Forms\Components\Select::make('payment_method')
                    ->label('Payment Method')
                    ->options([
                        'mpesa' => 'M-Pesa',
                        'card' => 'Card',
                        'paypal' => 'PayPal',
                        'bank' => 'Bank Transfer',
                        'other' => 'Other',
                    ])->required(),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                        'cancelled' => 'Cancelled',
                    ])->required(),
                Forms\Components\TextInput::make('transaction_reference')->label('Transaction Reference')->maxLength(255),
                Forms\Components\Textarea::make('meta')->label('Meta (JSON)')->rows(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('donor_name')->label('Donor Name')->searchable(),
                Tables\Columns\TextColumn::make('donor_email')->label('Donor Email')->searchable(),
                Tables\Columns\TextColumn::make('amount')->label('Amount')->sortable(),
                Tables\Columns\TextColumn::make('currency')->label('Currency'),
                Tables\Columns\BadgeColumn::make('payment_method')->label('Payment Method'),
                Tables\Columns\BadgeColumn::make('status')->label('Status'),
                Tables\Columns\TextColumn::make('transaction_reference')->label('Transaction Ref'),
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
            'index' => Pages\ListDonations::route('/'),
            'create' => Pages\CreateDonation::route('/create'),
            'edit' => Pages\EditDonation::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
