# LimeSurvey Integration Documentation

## Overview
This documentation covers the LimeSurvey integration module for the Quaeris system. LimeSurvey is a powerful open-source survey platform that is integrated into our system to provide advanced survey capabilities.

## Documentation Sections

1. [Architecture Deep Dive](limesurvey-architecture-2026.md) - Detailed system architecture
2. [Database Analysis](database-quaeris-survey.md) - Complete database structure analysis
3. [Upstream References](upstream-references.md) - Official LimeSurvey documentation references
4. [Optimization Plan](gemini-limesurvey-optimization-plan.md) - Performance optimization strategies
5. [Integration Guide](limesurvey-integration-guide.md) - Implementation and usage guide
6. [API Reference](api-reference.md) - Available methods and functions
7. [Best Practices](best-practices.md) - Recommended usage patterns
8. [Troubleshooting](troubleshooting.md) - Common issues and solutions
9. [MCP Integration](mcp-integration.md) - Model Context Protocol integration and usage
10. [Integration Summary](integration-summary.md) - Complete project integration overview

## Current Status
- **Integration Method**: Direct database access to LimeSurvey tables
- **Survey Data**: Transformed from wide format to EAV (Entity-Attribute-Value) model
- **Real-time Sync**: Implemented via scheduled jobs
- **API**: JSON-RPC (RemoteControl 2) for external automation