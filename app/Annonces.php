<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $titre
 * @property string $description
 * @property string $photographie
 * @property int $prix
 */
class Annonces extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['titre', 'description', 'photographie', 'prix'];
}
