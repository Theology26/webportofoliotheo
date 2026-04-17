<button {{ $attributes->merge(['type' => 'submit', 'class' => 'glass-button']) }}>
    {{ $slot }}
</button>
