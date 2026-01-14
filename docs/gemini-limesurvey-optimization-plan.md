# LimeSurvey Optimization Plan (January 2026)

## 1. Caching Strategy for Metadata
Querying `lime_questions` and `lime_question_l10ns` for every page load is inefficient.
**Action**: Implement `SurveyStructureCache`.
- Cache key: `limesurvey_structure_{SID}_{LANG}`.
- Payload: Nested JSON of Groups -> Questions -> Answers.
- Invalidate on: `model.survey.afterSave` (via Plugin?). *Limitations: We might not catch changes if made directly in DB, but LS Admin uses models.*

## 2. ETL Performance (PopulateSurveyFlip)
The "Flipping" process can be slow for massive surveys.
**Optimization**:
- **Chunking**: Process `lime_survey_{SID}` in chunks of 1000.
- **Upsert**: Use `SurveyFlipResponse::upsert()` to avoid `SELECT` before `INSERT`.
- **Differential Update**: Store `last_sync_timestamp` and only query `lime_survey_{SID}` where `submitdate > last_sync`.

## 3. Real-time Integration
Instead of polling via cron, use a **LimeSurvey Plugin** ("QuaerisHook") that triggers a webhook or job dispatch on `afterSurveyComplete`.
- **Event**: `afterSurveyComplete`
- **Action**: Dispatch `ProcessNewResponseJob($surveyId, $responseId)` to Laravel queue.
- **Benefit**: Instant dashboard updates without polling overhead.

## 4. Database Indexing
Ensure `survey_flip_responses` has composite indexes:
- `INDEX(survey_id, question_id)`: For filtering by specific question.
- `INDEX(survey_id, response_id)`: For reconstructing a full response.
