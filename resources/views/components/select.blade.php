<!-- resources/views/components/select.blade.php -->
<select {{ $attributes->merge(['class' => 'form-select']) }}>
    {{ $slot }}
</select>
