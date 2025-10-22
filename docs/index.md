# Limesurvey Module Documentation

## Overview
The Limesurvey module provides integration with the Limesurvey platform for advanced survey and questionnaire management. It enables seamless creation, distribution, and analysis of surveys within the Laraxot system.

## Key Features
- **Survey Integration**: Full integration with Limesurvey platform
- **Questionnaire Management**: Create and manage complex questionnaires
- **Response Collection**: Collect and store survey responses
- **Analysis Tools**: Analyze survey data and generate reports
- **User Management**: Manage survey participants and permissions
- **Data Export**: Export survey data in various formats

## Architecture
The module follows the Laraxot architecture principles:
- Extends Xot base classes
- Uses Filament for admin interface
- Implements proper service providers
- Follows DRY/KISS principles

## Core Components

### Models
- `Survey` - Survey definitions and configurations
- `Questionnaire` - Questionnaire structure and content
- `SurveyResponse` - Collected survey responses
- `SurveyParticipant` - Survey participants and permissions
- `Question` - Individual survey questions
- `AnswerOption` - Answer options for questions

### Resources
- `SurveyResource` - Survey management interface
- `QuestionnaireResource` - Questionnaire management
- `SurveyResponseResource` - Survey response management
- `SurveyParticipantResource` - Participant management
- `SurveyDashboard` - Survey analytics dashboard

### Services
- `LimesurveyService` - Core Limesurvey integration
- `SurveyManager` - Survey creation and management
- `ResponseCollector` - Survey response collection
- `AnalysisEngine` - Survey data analysis
- `ExportService` - Data export functionality

## Implementation Guide

### Basic Survey Integration
```php
// Initialize Limesurvey service
$limesurveyService = app(LimesurveyService::class);

// Create a new survey
$survey = $limesurveyService->createSurvey([
    'title' => 'Customer Satisfaction Survey',
    'description' => 'Survey to assess customer satisfaction',
    'language' => 'en',
]);

// Add questions to survey
$limesurveyService->addQuestion($survey->id, [
    'type' => 'L', // List dropdown
    'title' => 'satisfaction_level',
    'question' => 'How satisfied are you with our service?',
    'options' => [
        '1' => 'Very Satisfied',
        '2' => 'Satisfied',
        '3' => 'Neutral',
        '4' => 'Dissatisfied',
        '5' => 'Very Dissatisfied'
    ]
]);
```

### Survey Management
```php
// Manage survey lifecycle
$surveyManager = app(SurveyManager::class);

// Activate a survey
$surveyManager->activateSurvey($surveyId);

// Deactivate a survey
$surveyManager->deactivateSurvey($surveyId);

// Duplicate a survey
$duplicate = $surveyManager->duplicateSurvey($surveyId);

// Export survey structure
$surveyManager->exportSurvey($surveyId, 'json');
```

### Response Collection
```php
// Collect survey responses
$responseCollector = app(ResponseCollector::class);

// Submit survey response
$responseId = $responseCollector->submitResponse($surveyId, [
    'satisfaction_level' => '2',
    'comments' => 'The service was good overall.'
]);

// Validate responses
$validationResult = $responseCollector->validateResponse($surveyId, $responseData);
```

## Survey Types
1. **Single Choice**: Multiple choice with single answer
2. **Multiple Choice**: Multiple choice with multiple answers
3. **Text Input**: Free-form text responses
4. **Numeric Input**: Numeric value inputs
5. **Date/Time**: Date and time inputs
6. **Rating Scales**: Likert scales and star ratings
7. **Matrix Questions**: Matrix of related questions
8. **File Upload**: File attachment in responses

## Advanced Features

### Conditional Logic
```php
// Implement conditional question flow
$surveyManager->addConditionalLogic($surveyId, [
    'question_id' => 'satisfaction_level',
    'condition' => '==',
    'value' => '5', // Very Dissatisfied
    'show_next' => 'followup_questions'
]);

// Branching logic based on responses
$surveyManager->setBranchingLogic($surveyId, [
    'question_id' => 'age_group',
    'branches' => [
        ['condition' => '< 30', 'next' => 'young_users'],
        ['condition' => '>= 30 && < 60', 'next' => 'middle_aged'],
        ['condition' => '>= 60', 'next' => 'senior_users']
    ]
]);
```

### Survey Analysis
```php
// Analyze survey data
$analysisEngine = app(AnalysisEngine::class);

// Get response statistics
$stats = $analysisEngine->getResponseStatistics($surveyId);

// Analyze open-ended responses
$wordCloud = $analysisEngine->generateWordCloud($surveyId, 'comments');

// Cross-tabulation analysis
$crossTab = $analysisEngine->crossTabulate($surveyId, [
    'x_axis' => 'age_group',
    'y_axis' => 'satisfaction_level'
]);

// Statistical analysis
$summary = $analysisEngine->getStatisticalSummary($surveyId);
```

## Participant Management
1. **User Groups**: Organize participants into groups
2. **Permissions**: Control survey access and permissions
3. **Invitations**: Send survey invitations via email
4. **Reminders**: Automated reminder systems
5. **Anonymity**: Maintain participant anonymity when required

## Data Export Options
- **CSV Format**: Comma-separated values export
- **Excel Format**: XLS and XLSX file exports
- **JSON Format**: Structured data export
- **PDF Format**: Formatted reports in PDF
- **API Integration**: Real-time data access via API

## Performance Optimization
1. **Caching**: Cache survey structures and responses
2. **Pagination**: Paginate large datasets in dashboards
3. **Asynchronous Processing**: Process large surveys asynchronously
4. **Database Indexing**: Optimize database queries for survey data
5. **File Optimization**: Optimize file sizes for survey exports

## Best Practices
1. **Question Design**: Create clear, unbiased questions
2. **Survey Length**: Keep surveys concise and focused
3. **Mobile Optimization**: Ensure surveys work well on mobile devices
4. **Data Privacy**: Protect participant data and privacy
5. **Response Validation**: Implement proper response validation
6. **Pilot Testing**: Test surveys before full deployment
7. **Accessibility**: Ensure surveys are accessible to all users

## Related Modules
- [Xot Module](../Xot/docs/index.md) - Core base classes
- [User Module](../User/docs/README.md) - User authentication and management
- [Notify Module](../Notify/docs/index.md) - Notification system
- [Chart Module](../Chart/docs/index.md) - Data visualization

## Troubleshooting
Common issues and solutions:
- Limesurvey API connection problems
- Survey response data inconsistencies
- Performance issues with large surveys
- Participant access and permission problems
- Data export format issues