@php
    use Cotiga\ModulePromos\Models\Promo;

    /** @var \Illuminate\Support\Collection<int,\Cotiga\ModulePromos\Models\Promo> $promos */
    $promos = Promo::active()->get();
    // Clé de session : ré-affiche la modal si une promo a changé.
    $sessionKey = 'promo-modal-'.$promos->max(fn ($p) => optional($p->updated_at)->timestamp);
@endphp

@if ($promos->isNotEmpty())
    <div class="modal fade" id="promoModal" tabindex="-1" aria-labelledby="promoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title h5 mb-0" id="promoModalLabel">{{ $promos->first()->titre ?: 'Offre en cours' }}</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    @if ($promos->count() > 1)
                        <div id="promoCarousel" class="carousel slide" data-bs-ride="false">
                            <div class="carousel-inner">
                                @foreach ($promos as $promo)
                                    <div class="carousel-item @if ($loop->first) active @endif">
                                        @if ($promo->titre && ! $loop->first)
                                            <p class="h5">{{ $promo->titre }}</p>
                                        @endif
                                        <div class="cotinymce">{!! $promo->contenu !!}</div>
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#promoCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Précédent</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#promoCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Suivant</span>
                            </button>
                        </div>
                    @else
                        <div class="cotinymce">{!! $promos->first()->contenu !!}</div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var key = @json($sessionKey);
            if (sessionStorage.getItem(key)) return;
            var el = document.getElementById('promoModal');
            if (el && window.bootstrap) {
                new bootstrap.Modal(el).show();
                sessionStorage.setItem(key, '1');
            }
        });
    </script>
    @endpush
@endif
