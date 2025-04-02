@if (count(config('panel.available_languages', [])) > 1)
    <div class="row">
        @foreach (config('panel.available_languages') as $langLocale => $langName)
            <div class="form-group col">
                <a class="dropdown-item @if(currentEditingLang() == $langLocale) active-switch-lang @endif"
                    href="{{ url()->current() }}?lang={{ $langLocale }}">
                    {{ $langName }}
                </a>
            </div>
        @endforeach
    </div>
@endif
