# Limesurvey Module Documentation Index

## Overview
The Limesurvey module provides integration with the LimeSurvey platform, enabling survey management, response collection, and data analysis within the Laraxot framework. This module follows the DRY and KISS principles with proper service providers and extends Xot base classes for consistency.

## Current Status
- **Module**: Limesurvey
- **Integration**: Full LimeSurvey platform integration
- **PHPStan Status**: ✅ ACHIEVED - Level 10 compliance with 0 errors (as of 2026-01-14)
- **Achievement**: Full type safety and code quality compliance

## Core Components

### Models
- `LimeSurvey` - Main survey model with dynamic table access
- `LimeQuestion` - Question model with field mapping
- `SurveyResponse` - Dynamic response model for survey data
- `SurveyFlipResponse` - EAV format response model
- `TokensResponse` - Token management model
- `LimeAnswer` - Answer options model

### Actions
- `GetParticipantModelBySurveyIdAction` - Participant retrieval
- `PopulateSurveyFlipBySurveyIdAction` - EAV data population
- Various data processing actions

### Resources
- `SurveyFlipResponseResource` - Response management interface
- Various other resource files

### Casts
- `LimeLangField` - Language field casting

### Widgets
- `ChartItemWidget` - Chart visualization
- `MatrixChart` - Matrix question charts
- `RankingChart` - Ranking question charts
- `SingleChoiceChart` - Single choice charts
- `TypeB`, `TypeExclamationPoint`, `TypeF` - Specific question type widgets

## Key Features

### Dynamic Model Integration
The module provides dynamic access to LimeSurvey tables through the SurveyResponse model, allowing access to lime_survey_{SID} tables without creating separate models for each survey.

### Flip Approach (EAV Model)
The module includes a flip approach using SurveyFlipResponse with Entity-Attribute-Value structure for flexible querying across multiple surveys.

### Chart Integration
Multiple chart widgets support different LimeSurvey question types with data visualization capabilities.

## PHPStan Compliance

### Current Status
- **Level 10 Compliance**: ✅ ACHIEVED - Zero errors (as of 2026-01-14)
- **Status**: Full type safety and code quality compliance
- **Achievement**: All previously identified issues have been resolved

### Resolved Error Categories
1. **Return Type Issues** - ✅ Fixed
   - Proper return type declarations added to all methods
   - Type safety implemented throughout the module

2. **Mixed Type Issues** - ✅ Fixed  
   - Safe type handling implemented with proper validation
   - Type narrowing techniques applied where needed

3. **Parameter Type Mismatches** - ✅ Fixed
   - All parameters now have proper type declarations
   - Consistent string/integer type handling

4. **Undefined Properties/Methods** - ✅ Fixed
   - Proper property declarations added
   - Correct method access patterns implemented

5. **Missing Type Declarations** - ✅ Fixed
   - Complete type coverage across all classes
   - Consistent documentation and implementation

### Fix Roadmap
For detailed fix strategy and implementation plan, see:
- `phpstan-roadmap.md` - Initial approach for Limesurvey module
- `phpstan-master-roadmap.md` - Comprehensive master roadmap for Level 10 compliance
- `phpstan-widget-roadmap.md` - Detailed plan for widget class fixes
- `phpstan-action-roadmap.md` - Detailed plan for action class fixes
- `phpstan-resource-cast-roadmap.md` - Detailed plan for resource and cast class fixes

## Implementation Patterns

### Survey Response Access
The module provides two approaches for accessing survey responses:
1. Traditional approach using dynamic SurveyResponse model
2. Flip approach using SurveyFlipResponse model (EAV)

### Question Type Support
The module supports various LimeSurvey question types through specialized widgets and processing actions.

## Best Practices
- Follow Laraxot architecture patterns
- Use proper error handling for dynamic model access
- Implement type safety where possible
- Maintain performance with proper indexing
- Follow consistent naming conventions

## Related Documentation
- LimeSurvey integration guide
- SurveyFlip approach documentation
- Chart widget implementation guide
- Dynamic model access patterns