<div class="post">
    <p class="text-center">
        <a target="_blank" href="{{ isset($bloc->lien) && !empty($bloc->lien) ? $bloc->lien : url('/') }}">
            <img style="max-width: 560px;" alt="{{ $bloc->titre }}" src="{{ $bloc->image }}" />
        </a>
    </p>
    <div class="post-title">
        <h2 class="title">{{ $bloc->titre }}</h2>
    </div>
    <span class="clear"></span>
</div>
