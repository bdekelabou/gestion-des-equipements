<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Demande;
use Filament\Forms\Form;
use App\Models\Equipement;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\DemandeResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DemandeResource\RelationManagers;
use Filament\Tables\Columns\TextColumn;

class DemandeResource extends Resource
{
    protected static ?string $model = Demande::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('equipement_id')
                    ->options(Equipement::where("bureau_poste_id", auth()->user()->bureau_poste_id)->pluck('libelle', 'id'))
                    ->required(),   

                    Select::make('probleme_id')
                    ->relationship("problemes", "description")
                    ->preload()
                    ->multiple(), 

                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('libelle')
                    ->label('Equipement')
                    ->searchable()
                    ->sortable(),

TextColumn::make('bureau_poste')
                    ->label('Bureau')
                    ->searchable()
                    ->sortable(),
                    
                    
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
            'index' => Pages\ListDemandes::route('/'),
            'create' => Pages\CreateDemande::route('/create'),
            'edit' => Pages\EditDemande::route('/{record}/edit'),
        ];
    }
}
