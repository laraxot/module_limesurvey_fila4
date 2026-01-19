<?php

declare(strict_types=1);

uses(\Modules\Limesurvey\Tests\TestCase::class);

use Modules\Limesurvey\Models\LimeSurvey;
use Modules\Limesurvey\Models\LimeQuestion;
use Modules\Limesurvey\Models\SurveyResponse;
use Modules\Limesurvey\Tests\TestCase;

it('has Limesurvey models that can be instantiated', function () {
    $limeSurvey = new LimeSurvey();
    $limeQuestion = new LimeQuestion();
    $surveyResponse = new SurveyResponse();
    
    expect($limeSurvey)->toBeInstanceOf(LimeSurvey::class)
        ->and($limeQuestion)->toBeInstanceOf(LimeQuestion::class)
        ->and($surveyResponse)->toBeInstanceOf(SurveyResponse::class);
})->group('limesurvey');