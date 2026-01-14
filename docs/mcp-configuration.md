# MCP (Model Context Protocol) Configuration for LimeSurvey

## Overview
Model Context Protocol (MCP) is an emerging standard for AI-assisted software development that allows AI agents to understand and interact with codebases more effectively. This document outlines the MCP configuration for the LimeSurvey module and integration with the broader system.

## MCP Architecture in Quaeris

### Current MCP Servers
The current `mcp.json` configuration includes:

```json
{
  "mcpServers": {
    "mysql": {
      "command": "npx",
      "args": [
        "-y",
        "@modelcontextprotocol/server-mysql",
        "marco:marco@localhost:3306/quaeris_survey"
      ]
    },
    "fetch": {
      "command": "npx",
      "args": [
        "-y",
        "@modelcontextprotocol/server-fetch"
      ]
    },
    "memory": {
      "command": "npx",
      "args": [
        "-y",
        "@modelcontextprotocol/server-memory"
      ]
    },
    "filesystem": {
      "command": "npx",
      "args": [
        "-y",
        "@modelcontextprotocol/server-filesystem",
        "/var/www/_bases/base_quaeris_fila4_mono/laravel"
      ]
    },
    "git": {
      "command": "npx",
      "args": [
        "-y",
        "@modelcontextprotocol/server-git"
      ]
    },
    "laravel-boost": {
      "command": "php",
      "args": [
        "artisan",
        "boost:mcp"
      ]
    }
  }
}
```

## MCP Configuration for LimeSurvey Module

### Enhanced MCP Configuration
Here's an updated configuration that better supports LimeSurvey development:

```json
{
  "mcpServers": {
    "mysql": {
      "command": "npx",
      "args": [
        "-y",
        "@modelcontextprotocol/server-mysql",
        "marco:marco@localhost:3306/quaeris_survey"
      ],
      "description": "Primary database for LimeSurvey and Quaeris data"
    },
    "limesurvey-db": {
      "command": "npx",
      "args": [
        "-y",
        "@modelcontextprotocol/server-mysql",
        "limesurvey_user:password@localhost:3306/limesurvey"
      ],
      "description": "Direct access to LimeSurvey database"
    },
    "filesystem": {
      "command": "npx",
      "args": [
        "-y",
        "@modelcontextprotocol/server-filesystem",
        "/var/www/_bases/base_quaeris_fila4_mono/laravel"
      ],
      "description": "Main Laravel application filesystem"
    },
    "limesurvey-module": {
      "command": "npx",
      "args": [
        "-y",
        "@modelcontextprotocol/server-filesystem",
        "/var/www/_bases/base_quaeris_fila4_mono/laravel/Modules/Limesurvey"
      ],
      "description": "LimeSurvey module specific filesystem"
    },
    "git": {
      "command": "npx",
      "args": [
        "-y",
        "@modelcontextprotocol/server-git"
      ],
      "description": "Git repository operations"
    },
    "laravel-artisan": {
      "command": "php",
      "args": [
        "artisan",
        "mcp:serve"
      ],
      "description": "Laravel-specific MCP commands"
    },
    "php-server": {
      "command": "npx",
      "args": [
        "-y",
        "@modelcontextprotocol/server-process",
        "php",
        "-S",
        "localhost:8000",
        "-t",
        "/var/www/_bases/base_quaeris_fila4_mono/laravel/public"
      ],
      "description": "PHP development server"
    }
  }
}
```

## MCP Integration Points for LimeSurvey

### 1. Database Schema Context
MCP should provide context about LimeSurvey's dynamic database structure:

```json
{
  "resources": [
    {
      "type": "database_schema",
      "name": "limesurvey_dynamic_tables",
      "description": "Dynamic tables created by LimeSurvey for each survey",
      "uri": "mcp://mysql/limesurvey?pattern=lime_survey_*"
    },
    {
      "type": "database_schema",
      "name": "limesurvey_metadata",
      "description": "Static metadata tables in LimeSurvey",
      "uri": "mcp://mysql/limesurvey?tables=lime_surveys,lime_groups,lime_questions,lime_answers"
    },
    {
      "type": "database_schema", 
      "name": "survey_flip_responses",
      "description": "Our EAV representation of LimeSurvey responses",
      "uri": "mcp://mysql/quaeris?table=survey_flip_responses"
    }
  ]
}
```

### 2. Model Relationships
MCP should understand the relationships in our LimeSurvey integration:

```json
{
  "resources": [
    {
      "type": "model_relationship",
      "name": "lime_survey_questions",
      "description": "Relationship between LimeSurvey and LimeQuestion",
      "uri": "mcp://filesystem?path=Modules/Limesurvey/app/Models/LimeSurvey.php#relations"
    },
    {
      "type": "model_relationship",
      "name": "survey_flip_pattern",
      "description": "SurveyFlipResponse EAV pattern",
      "uri": "mcp://filesystem?path=Modules/Limesurvey/app/Models/SurveyFlipResponse.php#relations"
    }
  ]
}
```

### 3. Documentation Context
MCP should provide access to LimeSurvey-specific documentation:

```json
{
  "resources": [
    {
      "type": "documentation",
      "name": "limesurvey_architecture",
      "description": "LimeSurvey integration architecture",
      "uri": "mcp://filesystem?path=Modules/Limesurvey/docs/architecture-overview.md"
    },
    {
      "type": "documentation", 
      "name": "survey_flip_strategy",
      "description": "Survey flip EAV transformation strategy",
      "uri": "mcp://filesystem?path=Modules/Limesurvey/docs/survey-flip-strategy.md"
    },
    {
      "type": "documentation",
      "name": "etl_process",
      "description": "ETL process for LimeSurvey data",
      "uri": "mcp://filesystem?path=Modules/Limesurvey/docs/etl-process.md"
    }
  ]
}
```

## Configuration Recommendations

### 1. LimeSurvey-Specific MCP Settings
Create a module-specific configuration:

```json
{
  "mcp": {
    "limesurvey": {
      "database": {
        "connection": "limesurvey",
        "dynamic_table_pattern": "lime_survey_\\d+",
        "metadata_tables": [
          "lime_surveys",
          "lime_groups", 
          "lime_questions",
          "lime_answers",
          "lime_tokens_\\d+"
        ]
      },
      "api": {
        "endpoint": "/index.php/admin/remotecontrol",
        "authentication": "session"
      },
      "integration": {
        "survey_flip_model": "Modules\\Limesurvey\\Models\\SurveyFlipResponse",
        "etl_action": "Modules\\Limesurvey\\Actions\\PopulateSurveyFlipBySurveyIdAction",
        "sync_frequency": "hourly"
      }
    }
  }
}
```

### 2. Development Environment MCP Configuration
For optimal development experience:

```json
{
  "mcp": {
    "development": {
      "limesurvey_integration": {
        "debug_mode": true,
        "log_queries": true,
        "enable_profiling": true,
        "database_monitoring": {
          "track_dynamic_tables": true,
          "monitor_survey_activations": true,
          "log_schema_changes": true
        }
      }
    }
  }
}
```

## MCP Usage Patterns for LimeSurvey Development

### 1. Schema Understanding
```php
// Example of how MCP might help understand dynamic schemas
$mcp->query("What are the column names for lime_survey_123456?");
$mcp->query("Show relationships between lime_surveys and lime_survey_{SID} tables");
```

### 2. Code Generation
MCP can assist in generating code templates for new LimeSurvey integrations:

```php
// MCP might generate:
class LimeSurvey123456 extends BaseModel {
    protected $table = 'lime_survey_123456';
    // Dynamic columns would be handled appropriately
}
```

### 3. Query Optimization
MCP can help optimize queries against LimeSurvey's dynamic structure:

```sql
-- MCP might suggest optimized queries like:
SELECT * FROM lime_survey_123456 
WHERE submitdate BETWEEN ? AND ? 
AND `123456X22X487` IS NOT NULL;
```

## Installation and Setup

### 1. Prerequisites
- Node.js and npm installed
- MCP-compatible AI development tool
- Proper database access permissions

### 2. Configuration Steps
1. Install MCP server packages:
```bash
npm install @modelcontextprotocol/server-mysql @modelcontextprotocol/server-filesystem
```

2. Update the mcp.json file with LimeSurvey-specific configurations

3. Verify database connections work properly

4. Test MCP functionality with LimeSurvey-specific queries

### 3. Testing MCP Integration
```bash
# Test database connectivity
mcp-test --server mysql --query "SELECT COUNT(*) FROM lime_surveys"

# Test filesystem access
mcp-test --server filesystem --path "Modules/Limesurvey/app/Models"

# Test overall setup
mcp-test --all
```

## Troubleshooting MCP Configuration

### 1. Connection Issues
- Verify database credentials in MCP configuration
- Check that LimeSurvey database is accessible
- Ensure proper network connectivity

### 2. Dynamic Schema Recognition
- MCP may not properly recognize dynamic table names
- Use patterns like `lime_survey_\d+` for dynamic tables
- Consider caching schema information for better performance

### 3. Performance Considerations
- Large dynamic tables may impact MCP performance
- Implement appropriate caching strategies
- Consider indexing strategies for MCP queries

## Future MCP Enhancements

### 1. LimeSurvey Plugin Integration
MCP could eventually provide context about LimeSurvey plugin development:

```json
{
  "resources": [
    {
      "type": "limesurvey_plugin_template",
      "name": "quaeris_sync_plugin",
      "description": "Template for LimeSurvey plugin to sync with Quaeris",
      "uri": "mcp://template?plugin=quaeris_sync"
    }
  ]
}
```

### 2. Real-time Monitoring
Integration with real-time ETL monitoring through MCP:

```json
{
  "resources": [
    {
      "type": "monitoring",
      "name": "survey_flip_progress",
      "description": "Real-time monitoring of survey flip process",
      "uri": "mcp://process/survey_flip_watcher"
    }
  ]
}
```

This MCP configuration will help AI tools better understand and work with the LimeSurvey integration, improving development efficiency and reducing errors.