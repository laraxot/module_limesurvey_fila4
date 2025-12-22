<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Limesurvey\Casts\LimeLangField;
use Modules\Limesurvey\Contracts\LimeSurveyXXXContract;
use Webmozart\Assert\Assert;

/**
 * Modules\Limesurvey\Models\LimeQuestion
 *
 * @property int                                                                      $qid
 * @property int                                                                      $parent_qid
 * @property int                                                                      $sid
 * @property int                                                                      $gid
 * @property string                                                                   $type
 * @property string                                                                   $title
 * @property string|null                                                              $preg
 * @property string                                                                   $other
 * @property string|null                                                              $mandatory
 * @property int                                                                      $question_order
 * @property int                                                                      $scale_id
 * @property int                                                                      $same_default
 * @property string|null                                                              $relevance
 * @property string|null                                                              $modulename
 * @property string|null                                                              $encrypted
 * @property string|null                                                              $question_theme_name
 * @property int                                                                      $same_script
 * @property int|string|array                                                         $question
 * @property Collection<int, LimeAnswer>                                              $answers
 * @property int|null                                                                 $answers_count
 * @property \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, LimeQuestion> $brothers
 * @property int|null                                                                 $brothers_count
 * @property LimeQuestion|null                                                        $child
 * @property \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, LimeQuestion> $children
 * @property int|null                                                                 $children_count
 * @property \Modules\Quaeris\Models\Profile|null                                     $creator
 * @property Extra|null                                                               $extra
 * @property string                                                                   $field_name
 * @property string|null                                                              $full_title
 * @property int|null                                                                 $group_order
 * @property string                                                                   $text
 * @property LimeGroup|null                                                           $group
 * @property LimeQuestionL10n|null                                                    $l10n
 * @property LimeGroup|null                                                           $limeGroup
 * @property LimeQuestion|null                                                        $parent
 * @property Collection<int, LimeAnswer>                                              $props
 * @property int|null                                                                 $props_count
 * @property \Modules\Quaeris\Models\Profile|null                                     $updater
 * @property int                                                                      $depth
 * @property string                                                                   $path
 * @property \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, LimeQuestion> $ancestors           The model's recursive parents.
 *
 * @property-read int|null $ancestors_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, LimeQuestion> $ancestorsAndSelf The model's recursive parents and itself.
 * @property-read int|null $ancestors_and_self_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, LimeQuestion> $bloodline The model's ancestors, descendants and itself.
 * @property-read int|null $bloodline_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, LimeQuestion> $childrenAndSelf The model's direct children and itself.
 * @property-read int|null $children_and_self_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, LimeQuestion> $descendants The model's recursive children.
 * @property-read int|null $descendants_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, LimeQuestion> $descendantsAndSelf The model's recursive children and itself.
 * @property-read int|null $descendants_and_self_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, LimeQuestion> $parentAndSelf The model's direct parent and itself.
 * @property-read int|null $parent_and_self_count
 * @property-read LimeQuestion|null $rootAncestor The model's topmost parent.
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, LimeQuestion> $siblings The parent's other children.
 * @property-read int|null $siblings_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, LimeQuestion> $siblingsAndSelf All the parent's children.
 * @property-read int|null $siblings_and_self_count
 *
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static>      all($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion breadthFirst()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion depthFirst()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion disableCache()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion doesntHaveChildren()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static>      get($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion getExpressionGrammar()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion hasChildren()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion hasParent()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion isLeaf()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion isRoot()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion newModelQuery()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion newQuery()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion ofFilterData(\Modules\Quaeris\Datas\AnswersFilterData $answersFilterData)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion query()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion tree($maxDepth = null)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion treeOf(\Illuminate\Database\Eloquent\Model|callable $constraint, $maxDepth = null)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion whereDepth($operator, $value = null)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion whereEncrypted($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion whereGid($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion whereMandatory($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion whereModulename($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion whereOther($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion whereParentQid($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion wherePreg($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion whereQid($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion whereQuestionOrder($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion whereQuestionThemeName($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion whereRelevance($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion whereSameDefault($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion whereSameScript($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion whereScaleId($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion whereSid($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion whereTitle($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion whereType($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion withCacheCooldownSeconds(?int $seconds = null)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion withGlobalScopes(array $scopes)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder<static>|LimeQuestion withRelationshipExpression($direction, callable $constraint, $initialDepth, $from = null, $maxDepth = null)
 * @method        mixed                                                                   getExtra(string $key)                                                                                       Get extra data for this question by key
 * @method        void                                                                    setExtra(string $key, mixed $value)                                                                         Set extra data for this question
 *
 * @mixin \Eloquent
 */
class LimeQuestion extends BaseTreeModel
{
    /** @var string */
    protected $connection = 'limesurvey';

    /** @var string */
    protected $table = 'lime_questions';

    /** @var string */
    protected $primaryKey = 'qid';

    /** @var array<int, string> */
    protected $fillable = [
        'language',
        'parent_qid',
        'sid',
        'gid',
        'type',
        'title',
        'question',
        'preg',
        'help',
        'other',
        'mandatory',
        'question_order',
        'scale_id',
        'same_default',
        'relevance',
        'modulename',
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'qid' => 'int',
        'language' => 'string',
        'parent_qid' => 'int',
        'sid' => 'int',
        'gid' => 'int',
        'type' => 'string',
        'title' => 'string',
        // 'question' => 'string',
        'question' => LimeLangField::class,
        'preg' => 'string',
        'help' => 'string',
        'other' => 'string',
        'mandatory' => 'string',
        'question_order' => 'int',
        'scale_id' => 'int',
        'same_default' => 'int',
        'relevance' => 'string',
        'modulename' => 'string',
    ];

    /** @var array<string > */
    protected $with = [
        'l10n',
        'parent',
        // 'extra',
    ];

    /** @var array<int, string> */
    protected $appends = [
        // 'field_name',
    ];

    // Scopes...

    // Functions ...

    // Mutators
    /* -- move to CASTS
    public function getQuestionAttribute(?string $value): ?string {
        if (null == $value && Schema::hasTable('lime_question_l10ns')) {
            // if (is_null($value)) {
            $questionsL10n = LimeQuestionL10n::where('qid', $this->qid)->first();
            $value = $questionsL10n->question;
        }

        return $value;
    }
    */

    public function getParentKeyName(): string
    {
        return 'parent_qid';
    }

    public function getLocalKeyName(): string
    {
        return 'qid';
    }

    public function getLabel(): string
    {
        return $this->qid.']'.$this->title.']'.strip_tags($this->question);
    }

    /*
    public function getCustomPaths(): array
    {
        return [
            [
                'name' => 'breads',
                'column' => 'title',
                'separator' => '/',
            ],
        ];
    }
    */

    public function hasTrans(): bool
    {
        return \in_array($this->type, [
            // '1','B','T','G','L','!',
            // 'Y','5','S','R','N',
            // 'X',';','D','F','M',
            // 'Q','K','E','*','P','U',
            // 'A','C'
            '!', '1', 'F', 'L', 'R',
        ], true);
    }

    // public function getFeedback():?string{

    // }

    public function getGroupOrderAttribute(?int $value): ?int
    {
        return $this->group()->first()->group_order;
    }

    public function getFieldNameAttribute(?string $value): string
    {
        if ($value !== null) {
            return $value;
        }
        /*
        if (\is_string($value = $this->getExtra('field_name'))) {
            return $value;
        }

        $value = app(GetAnswerFieldNameByQuestionIdAction::class)->execute((string) $this->qid);
        $this->setExtra('field_name', $value);

        return $value;
        */

        $res = $this->sid.'X'.$this->gid.'X';
        // if ($this->type === 'F') {
        //     return $res.$this->qid.''.$this->child?->title;
        // }
        if ($this->type === 'F' && $this->child !== null) {
            return $res.$this->qid.''.$this->child->title;
        }
        if ($this->type === 'F') {
            return $res.$this->parent->qid.$this->title;
        }
        if ($this->parent_qid === 0) {
            return $res.$this->qid;
        }

        return $res.$this->parent_qid.''.$this->title;
    }

    public function getTextAttribute(?string $value): string
    {
        return strip_tags($this->getFullTitle());
    }

    public function getFullTitle(): string
    {
        if (\is_string($value = $this->getExtra('full_title'))) {
            return $value;
        }
        $title = '';
        if ($this->parent !== null) {
            $title .= $this->parent->getFullTitle().' - ';
        }

        $value = $title.$this->l10n->question;
        $this->setExtra('full_title', $value);

        return $value;
    }

    public function getFullTitleNew(): ?string
    {
        $ancestors = $this->ancestorsAndSelf()
        // $ancestors = $this->ancestors()
            ->pluck('title')
            ->reverse()
            ->toArray();

        // dddx($ancestors);

        return implode('_', $ancestors);

        // $ancestors = $this->ancestorsAndSelf()
        //     ->with('l10n') // Carica la relazione l10n per evitare problemi N+1
        //     ->orderBy('parent_qid', 'asc')
        //     ->get();

        // // Mappa ogni elemento per ottenere la stringa dalla relazione `l10n`
        // $titles = $ancestors->map(function ($ancestor) {
        //     // Verifica che la relazione `l10n` esista
        //     return $ancestor->l10n->question ?? '';
        // });

        // // Combina le stringhe con un separatore, ad esempio " "
        // return $titles->filter()->implode(' '); // Filtra eventuali stringhe vuote
    }

    public function getFullTitleAttribute(?string $value): ?string
    {
        if ($value !== null) {
            return $value;
        }

        return $this->getFullTitle();
    }

    public function getFullType(): string
    {
        if (\is_string($value = $this->getExtra('full_type'))) {
            return $value;
        }

        $title = '';
        if ($this->parent !== null) {
            $title .= $this->parent->getFullType();
        }

        $value = $title.$this->type;
        $this->setExtra('full_type', $value);

        return $value;
    }

    public function brothers(): HasMany
    {
        return $this->hasMany(self::class, 'sid', 'sid');
    }

    public function getFeedback(LimeSurveyXXXContract $row): ?string
    {
        if (\is_string($value = $this->getExtra('feedback'.$row->id))) {
            return $value;
        }
        $question_c = $this->brothers->firstWhere('title', $this->title.'c');
        $feedback = null;
        if ($question_c === null && $this->parent !== null) {
            $parent_question = $this->brothers->firstWhere('title', $this->parent->title.'c');

            if ($parent_question !== null) {
                Assert::isInstanceOf($parent_question, self::class);
                $field = $parent_question->sid.'X'.$parent_question->gid.'X'.$parent_question->qid;
                $feedback = $row->{$field};
            }
        } elseif ($question_c !== null) {
            // Assert::isInstanceOf($question_c, QuestionChart::class);
            $question_field_name = $question_c->field_name;
            $feedback = $row->{$question_field_name};
        }

        $this->setExtra('feedback'.$row->id, $feedback);

        return $feedback;
    }

    public function getGroupName(): ?string
    {
        if (\is_string($value = $this->getExtra('group_name'))) {
            return $value;
        }
        $value = $this->group->labels->group_name;
        $this->setExtra('group_name', $value);

        return $value;
    }

    // Relations ...

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class);
    }

    public function child(): HasOne
    {
        return $this->hasOne(self::class, 'parent_qid', 'qid');
    }

    public function props(): HasMany
    {
        return $this->hasMany(LimeAnswer::class, 'qid', 'qid');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(LimeAnswer::class, 'qid', 'qid');
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(LimeGroup::class, 'gid', 'gid')
            ->where('sid', $this->sid);
    }

    public function limeGroup(): BelongsTo
    {
        return $this->belongsTo(LimeGroup::class, 'gid', 'gid')
            ->where('sid', $this->sid);
    }

    public function l10n(): HasOne
    {
        $lang = app()->getLocale();

        return $this->hasOne(LimeQuestionL10n::class, 'qid', 'qid')
            ->where('language', $lang);
    }
}
