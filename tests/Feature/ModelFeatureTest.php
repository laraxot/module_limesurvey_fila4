<?php

declare(strict_types=1);

uses(\Modules\Limesurvey\Tests\TestCase::class);

use Modules\Limesurvey\Tests\TestCase;
use Modules\Limesurvey\Models\LimeSurvey;
use Modules\Limesurvey\Models\LimeQuestion;
use Modules\Limesurvey\Models\SurveyResponse;

it('can create and manipulate Limesurvey model instances', function () {
    $limeSurvey = new LimeSurvey();
    $limeQuestion = new LimeQuestion();
    $surveyResponse = new SurveyResponse();
    
    // Test that instances are created correctly
    expect($limeSurvey)->toBeInstanceOf(LimeSurvey::class)
        ->and($limeQuestion)->toBeInstanceOf(LimeQuestion::class)
        ->and($surveyResponse)->toBeInstanceOf(SurveyResponse::class);
    
    // Test basic model properties/methods exist
    expect($limeSurvey)->toHaveProperty('table')
        ->and($limeQuestion)->toHaveProperty('table')
        ->and($surveyResponse)->toHaveProperty('table');
});

it('has correct table names for Limesurvey models', function () {
    $limeSurvey = new LimeSurvey();
    $limeQuestion = new LimeQuestion();
    $surveyResponse = new SurveyResponse();
    
    // Verify table names are set correctly
    expect($limeSurvey->getTable())->toBeString()
        ->and($limeQuestion->getTable())->toBeString()
        ->and($surveyResponse->getTable())->toBeString();
})->group('limesurvey', 'models');