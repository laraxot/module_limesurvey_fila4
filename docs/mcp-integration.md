# Model Context Protocol (MCP) Integration

## Overview

The Limesurvey module is integrated with the Model Context Protocol (MCP) system to provide enhanced AI-powered development capabilities. MCP enables intelligent code analysis, documentation generation, and development assistance for the LimeSurvey integration.

## MCP Configuration

The MCP system is configured through the main `mcp.json` file in the Laravel root directory. The Limesurvey module leverages several MCP servers:

### Database Server
- **Type**: `mysql`
- **Connection**: `marco:marco@localhost:3306/quaeris_survey`
- **Purpose**: Provides direct access to LimeSurvey database schema and data for AI analysis

### Filesystem Server
- **Path**: `/var/www/_bases/base_quaeris_fila4_mono/laravel`
- **Purpose**: Allows AI to explore and analyze Limesurvey module files

### Memory Server
- **Purpose**: Maintains session context during development conversations

### Git Server
- **Purpose**: Provides version control context for changes

## MCP Commands

### Starting MCP Services
```bash
# Start all configured MCP services
php artisan boost:mcp

# Start specific MCP server
php artisan mcp:start --handle=laravel-boost
```

### MCP Inspector
```bash
# Open MCP Inspector for debugging
php artisan mcp:inspector
```

## Development Workflow with MCP

### 1. Code Analysis
MCP provides deep analysis of LimeSurvey's complex database schema and dynamic table structure:

```
mcp__laravel-boost__analyze-model Modules\Limesurvey\Models\LimeQuestion
```

### 2. Documentation Generation
Automatically generate documentation for LimeSurvey integrations:

```
mcp__laravel-boost__generate-docs Modules\Limesurvey\Models\SurveyResponse
```

### 3. Query Optimization
Analyze and optimize complex LimeSurvey queries:

```
mcp__laravel-boost__analyze-query "SELECT * FROM lime_survey_{sid} WHERE submitdate > ?"
```

## LimeSurvey-Specific MCP Usage

### Dynamic Model Analysis
MCP can analyze the dynamic model generation pattern used in LimeSurvey:

```php
// MCP can understand and explain this pattern:
$tokenModelClass = app(GetParticipantModelBySurveyIdAction::class)
    ->execute($surveyId);
```

### ETL Process Understanding
MCP provides insights into the SurveyFlip ETL process:

```php
// MCP understands the extract-transform-load pattern for LimeSurvey data
app(PopulateSurveyFlipBySurveyIdAction::class)->execute($surveyId);
```

## Best Practices with MCP

### 1. Model Documentation
Use MCP to generate comprehensive model documentation:

```bash
# Generate documentation for LimeSurvey models
mcp__laravel-boost__generate-model-docs LimeSurvey
mcp__laravel-boost__generate-model-docs LimeQuestion
mcp__laravel-boost__generate-model-docs SurveyResponse
```

### 2. Query Analysis
Analyze complex LimeSurvey queries with MCP:

```bash
# Analyze performance of survey response queries
mcp__laravel-boost__analyze-query-performance "SELECT ... FROM lime_survey_{sid}"
```

### 3. Integration Understanding
Use MCP to understand LimeSurvey integration patterns:

```bash
# Understand the localization system
mcp__laravel-boost__explain-code Modules\Limesurvey\Models\LimeQuestion::l10n

# Understand dynamic table handling
mcp__laravel-boost__explain-code Modules\Limesurvey\Models\SurveyResponse::getResponsesForSurvey
```

## Troubleshooting MCP

### Common Issues

1. **Database Connection Issues**
   - Ensure LimeSurvey database credentials are correct in MCP config
   - Verify database is accessible from the MCP server

2. **File Access Issues**
   - Check file permissions for MCP filesystem server
   - Verify the root path in mcp.json is correct

3. **Performance Issues**
   - LimeSurvey tables can be very wide; MCP might need more time to analyze
   - Use specific model analysis rather than broad scans

### Verification Commands

```bash
# Test MCP connectivity
php artisan mcp:start --handle=laravel-boost

# Verify database access
mcp__laravel-boost__test-database-connection limesurvey

# Check file system access
mcp__laravel-boost__list-files Modules/Limesurvey
```

## Security Considerations

- MCP has access to sensitive LimeSurvey data through database connections
- Ensure MCP servers are properly secured and access is limited
- Review MCP logs for any unauthorized access attempts
- Use environment-specific MCP configurations

## Performance Optimization

- MCP analyzes LimeSurvey's dynamic table structure, which can be resource-intensive
- Consider enabling MCP caching for frequently accessed schemas
- Monitor MCP resource usage when analyzing large LimeSurvey databases