<?php

namespace Cotiga\ModulePromos\Models;

use Cotiga\CotiCmsCore\Traits\HasActivityLog;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasActivityLog;

    protected $table = 'promos';

    protected string $activityLabelAttribute = 'titre';

    protected $fillable = [
        'titre', 'contenu', 'date_debut', 'date_fin', 'onl',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'onl' => 'boolean',
    ];

    /**
     * Promotions en ligne et dans leur période de validité.
     * Une date null = borne ouverte (pas de début / pas de fin).
     */
    public function scopeActive(Builder $query): Builder
    {
        $today = now()->toDateString();

        return $query->where('onl', true)
            ->where(fn (Builder $q) => $q->whereNull('date_debut')->orWhereDate('date_debut', '<=', $today))
            ->where(fn (Builder $q) => $q->whereNull('date_fin')->orWhereDate('date_fin', '>=', $today))
            ->orderByDesc('updated_at');
    }
}
