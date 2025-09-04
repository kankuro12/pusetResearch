@foreach($popups as $popup)
    <!-- Bootstrap modal for popup {{ $popup->id }} -->
    <div class="modal fade site-popup-modal" id="sitePopupModal{{ $popup->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <picture>
                        @if(!empty($popup->mobile_image))
                            <source media="(max-width:600px)" srcset="{{ asset($popup->mobile_image) }}">
                        @endif
                        @if(!empty($popup->desktop_image))
                            <img src="{{ asset($popup->desktop_image) }}" alt="popup" class="img-fluid site-popup-img" style="cursor:pointer;" data-link="{{ $popup->link }}">
                        @else
                            @if(!empty($popup->mobile_image))
                                <img src="{{ asset($popup->mobile_image) }}" alt="popup" class="img-fluid site-popup-img" style="cursor:pointer;" data-link="{{ $popup->link }}">
                            @endif
                        @endif
                    </picture>
                </div>
                @if(!empty($popup->link))
                <div class="modal-footer justify-content-center border-0">
                    <a href="{{ $popup->link }}" target="_blank" class="btn btn-primary">Go to link</a>
                </div>
                @endif
            </div>
        </div>
    </div>
@endforeach

<script>
    document.addEventListener('DOMContentLoaded', function(){
        // If bootstrap is available, create Modal instances and show them sequentially
        if(typeof bootstrap !== 'undefined'){
            const modalEls = Array.from(document.querySelectorAll('.site-popup-modal'));
            const modals = modalEls.map(el => new bootstrap.Modal(el, {keyboard:true}));
            let idx = 0;
            function showNext(){
                if(idx >= modals.length) return;
                const el = modalEls[idx];
                const m = modals[idx];
                el.addEventListener('hidden.bs.modal', function handler(){
                    el.removeEventListener('hidden.bs.modal', handler);
                    idx++;
                    showNext();
                });
                m.show();
            }
            if(modals.length > 0) showNext();
        }

        // Click on popup image opens the configured link in a new tab
        document.addEventListener('click', function(e){
            const img = e.target.closest('.site-popup-img');
            if(img && img.dataset.link){
                const link = img.dataset.link;
                if(link && link.trim() !== ''){
                    window.open(link, '_blank');
                }
            }
        });
    });
</script>
