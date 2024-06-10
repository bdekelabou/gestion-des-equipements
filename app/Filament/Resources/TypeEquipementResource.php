<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TypeEquipementResource\Pages;
use App\Filament\Resources\TypeEquipementResource\RelationManagers;
use App\Models\TypeEquipement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TypeEquipementResource extends Resource
{
    protected static ?string $model = TypeEquipement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('libelle')
                ->required()
                ->maxLength(255),
                
            ]);
    }

    
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('libelle'),
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
            'index' => Pages\ListTypeEquipements::route('/'),
            'create' => Pages\CreateTypeEquipement::route('/create'),
            'edit' => Pages\EditTypeEquipement::route('/{record}/edit'),
        ];
    }
}
