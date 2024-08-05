<?php

namespace App\Filament\Resources;

use App\Enums\RolesEnums;
use Filament\Forms\Components;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Equipement;
use Filament\Tables\Table;
use App\Models\BureauPoste;
use App\Models\TypeEquipement;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EquipementResource\Pages;
use App\Filament\Resources\EquipementResource\RelationManagers;

class EquipementResource extends Resource
{
    protected static ?string $model = Equipement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('libelle')
                    ->label('Libelle de l\'équipement')
                    ->required(),

                Forms\Components\Select::make('type_equipement_id')
                    ->label('Type Equipement')
                    ->native(false)
                    ->options(TypeEquipement::pluck('libelle', 'id'))
                    ->required(),

                Forms\Components\Select::make('bureau_poste_id')
                    ->label('Bureau de poste')
                    ->native(false)
                    ->options(BureauPoste::pluck('nom', 'id'))
                    ->required()
                    ->disabled(fn() => auth()->user()->hasRole(RolesEnums::agent()->value)? true : false)
                    ->dehydrated()
                    ->default(function(){

                        $user =  auth()->user();

                        if($user->hasRole(RolesEnums::agent()->value))
                        {
                            return  BureauPoste::find(auth()->user()->bureau_poste_id)->id;
                        }
                    }) ,
            ]);
    }
 
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('libelle')
                    ->label('Nom de l\'équipement')
                    ->searchable()
                    ->sortable(),

                    Tables\Columns\TextColumn::make('type_equipement')
                    ->label('Type de l\'équipement')
                    ->searchable()
                    ->sortable(),
                    
                    
                Tables\Columns\TextColumn::make('nom_bureau')
                    ->label('Bureau de Poste')
                    ->searchable()
                    ->sortable()
                    ->visible(fn() => auth()->user()->hasRole(RolesEnums::Inormaticien()->value)? true : false),
                    
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEquipements::route('/'),
            'create' => Pages\CreateEquipement::route('/create'),
            'edit' => Pages\EditEquipement::route('/{record}/edit'),
        ];
    }
}
