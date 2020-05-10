<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Package
 *
 * @property int $id
 * @property string $name
 * @property int $site_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Page[] $pages
 * @property-read int|null $pages_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $participants
 * @property-read int|null $participants_count
 * @property-read \App\Models\Site $site
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Package newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Package newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Package query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Package whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Package whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Package whereSiteId($value)
 */
	class Package extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Question
 *
 * @property int $id
 * @property string $text
 * @property string $type
 * @property mixed $data
 * @property int $page_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $answerers
 * @property-read int|null $answerers_count
 * @property-read \App\Models\Page $page
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereType($value)
 */
	class Question extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property string $role
 * @property string|null $phone
 * @property string|null $profile_url
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Site[] $participations
 * @property-read int|null $participations_count
 * @property-read \App\Models\Site|null $site
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereProfileUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

namespace App\Models{
/**
 * App\Models\Page
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $package_id
 * @property int $order
 * @property int $allow_previous
 * @property int $allow_next
 * @property-read \App\Models\Package $package
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereAllowNext($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereAllowPrevious($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page wherePackageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereTitle($value)
 */
	class Page extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Site
 *
 * @property int $id
 * @property string $domain
 * @property string $title
 * @property string|null $welcome_message
 * @property string|null $privacy_policy
 * @property int $user_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $participants
 * @property-read int|null $participants_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Site newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Site newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Site query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Site whereDomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Site whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Site wherePrivacyPolicy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Site whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Site whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Site whereWelcomeMessage($value)
 */
	class Site extends \Eloquent {}
}

