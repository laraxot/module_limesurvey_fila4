# LimeSurvey Module Documentation Index

**Status**: ✅ PHPStan Level 10 Compliance (0 errors)  
**Last Updated**: January 2026

## Quick Start

1. **New to the module?** Start with [README.md](README.md)
2. **Understanding architecture?** Read [architecture-and-integration.md](architecture-and-integration.md)
3. **Working with models and queries?** See [models-and-queries.md](models-and-queries.md)
4. **Best practices?** Check [best-practices.md](best-practices.md)

## Core Documentation

### README.md
High-level overview of the module, its purpose, and integration with Quaeris.

### architecture-and-integration.md
Comprehensive guide covering:
- LimeSurvey architecture and structure
- Database schema (static and dynamic tables)
- Localization strategy
- Core models overview
- Query optimization patterns
- Integration with Quaeris module

### models-and-queries.md
Detailed reference for:
- All core models (LimeSurvey, LimeQuestion, SurveyResponse, etc.)
- Query scopes and methods
- Performance optimization patterns
- Common query patterns

### best-practices.md
Best practices for:
- Model usage
- Dynamic table handling
- Query optimization
- Performance considerations
- Error handling

## Database Reference

### index.md
Complete database schema documentation including:
- Static metadata tables
- Dynamic response tables
- Localization tables
- Column definitions and relationships

### database-schema.md
Detailed schema reference with table structures and column descriptions.

## Integration Patterns

### survey-response-model.md
Dynamic table access patterns for SurveyResponse model.

### survey-response-aggregations.md
Aggregation methods and data access patterns for survey analysis.

## Code Quality

### phpstan/ Directory
PHPStan analysis reports and compliance details:
- `level-1.md` through `level-10.md` - Analysis at each PHPStan level
- `level-10-summary.md` - Summary of Level 10 compliance achievement
- JSON reports for each level

## Related Modules

- **Quaeris Module** (`../../Quaeris/docs/`) - Dashboard and reporting layer
- **Chart Module** (`../../Chart/docs/`) - Chart generation and visualization
- **Theme Zero** (`../../Themes/Zero/docs/`) - UI/UX implementation

## File Organization

```
docs/
├── README.md                          # Module overview
├── index.md                           # Complete database schema
├── index-consolidated.md              # This file
├── architecture-and-integration.md    # Architecture guide
├── models-and-queries.md              # Models and query reference
├── best-practices.md                  # Best practices
├── survey-response-model.md           # Dynamic model patterns
├── survey-response-aggregations.md    # Aggregation methods
├── database-schema.md                 # Schema reference
├── phpstan/                           # PHPStan analysis
│   ├── README.md
│   ├── level-1.md through level-10.md
│   └── level-10-summary.md
└── [other supporting docs]
```

## Key Concepts

### Dynamic Tables
LimeSurvey creates `lime_survey_{SID}` tables dynamically for each survey. The SurveyResponse model provides safe access via `getResponsesForSurvey()`.

### Localization (L10n)
Survey content is stored in separate L10n tables. Always join with appropriate L10n tables to get localized text.

### Survey Flip Pattern
ETL process to transform dynamic response tables into static EAV format for easier querying.

### Performance
- Use column selection to avoid SELECT * on wide tables
- Leverage caching for metadata tables
- Chunk large datasets
- Ensure proper indexing on `submitdate`

## Common Tasks

### Get Survey Structure
See [models-and-queries.md](models-and-queries.md#get-survey-with-full-structure)

### Query Survey Responses
See [models-and-queries.md](models-and-queries.md#get-responses-with-answer-labels)

### Optimize Queries
See [best-practices.md](best-practices.md#performance-optimization)

### Understand Architecture
See [architecture-and-integration.md](architecture-and-integration.md)

## Support

For issues or questions:
1. Check [best-practices.md](best-practices.md) for common patterns
2. Review [phpstan/](phpstan/) for code quality insights
3. See [../../Quaeris/docs/](../../Quaeris/docs/) for integration examples
