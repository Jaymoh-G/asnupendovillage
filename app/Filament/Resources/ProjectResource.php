<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Main Content';
    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Project Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Project Name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                            ->label('Slug')
                            ->unique('projects', 'slug', fn($record) => $record)
                            ->maxLength(255)
                            ->helperText('Leave empty to auto-generate from project name'),
                        Forms\Components\Select::make('program_id')
                            ->label('Program')
                            ->options(\App\Models\Program::pluck('title', 'id'))
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\RichEditor::make('content')
                            ->label('Project Content')
                            ->required()
                            ->columnSpanFull()
                            ->helperText('Rich content with formatting, images, and attachments'),
                        Forms\Components\Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->rows(3)
                            ->maxLength(160)
                            ->helperText('SEO meta description (max 160 characters). This will be used for search engine results and social media sharing.'),
                        Forms\Components\FileUpload::make('images')
                            ->label('Project Images')
                            ->multiple()
                            ->image()
                            ->imageEditor()
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('800')
                            ->imageResizeTargetHeight('450')
                            ->directory('projects')
                            ->visibility('public')
                            ->maxSize(4096)
                            ->dehydrated(false)
                            ->helperText('Upload multiple images for the project. The first image will be used as the featured image.'),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'active' => 'Active',
                                'inactive' => 'Inactive',
                            ])
                            ->default('active')
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image_url')
                    ->label('Featured Image')
                    ->size(60)
                    ->openUrlInNewTab(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Project Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('content')
                    ->label('Content')
                    ->limit(100)
                    ->html()
                    ->searchable(),
                Tables\Columns\TextColumn::make('meta_description')
                    ->label('Meta Description')
                    ->limit(80)
                    ->searchable(),
                Tables\Columns\TextColumn::make('program.name')
                    ->label('Program')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('success'),
                Tables\Columns\TextColumn::make('image_count')
                    ->label('Images')
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn($record) => $record->status === 'active' ? 'success' : 'danger'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('program_id')
                    ->label('Program')
                    ->relationship('program', 'title'),
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ]),
                Tables\Filters\Filter::make('content')
                    ->form([
                        Forms\Components\TextInput::make('content_search')
                            ->label('Search in content')
                            ->placeholder('Search project content...')
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['content_search'],
                                fn(Builder $query, $search): Builder => $query->where('content', 'like', "%{$search}%")
                            );
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'slug', 'content', 'meta_description'];
    }

    public static function getGlobalSearchResultTitle(Model $record): string
    {
        return $record->name;
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Program' => $record->program->title ?? 'General',
            'Status' => ucfirst($record->status),
        ];
    }

    public static function getGlobalSearchResultUrl(Model $record): string
    {
        return static::getUrl('edit', ['record' => $record]);
    }

    public static function getGlobalSearchResultIcon(Model $record): string
    {
        return 'heroicon-o-briefcase';
    }

    public static function getGlobalSearchResultColor(Model $record): string
    {
        return $record->status === 'active' ? 'success' : 'danger';
    }

    public static function getGlobalSearchResultImage(Model $record): string
    {
        return $record->image_url ?? asset('assets/img/donation/donation-s-1-1.png');
    }

    public static function getGlobalSearchResultSubtitle(Model $record): string
    {
        return $record->program->title ?? 'General Program';
    }

    public static function getGlobalSearchResultDescription(Model $record): string
    {
        if ($record->meta_description) {
            return $record->meta_description;
        }
        return strip_tags($record->content);
    }

    public static function getGlobalSearchResultTags(Model $record): array
    {
        return [
            'status' => $record->status,
            'program' => $record->program->title ?? 'General',
        ];
    }

    public static function getGlobalSearchResultActions(Model $record): array
    {
        return [
            Tables\Actions\Action::make('view')
                ->label('View Project')
                ->url(static::getUrl('edit', ['record' => $record]))
                ->icon('heroicon-o-eye')
                ->color('primary'),
        ];
    }

    public static function getGlobalSearchResultBreadcrumbs(Model $record): array
    {
        return [
            'Projects' => static::getUrl(),
            $record->name => static::getUrl('edit', ['record' => $record]),
        ];
    }

    public static function getGlobalSearchResultGroup(Model $record): string
    {
        return 'Projects';
    }

    public static function getGlobalSearchResultSort(Model $record): int
    {
        return 0;
    }

    public static function getGlobalSearchResultWeight(Model $record): int
    {
        return 100;
    }

    public static function getGlobalSearchResultIsHidden(Model $record): bool
    {
        return $record->status === 'inactive';
    }

    public static function getGlobalSearchResultIsVisible(Model $record): bool
    {
        return $record->status === 'active';
    }

    public static function getGlobalSearchResultIsSearchable(Model $record): bool
    {
        return true;
    }

    public static function getGlobalSearchResultIsSelectable(Model $record): bool
    {
        return true;
    }

    public static function getGlobalSearchResultIsDeletable(Model $record): bool
    {
        return true;
    }

    public static function getGlobalSearchResultIsEditable(Model $record): bool
    {
        return true;
    }

    public static function getGlobalSearchResultIsViewable(Model $record): bool
    {
        return true;
    }

    public static function getGlobalSearchResultIsRestorable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsForceDeletable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsReplicable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsExportable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsImportable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsPrintable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsDownloadable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsShareable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsBookmarkable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsFavoritable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsLikeable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsCommentable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsRateable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsReviewable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsReportable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsFlaggable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsBlockable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsMuteable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsFollowable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsSubscribable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsNotifiable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsMentionable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsTaggable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsCategorizable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsSortable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsFilterable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsGroupable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsCountable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsSummable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsAverageable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsMinable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsMaxable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsMedianable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsModeable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsVarianceable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsStandardDeviationable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsRangeable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsPercentileable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsQuartileable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsDecileable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsHistogramable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsBoxplotable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsScatterplotable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsLinechartable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsBarchartable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsPiechartable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsDoughnutchartable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsRadarchartable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsPolarchartable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsBubblechartable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsAreachartable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsStackedchartable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsGroupedchartable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsWaterfallchartable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsFunnelchartable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsPyramidchartable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsConechartable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsCylinderchartable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsSpherechartable(Model $record): bool
    {
        return false;
    }

    public static function getGlobalSearchResultIsCubechartable(Model $record): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
