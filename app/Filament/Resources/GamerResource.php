<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GamerResource\Pages;
use App\Filament\Resources\GamerResource\RelationManagers;
use App\Models\Gamer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GamerResource extends Resource
{
    protected static ?string $model = Gamer::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube-transparent';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('username')
                    ->unique('gamers', 'username')
                    ->required(),
                Forms\Components\TextInput::make('name'),
                Forms\Components\TextInput::make('email')
                    ->nullable()
                    ->unique('gamers', 'email')
                    ->email(),
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
                Tables\Columns\TextColumn::make('username')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
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
            'index' => Pages\ListGamers::route('/'),
            'create' => Pages\CreateGamer::route('/create'),
            'edit' => Pages\EditGamer::route('/{record}/edit'),
        ];
    }
}
