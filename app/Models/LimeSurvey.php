<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use stdClass;

/**
 * Modules\Limesurvey\Models\LimeSurvey
 *
 * @property int $sid
 * @property int $owner_id
 * @property int|null $gsid
 * @property string|null $admin
 * @property string $active
 * @property Carbon|null $expires
 * @property Carbon|null $startdate
 * @property string|null $adminemail
 * @property string $anonymized
 * @property string|null $faxto
 * @property string|null $format
 * @property string $savetimings
 * @property string|null $template
 * @property string|null $language
 * @property string|null $additional_languages
 * @property string $datestamp
 * @property string $usecookie
 * @property string $allowregister
 * @property string $allowsave
 * @property int $autonumber_start
 * @property string $autoredirect
 * @property string $allowprev
 * @property string $printanswers
 * @property string $ipaddr
 * @property string $refurl
 * @property Carbon|null $datecreated
 * @property int|null $showsurveypolicynotice
 * @property string $publicstatistics
 * @property string $publicgraphs
 * @property string $listpublic
 * @property string $htmlemail
 * @property string $sendconfirmation
 * @property string $tokenanswerspersistence
 * @property string $assessments
 * @property string $usecaptcha
 * @property string $usetokens
 * @property string|null $bounce_email
 * @property array $attributedescriptions
 * @property string|null $emailresponseto
 * @property string|null $emailnotificationto
 * @property int $tokenlength
 * @property string|null $showxquestions
 * @property string|null $showgroupinfo
 * @property string|null $shownoanswer
 * @property string|null $showqnumcode
 * @property int|null $bouncetime
 * @property string|null $bounceprocessing
 * @property string|null $bounceaccounttype
 * @property string|null $bounceaccounthost
 * @property string|null $bounceaccountpass
 * @property string|null $bounceaccountencryption
 * @property string|null $bounceaccountuser
 * @property string|null $showwelcome
 * @property string|null $showprogress
 * @property int $questionindex
 * @property int $navigationdelay
 * @property string|null $nokeyboard
 * @property string|null $alloweditaftercompletion
 * @property string|null $googleanalyticsstyle
 * @property string|null $googleanalyticsapikey
 * @property array<array-key, mixed>|null $tokenencryptionoptions
 * @property string $ipanonymize
 * @property-read \Modules\Quaeris\Models\Profile|null $creator
 * @property-read \Modules\Limesurvey\Models\Extra|null $extra
 * @property-read string|null $title
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Limesurvey\Models\LimeGroup> $groups
 * @property-read int|null $groups_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Limesurvey\Models\LimeGroupL10n> $groups_l10n
 * @property-read int|null $groups_l10n_count
 * @property-read \Modules\Limesurvey\Models\LimeSurveysLanguagesetting|null $lang
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \Modules\Limesurvey\Models\LimeQuestion> $questions
 * @property-read int|null $questions_count
 * @property-read \Modules\Quaeris\Models\Profile|null $updater
 *
 * @method static CachedBuilder<static>|LimeSurvey all($columns = [])
 * @method static CachedBuilder<static>|LimeSurvey avg($column)
 * @method static CachedBuilder<static>|LimeSurvey cache(array $tags = [])
 * @method static CachedBuilder<static>|LimeSurvey cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder<static>|LimeSurvey count($columns = '*')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey disableCache()
 * @method static CachedBuilder<static>|LimeSurvey disableModelCaching()
 * @method static CachedBuilder<static>|LimeSurvey exists()
 * @method static CachedBuilder<static>|LimeSurvey flushCache(array $tags = [])
 * @method static CachedBuilder<static>|LimeSurvey getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static CachedBuilder<static>|LimeSurvey inRandomOrder($seed = '')
 * @method static CachedBuilder<static>|LimeSurvey insert(array $values)
 * @method static CachedBuilder<static>|LimeSurvey isCachable()
 * @method static CachedBuilder<static>|LimeSurvey max($column)
 * @method static CachedBuilder<static>|LimeSurvey min($column)
 * @method static CachedBuilder<static>|LimeSurvey newModelQuery()
 * @method static CachedBuilder<static>|LimeSurvey newQuery()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey ofFilterData(\Modules\Quaeris\Datas\AnswersFilterData $answersFilterData)
 * @method static CachedBuilder<static>|LimeSurvey query()
 * @method static CachedBuilder<static>|LimeSurvey sum($column)
 * @method static CachedBuilder<static>|LimeSurvey truncate()
 * @method static CachedBuilder<static>|LimeSurvey whereActive($value)
 * @method static CachedBuilder<static>|LimeSurvey whereAdditionalLanguages($value)
 * @method static CachedBuilder<static>|LimeSurvey whereAdmin($value)
 * @method static CachedBuilder<static>|LimeSurvey whereAdminemail($value)
 * @method static CachedBuilder<static>|LimeSurvey whereAlloweditaftercompletion($value)
 * @method static CachedBuilder<static>|LimeSurvey whereAllowprev($value)
 * @method static CachedBuilder<static>|LimeSurvey whereAllowregister($value)
 * @method static CachedBuilder<static>|LimeSurvey whereAllowsave($value)
 * @method static CachedBuilder<static>|LimeSurvey whereAnonymized($value)
 * @method static CachedBuilder<static>|LimeSurvey whereAssessments($value)
 * @method static CachedBuilder<static>|LimeSurvey whereAttributedescriptions($value)
 * @method static CachedBuilder<static>|LimeSurvey whereAutonumberStart($value)
 * @method static CachedBuilder<static>|LimeSurvey whereAutoredirect($value)
 * @method static CachedBuilder<static>|LimeSurvey whereBounceEmail($value)
 * @method static CachedBuilder<static>|LimeSurvey whereBounceaccountencryption($value)
 * @method static CachedBuilder<static>|LimeSurvey whereBounceaccounthost($value)
 * @method static CachedBuilder<static>|LimeSurvey whereBounceaccountpass($value)
 * @method static CachedBuilder<static>|LimeSurvey whereBounceaccounttype($value)
 * @method static CachedBuilder<static>|LimeSurvey whereBounceaccountuser($value)
 * @method static CachedBuilder<static>|LimeSurvey whereBounceprocessing($value)
 * @method static CachedBuilder<static>|LimeSurvey whereBouncetime($value)
 * @method static CachedBuilder<static>|LimeSurvey whereDatecreated($value)
 * @method static CachedBuilder<static>|LimeSurvey whereDatestamp($value)
 * @method static CachedBuilder<static>|LimeSurvey whereEmailnotificationto($value)
 * @method static CachedBuilder<static>|LimeSurvey whereEmailresponseto($value)
 * @method static CachedBuilder<static>|LimeSurvey whereExpires($value)
 * @method static CachedBuilder<static>|LimeSurvey whereFaxto($value)
 * @method static CachedBuilder<static>|LimeSurvey whereFormat($value)
 * @method static CachedBuilder<static>|LimeSurvey whereGoogleanalyticsapikey($value)
 * @method static CachedBuilder<static>|LimeSurvey whereGoogleanalyticsstyle($value)
 * @method static CachedBuilder<static>|LimeSurvey whereGsid($value)
 * @method static CachedBuilder<static>|LimeSurvey whereHtmlemail($value)
 * @method static CachedBuilder<static>|LimeSurvey whereIpaddr($value)
 * @method static CachedBuilder<static>|LimeSurvey whereIpanonymize($value)
 * @method static CachedBuilder<static>|LimeSurvey whereLanguage($value)
 * @method static CachedBuilder<static>|LimeSurvey whereListpublic($value)
 * @method static CachedBuilder<static>|LimeSurvey whereNavigationdelay($value)
 * @method static CachedBuilder<static>|LimeSurvey whereNokeyboard($value)
 * @method static CachedBuilder<static>|LimeSurvey whereOwnerId($value)
 * @method static CachedBuilder<static>|LimeSurvey wherePrintanswers($value)
 * @method static CachedBuilder<static>|LimeSurvey wherePublicgraphs($value)
 * @method static CachedBuilder<static>|LimeSurvey wherePublicstatistics($value)
 * @method static CachedBuilder<static>|LimeSurvey whereQuestionindex($value)
 * @method static CachedBuilder<static>|LimeSurvey whereRefurl($value)
 * @method static CachedBuilder<static>|LimeSurvey whereSavetimings($value)
 * @method static CachedBuilder<static>|LimeSurvey whereSendconfirmation($value)
 * @method static CachedBuilder<static>|LimeSurvey whereShowgroupinfo($value)
 * @method static CachedBuilder<static>|LimeSurvey whereShownoanswer($value)
 * @method static CachedBuilder<static>|LimeSurvey whereShowprogress($value)
 * @method static CachedBuilder<static>|LimeSurvey whereShowqnumcode($value)
 * @method static CachedBuilder<static>|LimeSurvey whereShowsurveypolicynotice($value)
 * @method static CachedBuilder<static>|LimeSurvey whereShowwelcome($value)
 * @method static CachedBuilder<static>|LimeSurvey whereShowxquestions($value)
 * @method static CachedBuilder<static>|LimeSurvey whereSid($value)
 * @method static CachedBuilder<static>|LimeSurvey whereStartdate($value)
 * @method static CachedBuilder<static>|LimeSurvey whereTemplate($value)
 * @method static CachedBuilder<static>|LimeSurvey whereTokenanswerspersistence($value)
 * @method static CachedBuilder<static>|LimeSurvey whereTokenencryptionoptions($value)
 * @method static CachedBuilder<static>|LimeSurvey whereTokenlength($value)
 * @method static CachedBuilder<static>|LimeSurvey whereUsecaptcha($value)
 * @method static CachedBuilder<static>|LimeSurvey whereUsecookie($value)
 * @method static CachedBuilder<static>|LimeSurvey whereUsetokens($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder<static>|LimeSurvey withCacheCooldownSeconds(?int $seconds = null)
 *
 * @mixin \Eloquent
 */
class LimeSurvey extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_surveys';

    /** @var string */
    protected $primaryKey = 'sid';

    /** @var array<int, string> */
    protected $fillable = [
        'owner_id',
        'gsid',
        'admin',
        'active',
        'expires',
        'startdate',
        'adminemail',
        'anonymized',
        'faxto',
        'format',
        'savetimings',
        'template',
        'language',
        'additional_languages',
        'datestamp',
        'usecookie',
        'allowregister',
        'allowsave',
        'autonumber_start',
        'autoredirect',
        'allowprev',
        'printanswers',
        'ipaddr',
        'refurl',
        'datecreated',
        'showsurveypolicynotice',
        'publicstatistics',
        'publicgraphs',
        'listpublic',
        'htmlemail',
        'sendconfirmation',
        'tokenanswerspersistence',
        'assessments',
        'usecaptcha',
        'usetokens',
        'bounce_email',
        'attributedescriptions',
        'emailresponseto',
        'emailnotificationto',
        'tokenlength',
        'showxquestions',
        'showgroupinfo',
        'shownoanswer',
        'showqnumcode',
        'bouncetime',
        'bounceprocessing',
        'bounceaccounttype',
        'bounceaccounthost',
        'bounceaccountpass',
        'bounceaccountencryption',
        'bounceaccountuser',
        'showwelcome',
        'showprogress',
        'questionindex',
        'navigationdelay',
        'nokeyboard',
        'alloweditaftercompletion',
        'googleanalyticsstyle',
        'googleanalyticsapikey',
    ];

    /** @var array<int, string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'sid' => 'int',
        'owner_id' => 'int',
        'gsid' => 'int',
        'admin' => 'string',
        'active' => 'string',
        'expires' => 'datetime',
        'startdate' => 'datetime',
        'adminemail' => 'string',
        'anonymized' => 'string',
        'faxto' => 'string',
        'format' => 'string',
        'savetimings' => 'string',
        'template' => 'string',
        'language' => 'string',
        'additional_languages' => 'string',
        'datestamp' => 'string',
        'usecookie' => 'string',
        'allowregister' => 'string',
        'allowsave' => 'string',
        'autonumber_start' => 'int',
        'autoredirect' => 'string',
        'allowprev' => 'string',
        'printanswers' => 'string',
        'ipaddr' => 'string',
        'refurl' => 'string',
        'datecreated' => 'datetime',
        'showsurveypolicynotice' => 'int',
        'publicstatistics' => 'string',
        'publicgraphs' => 'string',
        'listpublic' => 'string',
        'htmlemail' => 'string',
        'sendconfirmation' => 'string',
        'tokenanswerspersistence' => 'string',
        'assessments' => 'string',
        'usecaptcha' => 'string',
        'usetokens' => 'string',
        'bounce_email' => 'string',
        'attributedescriptions' => 'array',
        'emailresponseto' => 'string',
        'emailnotificationto' => 'string',
        'tokenlength' => 'int',
        'showxquestions' => 'string',
        'showgroupinfo' => 'string',
        'shownoanswer' => 'string',
        'showqnumcode' => 'string',
        'bouncetime' => 'int',
        'bounceprocessing' => 'string',
        'bounceaccounttype' => 'string',
        'bounceaccounthost' => 'string',
        'bounceaccountpass' => 'string',
        'bounceaccountencryption' => 'string',
        'bounceaccountuser' => 'string',
        'showwelcome' => 'string',
        'showprogress' => 'string',
        'questionindex' => 'int',
        'navigationdelay' => 'int',
        'nokeyboard' => 'string',
        'alloweditaftercompletion' => 'string',
        'googleanalyticsstyle' => 'string',
        'googleanalyticsapikey' => 'string',
        'tokenencryptionoptions' => 'array',
    ];

    // Scopes...
    // Relations ...
    /**
     * @return \Illuminate\Database\Eloquent\Collection|array<LimeQuestion>
     */
    public function questions(): HasMany
    {
        return $this->hasMany(LimeQuestion::class, 'sid', 'sid');
    }

    public function groups(): HasMany
    {
        if (env('LIMEVERSION') >= 5) {
            return $this->hasMany(LimeGroup::class, 'sid', 'sid')
                ->with('labels');
        }

        return $this->hasMany(LimeGroup::class, 'sid', 'sid');
        // ->with('labels')
    }

    public function groups_l10n(): HasManyThrough
    {
        return $this->hasManyThrough(LimeGroupL10n::class, LimeGroup::class, 'sid', 'gid');
    }

    public function lang(): HasOne
    {
        return $this->hasOne(LimeSurveysLanguagesetting::class, 'surveyls_survey_id', 'sid');
    }

    // --- mutators ---
    public function getTitleAttribute(?string $value): ?string
    {
        return optional($this->lang)->surveyls_title;
    }

    /**
     * Undocumented function.
     */
    public function getAttributedescriptionsAttribute(string|array|null $value): array
    {
        if ($value === null) {
            return [];
        }

        if (is_array($value)) {
            return $value;
        }

        if (isJson($value)) {
            return json_decode($value, true, 512, JSON_THROW_ON_ERROR);
        }

        dddx($value);
    }

    public function getTrans(): array
    {
        $attribute = $this->attributedescriptions;
        $trans = [];
        foreach ($attribute as $k => $v) {
            if (! isset($v['description'])) {
                continue;
            }
            if ($v['description'] === '') {
                continue;
            }
            $trans[$k] = $v['description'] ?? '';
        }

        return $trans;
    }

    // Functions ...
    public function answers(): Collection
    {
        // dddx($this->sid);
        $model_class = \Modules\LimeSurvey\Models\LimeSurvey::class.$this->sid;
        $model = app($model_class);
        // $fillable=$model->getFillable();
        // dddx($fillable);
        /*
        $trans=collect($fillable)->filter(function($item,$k){
            $piece=explode('X',$item);
            return $piece[0]==$this->sid;
        });

        dddx($trans);
        */
        $rows = $model->where('submitdate', '!=', null)->get();
        $rows = collect($rows->toArray());
        // dddx($this->questions);
        $questions = $this->questions->pluck('title', 'qid')->all();
        $first_row = $rows->first();
        $head = collect($first_row)->map(function ($item, $key) use ($questions) {
            $piece = explode('X', $key);
            if ($piece[0] === $this->sid) {
                $qid[0] = $piece[2];
                $qid[1] = '';
                if (Str::contains($piece[2], 'oth')) {
                    $qid[0] = Str::before($piece[2], 'oth');
                    $qid[1] = 'oth'.Str::after($piece[2], 'oth');
                }

                if (Str::contains($piece[2], 'SQ0')) {
                    $qid[0] = Str::before($piece[2], 'SQ0');
                    $qid[1] = 'SQ0'.Str::after($piece[2], 'SQ0');
                }

                $key = $questions[$qid[0]];

                if ($qid[1] !== '') {
                    $key .= '['.$qid[1].']';
                }
            }

            return $key;
        })->values()
            ->all();

        // dddx($head);

        /*
        $rows=$rows->map(function($item) use($questions){
            $item=collect($item)->mapWithKeys(function($field,$key) use($questions){
                $piece=explode('X',$key);
                if($piece[0]==$this->sid){
                    $qid[0]=$piece[2];
                    $qid[1]='';
                    if(Str::contains($piece[2],'oth')){
                        $qid[0]=Str::before($piece[2],'oth');
                        $qid[1]='oth'.Str::after($piece[2],'oth');
                    }
                    if(Str::contains($piece[2],'SQ0')){
                        $qid[0]=Str::before($piece[2],'SQ0');
                        $qid[1]='SQ0'.Str::after($piece[2],'SQ0');
                    }

                    $key=$questions[$qid[0]];

                    if($qid[1]!=''){
                        $key.='['.$qid[1].']';
                    }

                }

                return [$key=>$field];
            });
            return $item;
        });
        */

        $rows = $rows->map(static fn ($item): stdClass => (object) array_combine($head, $item));

        // dddx($rows->first()->{'Q11'});

        return $rows;
    }
}
