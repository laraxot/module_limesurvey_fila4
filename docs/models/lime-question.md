# LimeQuestion Tree Model Documentation

## Overview

`LimeQuestion` is a tree-structured model that represents survey questions in a hierarchical format, supporting sub-questions and question groups.

## Purpose

This model provides:
- **Question Hierarchy**: Support for nested questions and sub-questions
- **Type Safety**: Full PHPStan Level 10 compliance
- **Survey Integration**: Seamless integration with LimeSurvey system

## Class Definition

```php
class LimeQuestion extends BaseTreeModel
{
    protected $connection = 'limesurvey';
    protected $table = 'lime_questions';
    
    /**
     * Get the name of the parent key column.
     * 
     * Override from HasRecursiveRelationshipsContract.
     * LimeSurvey uses 'parent_qid' instead of default 'parent_id'.
     */
    public function getParentKeyName(): string
    {
        return 'parent_qid';
    }
    
    /**
     * Get the name of the local key column (primary key).
     * 
     * Override from HasRecursiveRelationshipsContract.
     * LimeSurvey uses 'qid' instead of default 'id'.
     */
    public function getLocalKeyName(): string
    {
        return 'qid';
    }
}
```

### Implementation Details

- **Extends**: `BaseTreeModel` (which implements `HasRecursiveRelationshipsContract`)
- **Uses**: `TypedHasRecursiveRelationships` trait (type-safe wrapper around vendor trait)
- **Contract**: Implements `HasRecursiveRelationshipsContract` for type safety
- **PHPStan**: Level 10 compliant with explicit return types

## Database Schema

### Primary Structure
```sql
CREATE TABLE lime_questions (
    qid INT AUTO_INCREMENT PRIMARY KEY,           -- Question ID (Local Key)
    parent_qid INT NULL,                          -- Parent Question ID (Parent Key)
    sid INT NOT NULL,                             -- Survey ID
    gid INT NOT NULL,                             -- Group ID
    title VARCHAR(20) NOT NULL,                  -- Question title/code
    question TEXT,                                -- Question text
    type VARCHAR(20) NOT NULL,                   -- Question type
    -- ... other LimeSurvey fields
);
```

### Key Relationships
- **parent_qid → qid**: Self-referencing parent relationship
- **sid → lime_surveys.sid**: Belongs to survey
- **gid → lime_groups.gid**: Belongs to question group

## Tree Structure Usage

### Basic Hierarchy
```php
// Parent question
$parent = LimeQuestion::create([
    'title' => 'Q01',
    'question' => 'Main question',
    'type' => 'G',  // Group type
    'sid' => 123,
    'gid' => 456
]);

// Child question
$child = LimeQuestion::create([
    'title' => 'Q01_01',
    'question' => 'Sub-question 1',
    'type' => 'T',  // Text type
    'parent_qid' => $parent->qid,
    'sid' => 123,
    'gid' => 456
]);

// Grandchild question
$grandchild = LimeQuestion::create([
    'title' => 'Q01_01_01',
    'question' => 'Sub-sub-question',
    'type' => 'T',
    'parent_qid' => $child->qid,
    'sid' => 123,
    'gid' => 456
]);
```

### Navigation Examples
```php
// Get parent
$parent = $question->parent;

// Get direct children
$children = $question->children;

// Get all ancestors (up the tree)
$ancestors = $question->ancestors;

// Get all descendants (down the tree)
$descendants = $question->descendants;

// Get siblings (same parent)
$siblings = $question->siblings;

// Get root question
$root = $question->rootAncestor;

// Check if root
$isRoot = $question->parent === null;

// Check if leaf
$isLeaf = $question->children->isEmpty();
```

## LimeSurvey Integration

### Question Types
```php
// Group questions (can have children)
$group = LimeQuestion::create([
    'title' => 'GROUP_01',
    'type' => 'G',  // Group type
    'question' => 'Question Group Title'
]);

// Regular questions (usually leaf nodes)
$textQuestion = LimeQuestion::create([
    'title' => 'Q_TEXT',
    'type' => 'T',  // Text type
    'parent_qid' => $group->qid
]);

$choiceQuestion = LimeQuestion::create([
    'title' => 'Q_CHOICE',
    'type' => 'L',  // List type
    'parent_qid' => $group->qid
]);
```

### Survey Context
```php
// Get all questions in a survey
$surveyQuestions = LimeQuestion::where('sid', $surveyId)->get();

// Get root questions in a survey
$rootQuestions = LimeQuestion::where('sid', $surveyId)
    ->whereNull('parent_qid')
    ->get();

// Get question tree for a survey
$questionTree = LimeQuestion::where('sid', $surveyId)
    ->with(['descendants' => function($query) {
        $query->orderBy('question_order');
    }])
    ->whereNull('parent_qid')
    ->get();
```

## Advanced Usage

### Depth Constraints
```php
// Get descendants up to 3 levels deep
$nearDescendants = $question->descendants()
    ->withMaxDepth(3)
    ->get();

// Get ancestors up to 2 levels up
$nearAncestors = $question->ancestors()
    ->withMaxDepth(2)
    ->get();
```

### Performance Optimization
```php
// Eager load tree structure
$questions = LimeQuestion::with(['ancestors', 'children'])
    ->where('sid', $surveyId)
    ->get();

// Load specific tree branch
$branch = LimeQuestion::where('qid', $rootId)
    ->with('descendants')
    ->first();
```

### Question Path Operations
```php
// Get full path from root
$path = $question->getPath();
// Returns: "1/5/12" (qid hierarchy)

// Get question depth
$depth = $question->getDepth();
// Returns: 2 (0-based from root)

// Check if question is descendant of another
$isDescendant = $question->isDescendantOf($otherQuestion);
```

## Real-World Examples

### Survey Section with Sub-Questions
```php
// Create main section
$section = LimeQuestion::create([
    'title' => 'DEMOGRAPHICS',
    'question' => 'Demographic Information',
    'type' => 'G',
    'sid' => 123,
    'gid' => 1
]);

// Add sub-questions
$ageQuestion = LimeQuestion::create([
    'title' => 'AGE',
    'question' => 'What is your age?',
    'type' => 'N',  // Numeric
    'parent_qid' => $section->qid,
    'sid' => 123,
    'gid' => 1
]);

$genderQuestion = LimeQuestion::create([
    'title' => 'GENDER',
    'question' => 'What is your gender?',
    'type' => 'L',  // List
    'parent_qid' => $section->qid,
    'sid' => 123,
    'gid' => 1
]);

// Usage
foreach ($section->descendants as $question) {
    echo $question->title . ': ' . $question->question . "\n";
}
```

### Matrix Questions
```php
// Matrix parent
$matrix = LimeQuestion::create([
    'title' => 'MATRIX_01',
    'question' => 'Rate your satisfaction with:',
    'type' => 'F',  // Array type
    'sid' => 123,
    'gid' => 2
]);

// Matrix sub-questions (rows)
$rows = [
    ['title' => 'SERVICE', 'question' => 'Service quality'],
    ['title' => 'PRICE', 'question' => 'Price competitiveness'],
    ['title' => 'SUPPORT', 'question' => 'Customer support']
];

foreach ($rows as $row) {
    LimeQuestion::create([
        'title' => $row['title'],
        'question' => $row['question'],
        'type' => 'F',
        'parent_qid' => $matrix->qid,
        'sid' => 123,
        'gid' => 2
    ]);
}
```

## Data Integrity

### Validation Rules
```php
class LimeQuestion extends BaseTreeModel
{
    public static function rules(): array
    {
        return [
            'title' => 'required|max:20',
            'type' => 'required|in:T,L,G,F,M,K',
            'parent_qid' => 'nullable|exists:lime_questions,qid',
            'sid' => 'required|exists:lime_surveys,sid',
            'gid' => 'required|exists:lime_groups,gid',
        ];
    }
    
    public function validateParent(): bool
    {
        if ($this->parent_qid) {
            $parent = self::find($this->parent_qid);
            return $parent && $parent->sid === $this->sid;
        }
        return true;
    }
}
```

### Preventing Cycles
```php
public function setParentQidAttribute($value)
{
    if ($value) {
        // Prevent creating cycles
        if ($this->isDescendantOf(self::find($value))) {
            throw new InvalidArgumentException('Cannot create circular reference');
        }
    }
    $this->attributes['parent_qid'] = $value;
}
```

## Testing

### Unit Tests
```php
class LimeQuestionTest extends TestCase
{
    public function test_question_hierarchy()
    {
        $parent = LimeQuestion::factory()->create();
        $child = LimeQuestion::factory()->create([
            'parent_qid' => $parent->qid
        ]);
        
        // Test parent relationship
        $this->assertEquals($parent->qid, $child->parent->qid);
        
        // Test children relationship
        $this->assertTrue($parent->children->contains($child));
        
        // Test ancestors
        $this->assertTrue($child->ancestors->contains($parent));
        
        // Test descendants
        $this->assertTrue($parent->descendants->contains($child));
    }
    
    public function test_prevent_circular_reference()
    {
        $parent = LimeQuestion::factory()->create();
        $child = LimeQuestion::factory()->create([
            'parent_qid' => $parent->qid
        ]);
        
        $this->expectException(InvalidArgumentException::class);
        $parent->update(['parent_qid' => $child->qid]);
    }
}
```

## Performance Considerations

### Database Indexes
```sql
-- Essential indexes for tree performance
CREATE INDEX idx_lime_questions_parent_qid ON lime_questions(parent_qid);
CREATE INDEX idx_lime_questions_sid ON lime_questions(sid);
CREATE INDEX idx_lime_questions_gid ON lime_questions(gid);
CREATE INDEX idx_lime_questions_type ON lime_questions(type);
CREATE INDEX idx_lime_questions_composite ON lime_questions(sid, parent_qid);
```

### Query Optimization
```php
// Efficient tree loading for survey
$surveyTree = LimeQuestion::where('sid', $surveyId)
    ->whereNull('parent_qid')
    ->with(['descendants' => function($query) {
        $query->orderBy('question_order', 'asc');
    }])
    ->get();

// Count questions without loading all
$questionCount = LimeQuestion::where('sid', $surveyId)->count();
$rootCount = LimeQuestion::where('sid', $surveyId)
    ->whereNull('parent_qid')->count();
```

## Troubleshooting

### Common Issues
1. **Circular references**: Validate parent relationships
2. **Performance on large surveys**: Add proper indexes
3. **Memory usage**: Use depth constraints for large trees
4. **Orphaned questions**: Ensure parent_qid references valid questions

### Debug Queries
```php
// Check tree integrity
$questionsWithInvalidParents = LimeQuestion::whereNotNull('parent_qid')
    ->whereRaw('parent_qid NOT IN (SELECT qid FROM lime_questions)')
    ->get();

// Find circular references
$circularReferences = LimeQuestion::whereRaw('qid IN (
    SELECT descendant.qid 
    FROM lime_questions AS descendant
    JOIN lime_questions AS ancestor ON descendant.qid = ancestor.parent_qid
    WHERE ancestor.parent_qid IS NOT NULL
)')->get();
```

## Best Practices

1. **Always validate parent relationships** to prevent cycles
2. **Use depth constraints** for large survey trees
3. **Cache question trees** for frequently accessed surveys
4. **Batch operations** when importing large question sets
5. **Document question hierarchies** for survey designers

## Related Documentation

- [BaseTreeModel](../../Xot/docs/models/base-tree-model.md)
- [HasRecursiveRelationshipsContract](../../Xot/docs/contracts/has-recursive-relationships-contract.md)
- [LimeSurvey Integration](limesurvey-integration.md)