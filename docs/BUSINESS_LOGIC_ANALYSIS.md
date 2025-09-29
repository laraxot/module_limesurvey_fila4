# Limesurvey Module - Business Logic Analysis

## Overview
The Limesurvey module provides complete integration with the LimeSurvey platform, enabling comprehensive survey management, data collection, and analysis within the Quaeris ecosystem.

## Business Purpose
- **Survey Platform Integration**: Complete integration with LimeSurvey database schema
- **Survey Management**: Create, manage, and deploy surveys across multiple languages
- **Data Collection**: Collect and process survey responses with tokens and invitations
- **Multi-language Support**: Full internationalization for global survey deployment
- **Response Analysis**: Process and analyze survey data for reporting

## Core Business Logic

### 1. Survey Management
**Purpose**: Complete survey lifecycle management
**Scope**: Multi-language survey creation and deployment

**Key Components**:
- Survey creation and configuration
- Question and group management
- Survey activation and deactivation
- Version control and survey copying
- Template management

**Business Rules**:
- Surveys can be created in multiple languages
- Questions must belong to question groups
- Survey structure locked once activated
- Responses only accepted for active surveys

### 2. Question and Group Management
**Purpose**: Structured survey content organization
**Scope**: Question types, validation, and organization

**Key Components**:
- Question groups for survey organization
- Multiple question types (text, multiple choice, matrix, etc.)
- Question validation and logic
- Conditional question display
- Question randomization

**Business Rules**:
- Questions must belong to groups
- Question order determines display sequence
- Conditional logic must be valid
- Question codes must be unique within survey

### 3. Token and Invitation Management
**Purpose**: Controlled survey access and invitation tracking
**Scope**: Participant management and access control

**Key Components**:
- Token generation for survey access
- Invitation sending and tracking
- Response tracking and completion status
- Reminder scheduling and management
- Participant attribute management

**Business Rules**:
- Each participant gets unique token
- Tokens can be single-use or multi-use
- Invitations tracked for compliance
- Response anonymity respected when configured

### 4. Response Collection and Processing
**Purpose**: Survey data collection and initial processing
**Scope**: Response storage, validation, and basic analysis

**Key Components**:
- Dynamic response table creation
- Response validation and storage
- Partial response handling
- Response timing and metadata
- Data export and backup

**Business Rules**:
- Responses stored in survey-specific tables
- Partial responses can be saved and resumed
- Response timestamps recorded
- Data integrity maintained throughout collection

## Database Schema Analysis

### Complex Schema Structure
The LimeSurvey integration includes extensive schema mapping:

**Core Tables**:
- `lime_surveys`: Survey definitions and settings
- `lime_groups`: Question groups within surveys
- `lime_questions`: Individual survey questions
- `lime_answers`: Predefined answers for questions
- `lime_tokens_*`: Token tables for each survey
- `lime_survey_*`: Response tables for each survey

### Issues Identified
1. **Dynamic Table Creation**: Response tables created dynamically per survey
2. **Schema Complexity**: Very large number of tables (100+ for active instance)
3. **Performance**: Queries across multiple dynamic tables
4. **Maintenance**: Complex schema evolution and migration

### Optimization Opportunities
```sql
-- Index optimization for common queries
CREATE INDEX idx_lime_surveys_active ON lime_surveys(active, expires);
CREATE INDEX idx_lime_questions_survey_gid ON lime_questions(sid, gid, question_order);
CREATE INDEX idx_lime_tokens_email ON lime_tokens_{SID}(email, completed);

-- Partitioning for large response tables
ALTER TABLE lime_survey_{SID} PARTITION BY RANGE (submitdate);
```

## Filament 4 Improvements

### Current Implementation Issues
1. **Complex Forms**: Survey creation forms are complex but not optimized
2. **Dynamic Content**: Handling dynamic survey structures in Filament
3. **Performance**: Large datasets slow down admin interface
4. **User Experience**: Complex workflows not streamlined

### Recommended Upgrades

#### 1. Survey Builder Interface
```php
// Advanced survey builder with Filament 4
Forms\Components\Builder::make('survey_structure')
    ->blocks([
        Builder\Block::make('question_group')
            ->schema([
                Forms\Components\TextInput::make('group_name')->required(),
                Forms\Components\Textarea::make('description'),
                Forms\Components\Repeater::make('questions')
                    ->schema([
                        Forms\Components\Select::make('question_type')
                            ->options($this->getQuestionTypes()),
                        Forms\Components\TextInput::make('title')->required(),
                        Forms\Components\KeyValue::make('properties'),
                    ]),
            ]),
    ])
    ->collapsible()
    ->reorderableWithButtons(),
```

#### 2. Response Management
```php
// Advanced response table with filtering
Tables\Table::make()
    ->query(fn() => $this->getResponseQuery())
    ->columns([
        Tables\Columns\TextColumn::make('token')
            ->searchable()
            ->sortable(),
        Tables\Columns\TextColumn::make('submitdate')
            ->dateTime()
            ->sortable(),
        Tables\Columns\BadgeColumn::make('status')
            ->colors([
                'danger' => 'incomplete',
                'success' => 'complete',
            ]),
    ])
    ->filters([
        Tables\Filters\SelectFilter::make('status')
            ->options([
                'complete' => 'Complete',
                'incomplete' => 'Incomplete',
            ]),
        Tables\Filters\Filter::make('date_range')
            ->form([
                Forms\Components\DatePicker::make('from'),
                Forms\Components\DatePicker::make('until'),
            ]),
    ])
    ->actions([
        Tables\Actions\ViewAction::make()
            ->modalContent(fn($record) => view('filament.response-details', [
                'response' => $record,
            ])),
    ]);
```

#### 3. Survey Analytics Dashboard
```php
// Real-time survey analytics
protected function getStats(): array
{
    return [
        Stat::make('Total Responses', $this->getTotalResponses())
            ->description('32k increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
        Stat::make('Completion Rate', $this->getCompletionRate() . '%')
            ->description('7% increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
        Stat::make('Active Surveys', $this->getActiveSurveys())
            ->description('3 new surveys')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('info'),
    ];
}
```

## Code Quality Issues

### Current Challenges
1. **Dynamic Schema**: Handling dynamic table structures
2. **Complex Queries**: Multi-table joins across dynamic tables
3. **Memory Usage**: Large datasets in memory
4. **Error Handling**: Complex error scenarios

### Improvements Needed
```php
// Better query optimization
class SurveyResponseRepository
{
    public function getResponsesPaginated(int $surveyId, array $filters = []): LengthAwarePaginator
    {
        return DB::table("lime_survey_{$surveyId}")
            ->when($filters['status'] ?? null, function ($query, $status) {
                return $query->where('submitdate', $status === 'complete' ? '!=' : '=', null);
            })
            ->when($filters['date_from'] ?? null, function ($query, $date) {
                return $query->where('submitdate', '>=', $date);
            })
            ->select(['id', 'token', 'submitdate', 'lastpage'])
            ->paginate(50);
    }
}

// Improved error handling
class SurveyActivationService
{
    public function activateSurvey(int $surveyId): Result
    {
        try {
            DB::transaction(function () use ($surveyId) {
                $this->createResponseTable($surveyId);
                $this->createTokenTable($surveyId);
                $this->updateSurveyStatus($surveyId, 'Y');
            });

            return Result::success("Survey {$surveyId} activated successfully");
        } catch (Exception $e) {
            Log::error("Failed to activate survey {$surveyId}", ['error' => $e->getMessage()]);
            return Result::failure("Failed to activate survey: " . $e->getMessage());
        }
    }
}
```

## Integration Points

### Dependencies
- **Quaeris Module**: Customer-survey relationships
- **Chart Module**: Survey data visualization
- **User Module**: Survey access permissions
- **Notify Module**: Survey invitations and reminders

### External Dependencies
- **LimeSurvey Database**: External survey database connection
- **Email Services**: For survey invitations
- **File Storage**: For survey attachments and exports

## Performance Considerations

### Current Challenges
1. **Large Datasets**: Surveys with millions of responses
2. **Dynamic Queries**: Performance varies by survey structure
3. **Real-time Analytics**: Heavy computational requirements
4. **Export Operations**: Large data exports block system

### Optimization Strategies
```php
// Chunked processing for large datasets
class SurveyDataExportJob implements ShouldQueue
{
    public function handle(): void
    {
        DB::table("lime_survey_{$this->surveyId}")
            ->orderBy('id')
            ->chunk(1000, function ($responses) {
                $this->processResponseChunk($responses);
            });
    }
}

// Caching for frequently accessed data
class SurveyStatisticsService
{
    public function getSurveyStats(int $surveyId): array
    {
        return Cache::remember(
            "survey_stats_{$surveyId}",
            now()->addMinutes(15),
            fn() => $this->calculateStats($surveyId)
        );
    }
}
```

## Security Considerations

### Current Implementation
- Basic token-based access control
- Survey-level permissions
- Response anonymization options

### Security Improvements
```php
// Enhanced authorization
class SurveyPolicy
{
    public function viewResponses(User $user, Survey $survey): bool
    {
        return $user->hasPermissionTo('view_survey_responses')
            && $user->customers->contains($survey->customer_id);
    }

    public function exportData(User $user, Survey $survey): bool
    {
        return $user->hasPermissionTo('export_survey_data')
            && $this->viewResponses($user, $survey);
    }
}

// Data anonymization
class ResponseAnonymizer
{
    public function anonymizeResponse(array $response, Survey $survey): array
    {
        if (!$survey->anonymous) {
            return $response;
        }

        return collect($response)
            ->except(['email', 'firstname', 'lastname', 'ipaddr'])
            ->toArray();
    }
}
```

## Business Process Workflows

### Survey Creation Workflow
1. Survey design and configuration
2. Question and group setup
3. Logic and validation configuration
4. Preview and testing
5. Survey activation
6. Token generation and invitation sending

### Response Collection Workflow
1. Participant receives invitation
2. Token validation and access
3. Response collection and validation
4. Partial save and resume capability
5. Final submission and processing
6. Thank you page and follow-up

### Data Analysis Workflow
1. Response data aggregation
2. Statistical analysis and calculations
3. Chart and visualization generation
4. Report compilation
5. Export and distribution

## Development Priorities

### High Priority
1. **Performance Optimization**: Optimize queries for large datasets
2. **Filament Integration**: Improve admin interface for survey management
3. **Error Handling**: Robust error handling for edge cases
4. **Caching**: Implement comprehensive caching strategy

### Medium Priority
1. **API Development**: RESTful API for survey operations
2. **Real-time Features**: Live survey monitoring and analytics
3. **Advanced Analytics**: Statistical analysis and reporting
4. **Integration Testing**: Comprehensive integration tests

### Low Priority
1. **Machine Learning**: Response prediction and analysis
2. **Advanced Workflows**: Complex survey logic and branching
3. **Mobile Optimization**: Mobile-specific survey features
4. **Third-party Integrations**: CRM and marketing tool integration

## Business Value
- **Survey Platform**: Complete survey management solution
- **Data Collection**: Reliable and scalable data collection
- **Analytics**: Comprehensive survey analytics and reporting
- **Integration**: Seamless integration with customer management
- **Scalability**: Handles large-scale survey deployments

## Success Metrics
- Survey completion rates
- Data collection speed and reliability
- User satisfaction with survey tools
- System performance under load
- Integration success with customer workflows