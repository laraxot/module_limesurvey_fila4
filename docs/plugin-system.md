# LimeSurvey Plugin System

## Overview
LimeSurvey features a robust plugin system that allows extending functionality through event-driven hooks. This system enables customization without modifying the core LimeSurvey codebase.

## Plugin Architecture

### Plugin Interface
All LimeSurvey plugins must implement the `iPlugin` interface and typically extend the `PluginBase` class.

### Event-Driven Hooks
Plugins subscribe to LimeSurvey events in their `init()` method:

```php
public function init() {
    $this->subscribe('beforeSurveySettings');
    $this->subscribe('newDirectRequest');
    $this->subscribe('afterSurveyComplete');
}
```

## Key Events for Integration

### Survey Lifecycle Events
- `beforeSurveySettings`: Called before displaying survey settings page
- `afterSurveyComplete`: Called when a response is saved - **Ideal for Real-time ETL**
- `beforeTokenEmail`: Modify emails sent to participants
- `newDirectRequest`: Handle custom URL requests

### Question/Group Events
- `beforeQuestionRender`: Modify question rendering
- `beforeGroupRender`: Modify group rendering
- `beforeSurveyRender`: Modify survey rendering

### Authentication Events
- `beforeLogin`: Custom authentication logic
- `afterLogin`: Actions after successful login
- `beforeLogout`: Actions before logout

### Data Events
- `model.survey.beforeSave`: Before survey is saved
- `model.survey.afterSave`: After survey is saved
- `model.question.beforeSave`: Before question is saved
- `model.token.beforeSave`: Before token is saved

## Integration with Quaeris

### Real-time Sync Plugin
For immediate synchronization of LimeSurvey data to Quaeris, we can create a LimeSurvey plugin that triggers on `afterSurveyComplete`:

```php
class QuaerisHook extends PluginBase
{
    protected $storage = 'DbStorage';
    
    public function init()
    {
        $this->subscribe('afterSurveyComplete');
    }
    
    public function afterSurveyComplete()
    {
        $event = $this->getEvent();
        $surveyId = $event->get('surveyId');
        $responseId = $event->get('responseId');
        
        // Dispatch job to process new response
        ProcessNewResponseJob::dispatch($surveyId, $responseId);
    }
}
```

### Benefits of Plugin Approach
- **Real-time Integration**: No need for polling/cron jobs
- **Performance**: Immediate data sync without delays
- **Reliability**: Tight integration with LimeSurvey's operation
- **Maintainability**: Clear separation of concerns

## Current Implementation

### Survey Flip Process
Currently, our integration uses scheduled jobs to populate the SurveyFlipResponse table:

```php
// In PopulateSurveyFlipBySurveyIdAction
public function execute(string $survey_id): void
{
    $survey_response = SurveyResponse::getResponsesForSurvey($survey_id);
    // Process responses and create SurveyFlipResponse records
}
```

### Plugin Enhancement Possibilities
1. **Real-time Updates**: Use `afterSurveyComplete` to trigger immediate flip
2. **Custom Settings**: Use `beforeSurveySettings` to add Quaeris-specific options
3. **Notification System**: Use `afterSurveyComplete` to trigger notifications

## Plugin Development Best Practices

### 1. Performance Considerations
- Avoid heavy processing in hooks that run frequently
- Cache expensive operations
- Use asynchronous job processing when needed

### 2. Error Handling
- Implement proper error logging
- Fail gracefully without breaking LimeSurvey
- Use try-catch blocks for external API calls

### 3. Configuration
- Allow plugin settings through LimeSurvey admin interface
- Use environment variables for sensitive configuration
- Provide default values for all settings

### 4. Security
- Validate all input data
- Use proper escaping for database queries
- Implement proper access controls

## Plugin Installation and Management

### Directory Structure
```
application/plugins/QuaerisHook/
├── QuaerisHook.php
├── config.xml
├── assets/
└── views/
```

### Configuration File
The `config.xml` file defines plugin metadata and settings:

```xml
<plugin>
    <name>QuaerisHook</name>
    <description>Integration with Quaeris system</description>
    <version>1.0.0</version>
    <author>Quaeris Team</author>
    <email>integration@quaeris.com</email>
    <settings>
        <quaeris_api_url>Quaeris API URL</quaeris_api_url>
        <quaeris_api_key>API Key</quaeris_api_key>
    </settings>
</plugin>
```

## Monitoring and Troubleshooting

### Event Subscription Verification
Check which events are subscribed to by your plugin:
```php
// In plugin class
public function getSubscribedEvents()
{
    return [
        'afterSurveyComplete',
        'beforeSurveySettings'
    ];
}
```

### Logging
Use LimeSurvey's logging system to track plugin activity:
```php
// In plugin class
public function afterSurveyComplete()
{
    $this->log('info', 'Processing new response', [
        'survey_id' => $surveyId,
        'response_id' => $responseId
    ]);
}
```

## Future Enhancements

### 1. Advanced Hook System
- Implement more granular hooks for specific question types
- Add hooks for custom export formats
- Create hooks for data validation

### 2. Configuration Sync
- Sync LimeSurvey survey settings with Quaeris analytics
- Configure automatic data processing rules
- Set up alert systems for specific responses

### 3. Performance Optimization
- Implement intelligent caching for metadata
- Use database indexing for faster lookups
- Optimize API calls to Quaeris system