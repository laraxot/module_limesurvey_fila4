<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Modules\Limesurvey\Database\Factories\LimeSurveysLanguagesettingFactory;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeSurveysLanguagesetting
 *
 * @method static LimeSurveysLanguagesettingFactory factory($count = null, $state = [])
 *
 * @property int $surveyls_survey_id
 * @property string $surveyls_language
 * @property string $surveyls_title
 * @property string|null $surveyls_description
 * @property string|null $surveyls_welcometext
 * @property string|null $surveyls_endtext
 * @property string|null $surveyls_policy_notice
 * @property string|null $surveyls_policy_error
 * @property string|null $surveyls_policy_notice_label
 * @property string|null $surveyls_url
 * @property string|null $surveyls_urldescription
 * @property string|null $surveyls_email_invite_subj
 * @property string|null $surveyls_email_invite
 * @property string|null $surveyls_email_remind_subj
 * @property string|null $surveyls_email_remind
 * @property string|null $surveyls_email_register_subj
 * @property string|null $surveyls_email_register
 * @property string|null $surveyls_email_confirm_subj
 * @property string|null $surveyls_email_confirm
 * @property int $surveyls_dateformat
 * @property string|null $surveyls_attributecaptions
 * @property string|null $email_admin_notification_subj
 * @property string|null $email_admin_notification
 * @property string|null $email_admin_responses_subj
 * @property string|null $email_admin_responses
 * @property int $surveyls_numberformat
 * @property string|null $attachments
 *
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeSurveysLanguagesetting extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_surveys_languagesettings';

    /** @var string */
    protected $primaryKey = 'surveyls_survey_id';

    /** @var list<string> */
    protected $fillable = [
        'surveyls_survey_id',
        'surveyls_language', 'surveyls_title', 'surveyls_description', 'surveyls_welcometext', 'surveyls_endtext', 'surveyls_policy_notice', 'surveyls_policy_error', 'surveyls_policy_notice_label', 'surveyls_url', 'surveyls_urldescription', 'surveyls_email_invite_subj', 'surveyls_email_invite', 'surveyls_email_remind_subj', 'surveyls_email_remind', 'surveyls_email_register_subj', 'surveyls_email_register', 'surveyls_email_confirm_subj', 'surveyls_email_confirm', 'surveyls_dateformat', 'surveyls_attributecaptions', 'email_admin_notification_subj', 'email_admin_notification', 'email_admin_responses_subj', 'email_admin_responses', 'surveyls_numberformat', 'attachments',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'surveyls_survey_id' => 'int', 'surveyls_language' => 'string', 'surveyls_title' => 'string', 'surveyls_description' => 'string', 'surveyls_welcometext' => 'string', 'surveyls_endtext' => 'string', 'surveyls_policy_notice' => 'string', 'surveyls_policy_error' => 'string', 'surveyls_policy_notice_label' => 'string', 'surveyls_url' => 'string', 'surveyls_urldescription' => 'string', 'surveyls_email_invite_subj' => 'string', 'surveyls_email_invite' => 'string', 'surveyls_email_remind_subj' => 'string', 'surveyls_email_remind' => 'string', 'surveyls_email_register_subj' => 'string', 'surveyls_email_register' => 'string', 'surveyls_email_confirm_subj' => 'string', 'surveyls_email_confirm' => 'string', 'surveyls_dateformat' => 'int', 'surveyls_attributecaptions' => 'string', 'email_admin_notification_subj' => 'string', 'email_admin_notification' => 'string', 'email_admin_responses_subj' => 'string', 'email_admin_responses' => 'string', 'surveyls_numberformat' => 'int', 'attachments' => 'string',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array<string>
     */
    protected $dates = [
    ];

    // Scopes...

    // Functions ...

    // Relations ...
}
