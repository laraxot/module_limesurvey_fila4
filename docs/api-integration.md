# LimeSurvey API Integration

## RemoteControl API (JSON-RPC)

LimeSurvey provides a comprehensive JSON-RPC API called RemoteControl for external automation and integration. This API allows external systems to control LimeSurvey functionality.

### API Endpoint
```
/index.php/admin/remotecontrol
```

### Authentication Model
The API uses a session-based authentication approach:

1. Call `get_session_key(username, password)` to obtain a session key
2. Use the returned `$sessionKey` for subsequent API calls
3. Call `release_session_key($sessionKey)` when finished to free resources

### Key API Methods

#### Survey Management
- `list_surveys($sessionKey, $username = null)` - Get all surveys
- `add_survey($sessionKey, $surveyid, $surveylanguage, $format)` - Create new survey
- `delete_survey($sessionKey, $iSurveyID)` - Delete a survey
- `get_survey_properties($sessionKey, $iSurveyID, $aSurveySettings = [])` - Get survey settings

#### Question Management
- `list_questions($sessionKey, $iSurveyID, $iGroupID = null, $aQuestionIDs = [])` - List questions
- `add_group($sessionKey, $iSurveyID, $stGroupName, $stGroupTitle)` - Add question group
- `add_question($sessionKey, $iSurveyID, $iGroupID, $sType, $sTitle)` - Add question
- `get_question_properties($sessionKey, $iQuestionID, $aQuestionSettings = [])` - Get question properties

#### Response Management
- `export_responses($sessionKey, $iSurveyID, $sLanguageCode = null, $sCompletionStatus = 'all', $sHeadingType = 'code', $sResponseType = 'array', $aFields = [])` - Export responses
- `import_responses($sessionKey, $iSurveyID, $sContent, $sType)` - Import responses
- `add_response($sessionKey, $iSurveyID, $aResponseData)` - Add a response

#### Participant Management
- `list_participants($sessionKey, $iSurveyID, $aTokenIDs = [], $bUnused = false, $bAttributes = false, $limit = 10000, $start = 0)` - List participants
- `add_participants($sessionKey, $iSurveyID, $aParticipantData, $bCreateTokenKey = true)` - Add participants
- `delete_participants($sessionKey, $iSurveyID, $aTokenIDs)` - Delete participants

## Our Implementation Approach

### Direct Database Integration vs. API
While LimeSurvey provides a robust API, our integration primarily uses direct database access for performance reasons:

**Direct Database Access Benefits:**
- Higher performance for bulk operations
- No HTTP overhead
- Direct access to all data without API rate limits
- Better control over data transformation

**API Usage Scenarios:**
- Survey creation and configuration
- Administrative tasks
- External system integrations
- When direct DB access is not available

### Database-First Integration Pattern

Our integration pattern works as follows:

```php
// Example: Getting survey responses for processing
$survey_response = SurveyResponse::getResponsesForSurvey($survey_id);

// Example: Processing question metadata
$questions = LimeQuestion::where('sid', $survey_id)->get();

// Example: Flipping survey data to EAV format
foreach ($responses as $response) {
    foreach ($questions as $question) {
        $data = [
            'survey_id' => $response->survey_id,
            'question_id' => $question->qid,
            'answer' => $response->{$question->fieldname},
            'submitdate' => $response->submitdate,
            // ... other fields
        ];
        SurveyFlipResponse::create($data);
    }
}
```

## Integration Best Practices

### 1. Session Management
When using the API, always properly manage sessions:
```php
try {
    $sessionKey = LimeSurveyApi::getSessionKey($username, $password);
    // Perform API operations
    $result = LimeSurveyApi::listSurveys($sessionKey);
    // ... more operations
} finally {
    LimeSurveyApi::releaseSessionKey($sessionKey);
}
```

### 2. Error Handling
API calls can fail for various reasons:
- Authentication failures
- Invalid parameters
- Survey not found
- Permission errors

Always implement proper error handling and logging.

### 3. Rate Limiting
Even with direct database access, be mindful of performance and implement appropriate rate limiting for bulk operations.

### 4. Data Consistency
When using both direct database access and API, ensure data consistency:
- Use transactions when modifying related data
- Implement proper locking mechanisms
- Handle concurrent access scenarios

## Security Considerations

### Authentication
- Use strong, unique credentials for API access
- Store credentials securely (environment variables, encrypted storage)
- Implement proper access controls

### Data Validation
- Validate all data received from LimeSurvey
- Implement input sanitization
- Prevent SQL injection and XSS attacks

### Network Security
- Use HTTPS when making API calls
- Implement proper firewall rules
- Monitor API usage for anomalies