# Upstream References for LimeSurvey Integration

## Official LimeSurvey Resources

### Main Project
- **GitHub Repository**: https://github.com/LimeSurvey/LimeSurvey
- **Official Website**: https://www.limesurvey.org/
- **Documentation**: https://manual.limesurvey.org/
- **Demo Instance**: https://demo.limesurvey.org/

### Technical Documentation
- **Database Schema**: https://manual.limesurvey.org/Database_structure
- **API Documentation**: https://manual.limesurvey.org/RemoteControl_2_API
- **Plugin Development**: https://manual.limesurvey.org/Plugin_development
- **Question Types**: https://manual.limesurvey.org/Question_types

### API References
- **JSON-RPC API**: LimeSurvey uses RemoteControl 2 API with JSON-RPC protocol
- **Authentication**: Session-based using `get_session_key()` method
- **Common Methods**:
  - `list_surveys()` - Get all surveys
  - `get_question_properties()` - Get question metadata
  - `export_responses()` - Export survey responses
  - `add_response()` - Add a new response

## Integration Patterns Used

### Survey Flip Strategy References
- **EAV Model**: Entity-Attribute-Value pattern for flexible data representation
- **Wide to Long Transformation**: Converting LimeSurvey's wide table format to normalized structure
- **Incremental Processing**: Differential updates for efficient ETL

### Database Schema References
- **Dynamic Tables**: LimeSurvey creates `lime_survey_{SID}` tables on survey activation
- **Field Naming Convention**: `{SID}X{GID}X{QID}` format for dynamic columns
- **Localization Tables**: Separate tables for multilingual content (l10n)

## Related Technologies

### Yii Framework (LimeSurvey Base)
- **Yii Framework**: https://www.yiiframework.com/
- **Database Schema**: Active Record pattern with dynamic model creation
- **Event System**: Plugin architecture based on event-driven hooks

### Laravel Integration Points
- **Database Connections**: Multi-database configuration for both systems
- **Eloquent ORM**: Used for the static parts of integration
- **Queue System**: For processing large surveys asynchronously
- **Caching**: For performance optimization of metadata

## Performance Optimization References

### Database Optimization
- **Indexing Strategy**: Best practices for wide table indexing
- **Query Optimization**: Techniques for efficient data extraction
- **Connection Pooling**: Managing multiple database connections

### ETL Process Optimization
- **Chunked Processing**: Breaking large datasets into manageable pieces
- **Upsert Operations**: Efficient data loading with duplicate prevention
- **Caching Strategies**: Metadata and result caching for performance

## MCP (Model Context Protocol) References

### MCP Specification
- **MCP GitHub**: https://github.com/modelcontextprotocol/specification
- **Server Types**: Various MCP server implementations
- **Resource Types**: Standardized resource definition formats

### Implementation References
- **Database Servers**: MySQL integration patterns
- **Filesystem Servers**: Module-specific filesystem access
- **Process Servers**: Command-line tool integration

## Security Considerations

### LimeSurvey Security
- **Authentication**: Session-based security model
- **Authorization**: Role-based access control
- **Data Encryption**: Participant data protection

### Integration Security
- **Database Access**: Secure connection handling
- **API Keys**: Secure storage and transmission
- **Data Privacy**: GDPR compliance for survey data

## Troubleshooting References

### Common Issues
- **Database Connectivity**: Connection string and permission issues
- **Dynamic Schema**: Handling changing table structures
- **Performance**: Memory and time limits for large surveys
- **Data Mapping**: Field name and type conversion issues

### Diagnostic Tools
- **LimeSurvey Debug Mode**: Built-in debugging capabilities
- **Laravel Telescope**: Request and query monitoring
- **Database Profiling**: Query performance analysis
- **Queue Monitoring**: Background job tracking

## Version Compatibility

### Current Integration
- **LimeSurvey Version**: 3.x+ (with localization tables)
- **Database**: MySQL/MariaDB
- **PHP**: 8.0+ (compatible with Laravel 9+)
- **Laravel**: 9.x+ for integration components

### Migration Considerations
- **Schema Changes**: How LimeSurvey updates affect dynamic tables
- **API Changes**: RemoteControl API version compatibility
- **Localization Updates**: Changes in l10n table structure

## Performance Benchmarks

### Survey Size Limits
- **Recommended Max**: ~10,000 responses per survey for optimal performance
- **Processing Time**: ~1 minute per 1,000 responses (varies by complexity)
- **Memory Usage**: ~50MB per 1,000 responses (varies by question count)

### Scalability Patterns
- **Horizontal Scaling**: Multiple worker processes for large deployments
- **Database Sharding**: Potential for survey-based data partitioning
- **Caching Layers**: Multiple levels of caching for performance