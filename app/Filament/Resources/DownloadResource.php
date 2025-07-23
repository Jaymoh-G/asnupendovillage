<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DownloadResource\Pages;
use App\Filament\Resources\DownloadResource\RelationManagers;
use App\Models\Download;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DownloadResource extends Resource
{
    protected static ?string $model = Download::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Media Centre';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->label('Title')->required()->maxLength(255),
                Forms\Components\Textarea::make('description')->label('Description')->rows(3),
                Forms\Components\Select::make('program_id')
                    ->label('Program')
                    ->relationship('program', 'title')
                    ->searchable()
                    ->preload(),
                Forms\Components\FileUpload::make('file_path')
                    ->label('File')
                    ->directory('downloads')
                    ->disk('public')
                    ->maxSize(4096) // 4MB in KB
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ])->default('active')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('title')->label('Title')->searchable(),
                Tables\Columns\TextColumn::make('program.title')->label('Program'),
                Tables\Columns\TextColumn::make('file_size')->label('Size')->formatStateUsing(fn($state) => $state ? number_format($state / 1024, 2) . ' KB' : 'N/A'),
                Tables\Columns\BadgeColumn::make('status')->label('Status'),
                Tables\Columns\TextColumn::make('created_at')->label('Created')->dateTime()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('view_file')
                    ->label('View')
                    ->icon('heroicon-o-eye')
                    ->url(fn($record) => $record->file_path ? asset('storage/' . $record->file_path) : '#')
                    ->openUrlInNewTab(),
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
            'index' => Pages\ListDownloads::route('/'),
            'create' => Pages\CreateDownload::route('/create'),
            'view' => Pages\ViewDownload::route('/{record}'),
            'edit' => Pages\EditDownload::route('/{record}/edit'),
        ];
    }
}
