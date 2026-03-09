@php
    $settings = $gateway ? $gateway->getSettings() : [];

    if (empty($settings)) {
        $settings = [
            'secret'   => '',
            'receiver' => '',
            'testMode' => false,
        ];
    }
@endphp

<x-forms.field>
    <x-forms.label for="settings__secret" required>Секретный ключ:</x-forms.label>
    <x-fields.input name="settings__secret" id="settings__secret" type="password"
        value="{{ request()->input('settings__secret', $settings['secret']) }}"
        placeholder="Вставьте сюда секретный ключ" required />
</x-forms.field>

<x-forms.field>
    <x-forms.label for="settings__receiver" required>Номер кошелька:</x-forms.label>
    <x-fields.input name="settings__receiver" id="settings__receiver"
        value="{{ request()->input('settings__receiver', $settings['receiver']) }}"
        placeholder="Вставьте сюда номер кошелька" required />
</x-forms.field>

<x-forms.field>
    <x-forms.label for="settings__testMode">Тестовый режим:</x-forms.label>
    <x-fields.toggle name="settings__testMode" id="settings__testMode"
        checked="{{ request()->input('settings__testMode', $settings['testMode']) === 'true' }}" />
</x-forms.field> 