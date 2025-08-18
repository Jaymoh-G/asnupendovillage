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

    protected static ?string $navigationGroup = 'Media Centre';

    protected static ?string $navigationLabel = 'Careers';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->label('Short Description')
                    ->rows(3)
                    ->maxLength(500)
                    ->helperText('A brief summary of the position (max 500 characters)'),

                Forms\Components\RichEditor::make('content')
                    ->label('Detailed Content')
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'strike',
                        'link',
                        'bulletList',
                        'orderedList',
                        'h2',
                        'h3',
                        'h4',
                        'blockquote',
                        'codeBlock',
                    ])
                    ->columnSpanFull()
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('careers/content')
                    ->fileAttachmentsVisibility('public')
                    ->helperText('Detailed job description with formatting options'),

                Forms\Components\FileUpload::make('pdf_file')
                    ->label('Job Description PDF')
                    ->acceptedFileTypes(['application/pdf'])
                    ->maxSize(4096) // 4MB
                    ->helperText('Upload a PDF file for the complete job description (max 4MB)')
                    ->directory('careers')
                    ->visibility('public'),

                Forms\Components\Select::make('type')
                    ->label('Employment Type')
                    ->options([
                        'full-time' => 'Full-time',
                        'part-time' => 'Part-time',
                        'contract' => 'Contract',
                        'internship' => 'Internship',
                    ])
                    ->default('full-time')
                    ->required(),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'open' => 'Open',
                        'closed' => 'Closed',
                    ])
                    ->default('open')
                    ->required(),

                Forms\Components\DatePicker::make('application_deadline')
                    ->label('Application Deadline')
                    ->helperText('Set the deadline for applications'),

                Forms\Components\TextInput::make('contact_email')
                    ->label('Contact Email')
                    ->email()
                    ->maxLength(255)
                    ->helperText('Email address for job inquiries'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->toggleable(true),

                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->color(function (string $state): string {
                        if ($state === 'full-time') return 'success';
                        if ($state === 'part-time') return 'info';
                        if ($state === 'contract') return 'warning';
                        if ($state === 'internship') return 'primary';
                        return 'gray';
                    }),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(function (string $state): string {
                        if ($state === 'open') return 'success';
                        if ($state === 'closed') return 'danger';
                        return 'gray';
                    }),

                Tables\Columns\TextColumn::make('application_deadline')
                    ->label('Deadline')
                    ->date()
                    ->sortable()
                    ->color(function ($record) {
                        if (!$record->application_deadline) return 'gray';

                        $deadline = \Carbon\Carbon::parse($record->application_deadline);
                        return $deadline->isPast() ? 'danger' : 'success';
                    }),

                Tables\Columns\TextColumn::make('contact_email')
                    ->label('Contact Email')
                    ->searchable(),

                Tables\Columns\IconColumn::make('pdf_file')
                    ->label('PDF')
                    ->boolean()
                    ->trueIcon('heroicon-o-document-text')
                    ->falseIcon('heroicon-o-minus')
                    ->trueColor('success')
                    ->falseColor('gray'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Employment Type')
                    ->options([
                        'full-time' => 'Full-time',
                        'part-time' => 'Part-time',
                        'contract' => 'Contract',
                        'internship' => 'Internship',
                    ]),

                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'open' => 'Open',
                        'closed' => 'Closed',
                    ]),
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
            'edit' => Pages\EditCareer::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
