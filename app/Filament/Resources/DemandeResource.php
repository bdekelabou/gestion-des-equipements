<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Demande;
use Filament\Forms\Form;
use App\Enums\RolesEnums;
use App\Enums\EtapesEnums;
use App\Models\Equipement;
use Filament\Tables\Table;
use App\Models\BureauPoste;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\ButtonAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\DemandeResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DemandeResource\RelationManagers;

class DemandeResource extends Resource
{
    protected static ?string $model = Demande::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Grid::make(3)
                    ->schema([

                        Select::make('bureau_poste_id')
                            ->label('Bureau de poste')
                            ->searchable()
                            ->options(BureauPoste::pluck('nom', 'id'))
                            ->required()
                            ->native(false)
                            ->reactive()
                            ->disabled(fn() => auth()->user()->hasRole(RolesEnums::agent()->value) ? true : false)
                            ->dehydrated(false)
                            ->default(function () {

                                $user = auth()->user();

                                if ($user->hasRole(RolesEnums::agent()->value)) {
                                    return BureauPoste::find(auth()->user()->bureau_poste_id)->id;
                                }
                            }),


                        Select::make('equipement_id')
                            ->label("Equipement")
                            ->native(false)
                            ->options(function (callable $get) {

                                $user = auth()->user();

                                if ($user->hasRole(RolesEnums::Inormaticien()->value)) {
                                    return Equipement::where("bureau_poste_id", $get("bureau_poste_id"))->pluck("libelle", "id");
                                } elseif ($user->hasRole(RolesEnums::agent()->value)) {
                                    return Equipement::where("bureau_poste_id", auth()->user()->bureau_poste_id)->pluck('libelle', 'id');
                                }

                            })
                            ->required(),

                        Select::make('probleme_id')
                            ->required()
                            ->native(false)
                            ->relationship("problemes", "description")
                            ->preload()
                            ->multiple(),
                        
                        // Select::make('agent_traitant_id')
                        //     ->label('Agent traitant')
                        //     ->searchable()
                        //     ->options(fn() => \App\Models\User::whereHas('roles', function (Builder $query) {
                        //         $query->where('name', RolesEnums::Inormaticien()->value);
                        //     })->pluck('name', 'id'))
                        //     ->required()
                        //     ->native(false)
                        //     ->reactive()
                        //     ->disabled(fn() => auth()->user()->hasRole(RolesEnums::Inormaticien()->value) ? true : false)
                        //     ->dehydrated(false)
                        //     ->default(function () {

                        //         $user = auth()->user();

                        //         if ($user->hasRole(RolesEnums::Inormaticien()->value)) {
                        //             return auth()->user()->id;
                        //         }
                        //     }),
                    ]),


                MarkdownEditor::make("details")
                    ->columnSpanFull(),

                Hidden::make("etape")->default(function () {

                    $user = auth()->user();

                    if ($user->hasRole(RolesEnums::Inormaticien()->value)) {
                        return EtapesEnums::Equipement_receptionne()->value;
                    }

                    return EtapesEnums::Equipement_envoye()->value;
                }),
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

                TagsColumn::make("problemes.description")
                    ->label("Problèmes signalés"),

                TextColumn::make('etape')
                    ->label('Statut')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {

                        EtapesEnums::Equipement_envoye()->value => 'gray',
                        EtapesEnums::Equipement_receptionne()->value => 'blue',
                        EtapesEnums::Equipement_traite()->value => 'success',
                        EtapesEnums::Equipement_renvoye()->value => 'teal',
                        EtapesEnums::Cloture()->value => 'danger',
                    }),

                TextColumn::make("created_at")
                    ->label("Date de la demande")
                    ->badge()
                    ->date("d-m-Y"),
                
                TextColumn::make("date_traitement")
                    ->label("Date de réception (CI)")
                    ->badge()
                    ->color(Color::Gray)
                    ->placeholder("-")
                    ->date("d-m-Y"),

                TextColumn::make("date_renvoi")
                    ->label("Date du renvoi")
                    ->badge()
                    ->color(Color::Green)
                    ->placeholder("-")
                    ->date("d-m-Y"),

                TextColumn::make("date_reception")
                    ->label("Date de réception (bureau)")
                    ->badge()
                    ->color(Color::Blue)
                    ->placeholder("-")
                    ->date("d-m-Y"),

                TextColumn::make("assigned_to")
                    ->label("Agent traitant")
                    ->badge()
                    ->color(Color::Teal)
                    ->placeholder("-")
                    ->formatStateUsing(fn($state) => User::find($state)->name),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label("modifier")
                    ->visible(function ($record) {

                        if (
                            in_array($record->etape, [
                                $record->etape == EtapesEnums::Cloture()->value,
                                $record->etape == EtapesEnums::Equipement_renvoye()->value,
                                $record->etape == EtapesEnums::Equipement_receptionne()->value
                            ])
                        ) {
                            return false;
                        }
                        return true;
                    }),

                Action::make("Receptionner(CI)")
                    ->color(Color::Blue)
                    ->icon("heroicon-o-sun")
                    ->visible(function ($record) {

                        $recordState = $record->etape;

                        $user = auth()->user();

                        $allowEditStates = [
                            EtapesEnums::Equipement_envoye()->value,
                            // EtapesEnums::Equipement_receptionne()->value,
                            // EtapesEnums::Equipement_traite()->value,
                        ];

                        if ($user->hasRole(RolesEnums::Inormaticien()->value)) {

                            if (in_array($recordState, $allowEditStates)) {
                                return true;
                            }
                            return false;
                        }
                        return false;

                    })
                    ->form([
                                DatePicker::make("date_traitement")
                                    ->native(false)
                                    ->default(today())
                                    ])
                    ->action(function ($record ,$data) {

                        $record->update([

                    "etape" => EtapesEnums::Equipement_receptionne()->value,
                    "date_traitement" =>  $data["date_traitement"]
                        ]);

                        Notification::make("modifié")
                            ->body("Equipement Receptionner")
                            ->color(Color::Blue)
                            ->icon("heroicon-o-bell-alert")
                            ->send();

                    }),
                    
                Action::make("Renvoyer")
                    ->color(Color::Green)
                    ->icon("heroicon-o-sun")
                    ->action(function ($record) {

                        $record->update([

                            "etape" => EtapesEnums::Equipement_renvoye()->value,
                            "date_renvoi" => today()

                        ]);

                        Notification::make("modifié")
                            ->body("Equipement renvoyé")
                            ->color(Color::Green)
                            ->icon("heroicon-o-bell-alert")
                            ->send();

                    })
                    ->visible(function ($record) {

                        $recordState = $record->etape;

                        $user = auth()->user();

                        $allowEditStates = [
                            // EtapesEnums::Equipement_envoye()->value,
                            EtapesEnums::Equipement_receptionne()->value,
                            // EtapesEnums::Equipement_traite()->value,
                        ];

                        if ($user->hasRole(RolesEnums::Inormaticien()->value)) {

                            if (in_array($recordState, $allowEditStates)) {
                                return true;
                            }
                            return false;
                        }
                        return false;

                    }),

                Action::make("Réceptionner")
                    ->color(Color::Red)
                    ->icon("heroicon-o-arrows-pointing-in")
                    ->visible(function ($record) {

                        $user = auth()->user();

                        $userBureauID = auth()->user()->bureau_poste_id;

                        $equipementID = Equipement::find($record->equipement_id)->bureau_poste_id;

                        if ($record->etape == EtapesEnums::Equipement_renvoye()->value && $userBureauID == $equipementID && $user->hasRole(RolesEnums::agent()->value)) {
                            return true;
                        }

                        return false;
                    })
                    ->form([
                            DatePicker::make("date_reception")
                                ->native(false)
                                ->default(today())
                        ])
                    ->action(function ($record, $data) {
                        $record->update([

                            "etape" => EtapesEnums::Cloture()->value,
                            "date_reception" => $data["date_reception"]

                        ]);

                        Notification::make("modifié")
                            ->body("Equipement réceptionné")
                            ->color(Color::Green)
                            ->icon("heroicon-o-bell-alert")
                            ->send();
                    }),

                    Action::make('Assignation')
                        ->label('Assigner')
                        ->icon('heroicon-o-user-group')
                        ->color(Color::Blue)
                        ->action(function ($record, $data) {

                            $record->update([
                                'assigned_to' => $data['user_id'],
                                'etape' => EtapesEnums::Equipement_traite()->value,
                            ]);
                        })
                        ->color(Color::Blue)
                        ->form([ Select::make('user_id')
                                ->label('Assigner à un informaticien')
                                ->options(User::withRole(RolesEnums::inormaticien()->value)->pluck('name', 'id'))
                                ->required(),
                    ]) 
                    ->visible(function ($record) {

                        $recordState = $record->etape;

                        $user = auth()->user();

                        $allowEditStates = [
                            EtapesEnums::Equipement_envoye()->value,
                            // EtapesEnums::Equipement_receptionne()->value,
                            // EtapesEnums::Equipement_traite()->value,
                        ];

                        if ($user->hasRole(RolesEnums::Inormaticien()->value)) {

                            if (in_array($recordState, $allowEditStates)) {
                                return true;
                            }
                            return false;
                        }
                        return false;

                    }),
                    
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
