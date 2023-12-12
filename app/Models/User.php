<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Exception;
use App\Traits\HasCredit;
use App\Traits\HasAuthorization;
use Illuminate\Auth\Events\Login;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasCredit, HasAuthorization;

    protected $with = ['roles'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'credit', // Should be removed
        'password',
        'ip', // Should be removed
        'avatar',
        'avatar_bg',
        'cover',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the route key name for Laravel.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'username';
    }

    /**
     * Get the user's profile.
     */
    public function profile(): HasOne
    {
        return $this->hasOne(
            related: Profile::class,
            foreignKey: 'user_id',
        );
    }

    /**
     * Get the users login history.
     */
    public function logins(): HasMany
    {
        return $this->hasMany(
            related: Login::class,
            foreignKey: 'user_id',
        );
    }

    /**
     * Get the user's topics.
     */
    public function topics(): HasMany
    {
        return $this->hasMany(
            related: Topic::class,
            foreignKey: 'user_id',
        );
    }

    /**
     * Get the user's posts.
     */
    public function posts(): HasMany
    {
        return $this->hasMany(
            related: Post::class,
            foreignKey: 'user_id',
        );
    }

    /**
     * Get the user's groups.
     */
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Group::class,
            table: 'group_user',
            foreignPivotKey: 'user_id',
            relatedPivotKey: 'group_id',
        );
    }

    /**
     * The roles that belong to the user.
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Role::class,
            table: 'role_user',
            foreignPivotKey: 'user_id',
            relatedPivotKey: 'role_id',
        );
    }

    /**
     * User awards.
     */
    public function awards(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Award::class,
            table: 'user_awards',
            foreignPivotKey: 'user_id',
            relatedPivotKey: 'award_id',
        )->withTimestamps()->withPivot('awarded_at');
    }

    /**
     * Get the user's vouches
     */
    public function vouches(): HasMany
    {
        return $this->hasMany(
            related: Vouch::class,
            foreignKey: 'user_id',
        );
    }

    /**
     * Get the user's reputations.
     */
    public function reputations(): HasMany
    {
        return $this->hasMany(
            related: Reputation::class,
            foreignKey: 'user_id',
        );
    }

    /**
     * Get the user's likes.
     */
    public function likes(): HasMany
    {
        return $this->hasMany(
            related: Like::class,
            foreignKey: 'user_id',
        );
    }

    /**
     *
     */
    public function displayedGroup()
    {
        return $this->belongsTo(Group::class, 'display_group_id');
    }

    /**
     * Update the user's avatar.
     */
    public function updateAvatar(string $avatar): void
    {
        $this->avatar = $avatar;
        $this->save();
    }

    /**
     * Update the user's cover.
     */
    public function updateCover(string $cover): void
    {
        $this->cover = $cover;
        $this->save();
    }

    public function scopeWithProfileData($query)
    {
        return $query->with([
            'roles', // Add this line to eager-load the roles relationship
            'profileVisits.visitor:id,username',
            'groups',
            'posts' => function ($query) {
                $query->select('id', 'user_id', 'topic_id', 'content', 'created_at')
                    ->withTopicAndCategory()
                    ->latest()
                    ->limit(5);
            },
            'awards:name,icon',
            'topics' => function ($query) {
                $query->select('id', 'user_id', 'category_id', 'title', 'slug', 'created_at')
                    ->withCategory()
                    ->latest()
                    ->limit(5);
            },
        ]);
    }

    /**
     * Scope a query to include the user's last login.
     */
    public function scopeWithLastLoginAt($query)
    {
        $query->addSelect([
            'last_login_at' => Login::select('created_at')
                ->whereColumn('user_id', 'users.id')
                ->latest()
                ->take(1)
        ])
            ->withCasts(['last_login_at' => 'datetime']);
    }

    /**
     * Get the user's latest topics.
     */
    public function latestTopics(int $amount = 5)
    {
        return $this->topics()->latest()->take($amount)->get();
    }

    public function profileVisits()
    {
        return $this->hasMany(ProfileVisit::class, 'profile_id');
    }

    public function visitedProfiles()
    {
        return $this->hasMany(ProfileVisit::class, 'visitor_id');
    }

    /**
     * Scope a query to only include users with the given role. && NOT....
     */
    public function scopeAdminsAndModerators($query)
    {
        return $query->whereHas('roles', function ($query) {
            $query->whereIn('name', ['admin', 'moderator']);
        });
    }

    /**
     * Scope a query to only include online users.
     */
    public function scopeOnline($query)
    {
        $onlineThreshold = now()->subMinutes(5); // Users active within the last 5 minutes
        return $query->where('last_activity', '>=', $onlineThreshold);
    }

    /**
     * Get the user's latest replies.
     */
    public function latestPosts(int $amount = 10)
    {
        return $this->posts()->latest()->take($amount)->get();
    }

    /**
     * Get the user's latest reputation.
     */
    public function latestReputation(int $amount = 5)
    {
        return $this->reputations()->latest()->take($amount)->get();
    }

    public function totalReputation()
    {
        return $this->reputations->sum('points');
    }

    public function pastAvatars()
    {
        return $this->hasMany(PastAvatar::class);
    }

    public function vouchedBy()
    {
        return $this->belongsToMany(User::class, 'vouches', 'user_id', 'vouched_by')->withTimestamps();
    }

    public function likedPosts()
    {
        return $this->belongsToMany(Post::class, 'likes', 'user_id', 'post_id')->withTimestamps() ?: collect([]);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function mentions()
    {
        return $this->hasMany(Mention::class);
    }

    public function mentionedIn()
    {
        return $this->hasMany(Mention::class, 'mentioned_user_id');
    }

    public function vouchesReceived()
    {
        return $this->hasMany(Vouch::class, 'user_id');
    }

    public function vouchesGiven()
    {
        return $this->hasMany(Vouch::class, 'vouched_by');
    }

    public function viewedTopics()
    {
        return $this->belongsToMany(Topic::class, 'topic_user_views')->withTimestamps();
    }

    public function getTotalReputationAttribute()
    {
        return $this->reputations->count('points');
    }

    public function positiveReputations()
    {
        return $this->reputations()->where('points', '>', 0)->count();
    }

    public function negativeReputations()
    {
        return $this->reputations()->where('points', '<', 0)->count();
    }

    public function neutralReputations()
    {
        return $this->reputations()->where('points', '=', 0)->count();
    }

    public function positiveReputationsGiven()
    {
        return Reputation::where('giver_id', $this->id)->where('points', '>', 0)->count();
    }

    public function negativeReputationsGiven()
    {
        return Reputation::where('giver_id', $this->id)->where('points', '<', 0)->count();
    }

    public function neutralReputationsGiven()
    {
        return Reputation::where('giver_id', $this->id)->where('points', '=', 0)->count();
    }

    public function getLatestActivities($limit = 8)
    {
        $posts = $this->posts()->latest()->take($limit)->get();
        $topics = $this->topics()->latest()->take($limit)->get();

        $activities = $posts->merge($topics);
        $sortedActivities = $activities->sortByDesc('created_at')->take($limit);

        return $sortedActivities;
    }

    public function hasBeenOnlinePast15Minutes()
    {
        $past15Minutes = now()->subMinutes(15);
        return $this->last_login_at >= $past15Minutes;
    }

    public static function hasAnyUserLoggedIn()
    {
        return User::whereNotNull('last_login_at')->exists();
    }

    public function scopeLoggedInPast24Hours($query)
    {
        $past24Hours = now()->subDay();
        $columns = ['id', 'username']; // only select these columns

        return $query->select($columns)
            ->where('last_login_at', '>=', $past24Hours);
    }

    /**
     * Assign a role to the user.
     */
    public function assignRole($roleName): void
    {
        $role = Role::where('name', $roleName)->first();

        if ($role) {
            $this->roles()->attach($role);
        } else {
            throw new Exception("Role not found.");
        }
    }

    /**
     * Check if the user is in the given group.
     */
    public function isInGroup($groupName): bool
    {
        return $this->groups->contains('name', $groupName);
    }

    /**
     * Determine if the user has the given role.
     */
    public function getUsernameColor(): string
    {
        // If the user has set a custom color, use that color
        if (!empty($this->username_color)) {
            return $this->username_color;
        }

        // If no custom color is set, use color based on the user's role
        if ($this->hasRole('admin')) {
            return '#EF4444';
        } elseif ($this->hasRole('moderator')) {
            return '#3B82F6';
        } else {
            return '#9CA3AF';
        }
    }

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (!$user->avatar) {
                $user->avatar = 'https://ui-avatars.com/api/' . implode('/', [
                    urlencode($user->username),
                    200, // image size
                    // '1e1a1f', // background color
                    '7F9CF5', // font color
                ]);
            }
        });

        static::deleting(function ($user) {
            $user->posts->each(function ($post) {
                $post->delete();
            });
            $user->topics->each(function ($topic) {
                $topic->delete();
            });
            $user->reputations->each(function ($reputation) {
                $reputation->delete();
            });
            $user->vouches->each(function ($vouch) {
                $vouch->delete();
            });
        });
    }
}
