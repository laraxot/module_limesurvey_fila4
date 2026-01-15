<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Modules\Quaeris\Models\Profile;
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
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read string|null $title
 * @property-read \Illuminate\Database\Eloquent\Collection<int, LimeGroup> $groups
 * @property-read int|null $groups_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, LimeGroupL10n> $groups_l10n
 * @property-read int|null $groups_l10n_count
 * @property-read LimeSurveysLanguagesetting|null $lang
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, LimeQuestion> $questions
 * @property-read int|null $questions_count
 * @property-read Profile|null $updater
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

    /** @var list<string> */
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

    /** @var list<string> */
    protected $hidden = [
    ];

    // Scopes...
    // Relations ...
    public function lang(): HasOne
    {
        return $this->hasOne(LimeSurveysLanguagesetting::class, 'surveyls_survey_id', 'sid')
            ->whereColumn('surveyls_language', 'language');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<\Modules\Limesurvey\Models\LimeQuestion, static>
     */
    public function questions(): HasMany
    {
        // @phpstan-ignore-next-line return.type
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

    // ... (skipping some lines) ...

    // Functions ...
    /**
     * @return array<string, string>
     */
    public function getTrans(): array
    {
        return [];
    }

    public function answers(): Collection
    {
        // dddx($this->sid);
        $model_class = \Modules\Limesurvey\Models\LimeSurvey::class.$this->sid;
        /** @var \Illuminate\Database\Eloquent\Model $model */
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
        if ($first_row === null) {
            return collect([]);
        }
        /** @var array<string, mixed> $first_row */
        $head = collect($first_row)->map(function ($item, $key) use ($questions): string {
            $piece = explode('X', (string) $key);
            if ($piece[0] === (string) $this->sid) {
                $qid = [$piece[2] ?? '', ''];
                if (Str::contains($piece[2] ?? '', 'oth')) {
                    $qid[0] = Str::before($piece[2] ?? '', 'oth');
                    $qid[1] = 'oth'.Str::after($piece[2] ?? '', 'oth');
                }

                if (Str::contains($piece[2] ?? '', 'SQ0')) {
                    $qid[0] = Str::before($piece[2] ?? '', 'SQ0');
                    $qid[1] = 'SQ0'.Str::after($piece[2] ?? '', 'SQ0');
                }

                $key = (string) ($questions[$qid[0]] ?? $key);

                if ($qid[1] !== '') {
                    $key .= '['.$qid[1].']';
                }
            }

            return (string) $key;
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

        $rows = $rows->map(static fn ($item): stdClass => (object) array_combine($head, (array) $item));

        // dddx($rows->first()->{'Q11'});

        return $rows;
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
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
    }
}
