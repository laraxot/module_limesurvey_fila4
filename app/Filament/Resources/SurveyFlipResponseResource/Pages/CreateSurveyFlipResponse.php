<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Filament\Resources\SurveyFlipResponseResource\Pages;

use Modules\Limesurvey\Filament\Resources\SurveyFlipResponseResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;

class CreateSurveyFlipResponse extends XotBaseCreateRecord
{
    protected static string $resource = SurveyFlipResponseResource::class;
}
