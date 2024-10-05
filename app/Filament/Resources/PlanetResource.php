<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlanetResource\Pages;
use App\Filament\Resources\PlanetResource\RelationManagers;
use App\Models\Enums\PlanetType;
use App\Models\Planet;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlanetResource extends Resource
{
    protected static ?string $model = Planet::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->maxLength(255)
                    ->required(),
                Forms\Components\Select::make('type')
                    ->options(PlanetType::options())
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('mass')
                    ->numeric(),
                Forms\Components\TextInput::make('radius')
                    ->numeric(),
                Forms\Components\TextInput::make('orbital_period')
                    ->numeric(),
                Forms\Components\TextInput::make('semi_major_axis')
                    ->numeric(),
                Forms\Components\TextInput::make('eccentricity')
                    ->numeric(),
                Forms\Components\TextInput::make('temperature')
                    ->numeric(),
                Forms\Components\TextInput::make('gravity')
                    ->numeric(),
                Forms\Components\TextInput::make('density')
                    ->numeric(),
                Forms\Components\Toggle::make('habitability'),
                Forms\Components\Textarea::make('surface_conditions')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('age')
                    ->numeric(),
                Forms\Components\TextInput::make('distance_from_earth')
                    ->numeric(),
                Forms\Components\TextInput::make('travel_time')
                    ->numeric(),
                Forms\Components\TextInput::make('discovered_method'),
                Forms\Components\FileUpload::make('image')
                    ->image(),
                Forms\Components\TextInput::make('planet_texture'),
                Forms\Components\TextInput::make('locals_portrait'),
                Forms\Components\TextInput::make('flora_photos'),
                Forms\Components\TextInput::make('camp_photo'),
                Forms\Components\Textarea::make('surface_photos')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('sky_photo')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
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
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('semi_major_axis')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('eccentricity')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('temperature')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gravity')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('density')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('habitability')
                    ->boolean()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('age')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('distance_from_earth')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('travel_time')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('discovered_method')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ImageColumn::make('image')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            ->actions([
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
            'index' => Pages\ListPlanets::route('/'),
            'create' => Pages\CreatePlanet::route('/create'),
            'edit' => Pages\EditPlanet::route('/{record}/edit'),
        ];
    }
}
