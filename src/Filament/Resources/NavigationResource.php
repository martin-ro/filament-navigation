<?php

namespace RyanChandler\FilamentNavigation\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use RyanChandler\FilamentNavigation\FilamentNavigation;

class NavigationResource extends Resource
{
    use Translatable;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3';

    private static ?string $workNavigationLabel = null;

    private static ?string $workPluralLabel = null;

    private static ?string $workLabel = null;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__('filament-navigation::filament-navigation.attributes.name'))
                            ->reactive()
                            ->debounce()
                            ->afterStateUpdated(function (?string $state, Set $set) {
                                if (! $state) {
                                    return;
                                }

                                $set('handle', Str::slug($state));
                            })
                            ->required(),

                        Forms\Components\TextInput::make('handle')
                            ->label(__('filament-navigation::filament-navigation.attributes.handle'))
                            ->required()
                            ->unique(column: 'handle', ignoreRecord: true),
                    ]),

                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\ViewField::make('items')
                            ->label(__('filament-navigation::filament-navigation.attributes.items'))
                            ->default([])
                            ->columnSpanFull()
                            ->view('filament-navigation::navigation-builder'),
                    ]),
            ]);
    }

    public static function navigationLabel(?string $string): void
    {
        self::$workNavigationLabel = $string;
    }

    public static function pluralLabel(?string $string): void
    {
        self::$workPluralLabel = $string;
    }

    public static function label(?string $string): void
    {
        self::$workLabel = $string;
    }

    public static function getNavigationLabel(): string
    {
        return self::$workNavigationLabel ?? parent::getNavigationLabel();
    }

    public static function getModelLabel(): string
    {
        return self::$workLabel ?? parent::getModelLabel();
    }

    public static function getPluralModelLabel(): string
    {
        return self::$workPluralLabel ?? parent::getPluralModelLabel();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament-navigation::filament-navigation.attributes.name'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('handle')
                    ->label(__('filament-navigation::filament-navigation.attributes.handle'))
                    ->searchable(),
            ])
            ->actions([
                EditAction::make()
                    ->icon(null),

                DeleteAction::make()
                    ->icon(null),
            ])
            ->filters([

            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => NavigationResource\Pages\ListNavigations::route('/'),
            'create' => NavigationResource\Pages\CreateNavigation::route('/create'),
            'edit' => NavigationResource\Pages\EditNavigation::route('/{record}'),
        ];
    }

    public static function getModel(): string
    {
        return FilamentNavigation::get()->getModel();
    }
}
