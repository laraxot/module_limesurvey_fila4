<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Filament\Resources\SurveyFlipResponseResource\Pages;

use Modules\Limesurvey\Filament\Resources\SurveyFlipResponseResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;

class EditSurveyFlipResponse extends XotBaseEditRecord
{
    protected static string $resource = SurveyFlipResponseResource::class;
}
