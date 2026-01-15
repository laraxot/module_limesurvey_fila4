<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Filament\Resources;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Modules\Limesurvey\Filament\Resources\SurveyFlipResponseResource\Pages\CreateSurveyFlipResponse;
use Modules\Limesurvey\Filament\Resources\SurveyFlipResponseResource\Pages\EditSurveyFlipResponse;
// Ensure this is still included for potential future use
use Modules\Limesurvey\Filament\Resources\SurveyFlipResponseResource\Pages\ListSurveyFlipResponses;
use Modules\Limesurvey\Models\SurveyFlipResponse;
use Modules\Xot\Filament\Resources\XotBaseResource;

class SurveyFlipResponseResource extends XotBaseResource
{
    protected static ?string $model = SurveyFlipResponse::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack'; // Updated navigation icon

    // protected static ?string $label = 'Survey Flip Response';
    // protected static ?string $pluralLabel = 'Survey Flip Responses';

    // protected static string $slug = 'survey-flip-responses';

    /**
     * @return array<string, TextInput|DateTimePicker>
     */
    public static function getFormSchema(): array
    {
        return [
            'survey_id' => TextInput::make('survey_id')
                ->required(),
            'token' => TextInput::make('token')
                ->required(),
            'answer' => TextInput::make('answer')
                ->required(),
            'value' => TextInput::make('value')
                ->required(),
            'submitdate' => DateTimePicker::make('submitdate')
                ->required(),
            'fieldname' => TextInput::make('fieldname')
                ->required(),
        ];
    }

    public static function getRelations(): array
    {
        return [

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSurveyFlipResponses::route('/'),
            'create' => CreateSurveyFlipResponse::route('/create'),
            'edit' => EditSurveyFlipResponse::route('/{record}/edit'),
        ];
    }
}
