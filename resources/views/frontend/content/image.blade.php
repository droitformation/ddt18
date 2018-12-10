<div class="post">
    <p class="text-left">
        <a target="_blank" href="{{ isset($bloc->lien) && !empty($bloc->lien) ? $bloc->lien : url('/') }}">
            <img style="max-width: 560px;" alt="{{ $bloc->titre }}" src="{{ $bloc->image }}" />
        </a>
    </p>
    <div class="post-title">
        <h3 class="title">{{ $bloc->titre }}</h3>
    </div>
    <span class="clear"></span>
</div>
