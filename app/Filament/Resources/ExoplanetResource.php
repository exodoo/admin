<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExoplanetResource\Pages;
use App\Filament\Resources\ExoplanetResource\RelationManagers;
use App\Models\Exoplanet;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExoplanetResource extends Resource
{
    protected static ?string $model = Exoplanet::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('star_id')
                    ->relationship('star', 'name')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('type')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('mass')
                    ->numeric(),
                Forms\Components\TextInput::make('radius')
                    ->numeric(),
                Forms\Components\TextInput::make('orbital_period')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('semi_major_axis'),
                Forms\Components\TextInput::make('eccentricity')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('temperature')
                    ->numeric(),
                Forms\Components\TextInput::make('gravity')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('density')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('habitability')
                    ->required(),
                Forms\Components\Textarea::make('surface_conditions')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('age')
                    ->numeric(),
                Forms\Components\TextInput::make('distance_from_earth')
                    ->numeric(),
                Forms\Components\TextInput::make('travel_time')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('discovered_method'),
                Forms\Components\TextInput::make('exoplanet_type'),
                Forms\Components\TextInput::make('planet_texture'),
                Forms\Components\TextInput::make('surface_photos'),
                Forms\Components\TextInput::make('locals_portrait'),
                Forms\Components\TextInput::make('flora_photos'),
                Forms\Components\TextInput::make('camp_photo'),
                Forms\Components\TextInput::make('background'),
            ]);
    }

    public static function table(Table $table): Table
    {
        $user = auth()->user();
        $actions = [];
        if ($user->isAdmin()) {
            $actions[] = Tables\Actions\EditAction::make();
        }
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('star.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mass')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('radius')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('orbital_period')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('semi_major_axis')
                    ->searchable(),
                Tables\Columns\TextColumn::make('eccentricity')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('temperature')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gravity')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('density')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('habitability')
                    ->boolean(),
                Tables\Columns\TextColumn::make('age')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('distance_from_earth')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('travel_time')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('discovered_method')
                    ->searchable(),
                Tables\Columns\TextColumn::make('exoplanet_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('planet_texture')
                    ->searchable(),
                Tables\Columns\TextColumn::make('surface_photos')
                    ->searchable(),
                Tables\Columns\TextColumn::make('locals_portrait')
                    ->searchable(),
                Tables\Columns\TextColumn::make('flora_photos')
                    ->searchable(),
                Tables\Columns\TextColumn::make('camp_photo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('background')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions($actions);
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
            'index' => Pages\ListExoplanets::route('/'),
            'create' => Pages\CreateExoplanet::route('/create'),
            'edit' => Pages\EditExoplanet::route('/{record}/edit'),
        ];
    }
}
