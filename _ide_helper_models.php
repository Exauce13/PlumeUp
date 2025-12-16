<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property int $subscriber_id
 * @property int $author_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Abonnement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Abonnement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Abonnement query()
 * @method static \Illuminate\Database\Eloquent\Builder|Abonnement whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Abonnement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Abonnement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Abonnement whereSubscriberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Abonnement whereUpdatedAt($value)
 */
	class Abonnement extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $histoire_id
 * @property int $numerochapitre
 * @property string $titre_chapitre
 * @property string $url_chapitre
 * @property int $is_published
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\HistoireModel $histoire
 * @method static \Illuminate\Database\Eloquent\Builder|ChapitreModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChapitreModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChapitreModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChapitreModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChapitreModel whereHistoireId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChapitreModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChapitreModel whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChapitreModel whereNumerochapitre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChapitreModel whereTitreChapitre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChapitreModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChapitreModel whereUrlChapitre($value)
 */
	class ChapitreModel extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property int $histoire_id
 * @property int|null $parent_id
 * @property string $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, CommentaireModel> $children
 * @property-read int|null $children_count
 * @property-read \App\Models\HistoireModel|null $histoire
 * @property-read CommentaireModel|null $parent
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|CommentaireModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommentaireModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommentaireModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|CommentaireModel whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommentaireModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommentaireModel whereHistoireId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommentaireModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommentaireModel whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommentaireModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommentaireModel whereUserId($value)
 */
	class CommentaireModel extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property int $histoire_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\HistoireModel|null $histoire
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|DislikesModels newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DislikesModels newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DislikesModels query()
 * @method static \Illuminate\Database\Eloquent\Builder|DislikesModels whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DislikesModels whereHistoireId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DislikesModels whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DislikesModels whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DislikesModels whereUserId($value)
 */
	class DislikesModels extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $expediteur
 * @property int $destinataire
 * @property int $is_friends
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FriendModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FriendModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FriendModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|FriendModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FriendModel whereDestinataire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FriendModel whereExpediteur($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FriendModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FriendModel whereIsFriends($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FriendModel whereUpdatedAt($value)
 */
	class FriendModel extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property string $titre_book
 * @property string $type_book
 * @property string|null $url_book
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $photos
 * @property string $modediffusion
 * @property string|null $album
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ChapitreModel> $chapdiffusion
 * @property-read int|null $chapdiffusion_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CommentaireModel> $commentaires
 * @property-read int|null $commentaires_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DislikesModels> $dislikes
 * @property-read int|null $dislikes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ImageChapitre> $imageschapitres
 * @property-read int|null $imageschapitres_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LikesModels> $likes
 * @property-read int|null $likes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LireModel> $nbrlecture
 * @property-read int|null $nbrlecture_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|HistoireModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HistoireModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HistoireModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|HistoireModel whereAlbum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoireModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoireModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoireModel whereModediffusion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoireModel wherePhotos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoireModel whereTitreBook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoireModel whereTypeBook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoireModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoireModel whereUrlBook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HistoireModel whereUserId($value)
 */
	class HistoireModel extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $histoire_id
 * @property string $titre
 * @property int $numerochapitre
 * @property string $image_path
 * @property int $ordre
 * @property int $is_published
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\HistoireModel $histoire
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|ImageChapitre newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImageChapitre newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImageChapitre query()
 * @method static \Illuminate\Database\Eloquent\Builder|ImageChapitre whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImageChapitre whereHistoireId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImageChapitre whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImageChapitre whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImageChapitre whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImageChapitre whereNumerochapitre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImageChapitre whereOrdre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImageChapitre whereTitre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImageChapitre whereUpdatedAt($value)
 */
	class ImageChapitre extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property int $histoire_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\HistoireModel|null $histoire
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|LikesModels newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LikesModels newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LikesModels query()
 * @method static \Illuminate\Database\Eloquent\Builder|LikesModels whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LikesModels whereHistoireId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LikesModels whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LikesModels whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LikesModels whereUserId($value)
 */
	class LikesModels extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property int $histoire_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\HistoireModel|null $histoire
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|LireModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LireModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LireModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|LireModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LireModel whereHistoireId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LireModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LireModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LireModel whereUserId($value)
 */
	class LireModel extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $from_id
 * @property int $to_id
 * @property string $content
 * @property string|null $read_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|MessagerieModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MessagerieModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MessagerieModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|MessagerieModel whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessagerieModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessagerieModel whereFromId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessagerieModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessagerieModel whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessagerieModel whereToId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessagerieModel whereUpdatedAt($value)
 */
	class MessagerieModel extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $pseudo
 * @property mixed $password
 * @property string $avatar
 * @property string $statut
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $is_suspended
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $abonnements
 * @property-read int|null $abonnements_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $abonnes
 * @property-read int|null $abonnes_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|User authors()
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User readers()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsSuspended($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePseudo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

