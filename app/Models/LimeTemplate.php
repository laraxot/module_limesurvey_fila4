<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Modules\Limesurvey\Database\Factories\LimeTemplateFactory;
use Modules\Quaeris\Datas\AnswersFilterData;
use Modules\Quaeris\Models\Profile;

/**
 * Modules\Limesurvey\Models\LimeTemplate
 *
 * @method static LimeTemplateFactory factory($count = null, $state = [])
 *
 * @property int $id
 * @property string $name
 * @property string|null $folder
 * @property string $title
 * @property Carbon|null $creation_date
 * @property string|null $author
 * @property string|null $author_email
 * @property string|null $author_url
 * @property string|null $copyright
 * @property string|null $license
 * @property string|null $version
 * @property string $api_version
 * @property string $view_folder
 * @property string $files_folder
 * @property string|null $description
 * @property Carbon|null $last_update
 * @property int|null $owner_id
 * @property string|null $extends
 *
 *
 * @property-read Profile|null $creator
 * @property-read Extra|null $extra
 * @property-read Profile|null $updater
 *
 * @mixin \Eloquent
 */
class LimeTemplate extends BaseModel
{
    /** @var bool */
    public $timestamps = true;

    /** @var string */
    protected $table = 'lime_templates';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var list<string> */
    protected $fillable = [
        'name', 'folder', 'title', 'creation_date', 'author', 'author_email', 'author_url', 'copyright', 'license', 'version', 'api_version', 'view_folder', 'files_folder', 'description', 'last_update', 'owner_id', 'extends',
    ];

    /** @var list<string> */
    protected $hidden = [
    ];

    /** @return array<string, string>     */
    protected $casts = [
        'id' => 'int', 'name' => 'string', 'folder' => 'string', 'title' => 'string', 'creation_date' => 'datetime', 'author' => 'string', 'author_email' => 'string', 'author_url' => 'string', 'copyright' => 'string', 'license' => 'string', 'version' => 'string', 'api_version' => 'string', 'view_folder' => 'string', 'files_folder' => 'string', 'description' => 'string', 'last_update' => 'datetime', 'owner_id' => 'int', 'extends' => 'string',
    ];

    // Scopes...

    // Functions ...

    // Relations ...
}
