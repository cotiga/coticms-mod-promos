# coticms-mod-promos

Module de promotions datées pour CotiCMS : blocs promotionnels affichés dans une **modal d'accueil** (auto-popup, 1×/session).

## Installation

```bash
php artisan cotiga:module:install cotiga/module-promos
```

Puis activer le module dans **Paramètres système → Activation des modules → Module Promotions**.

## Modèle

`Cotiga\ModulePromos\Models\Promo` — `titre`, `contenu` (TinyMCE), `date_debut`, `date_fin`, `onl`.

Scope `active()` : en ligne ∩ dans la période (date null = borne ouverte), triées par `updated_at` desc.

```php
Promo::active()->get();
```

## Affichage (thème)

Composant Blade à placer dans le layout / la home :

```blade
<x-promos::modal />
```

- Si plusieurs promos actives → carrousel Bootstrap dans la modal.
- Auto-popup au chargement, mémorisé par session (`sessionStorage`), ré-affiché si une promo change.
- Le contenu TinyMCE est rendu dans `<div class="cotinymce">`.
