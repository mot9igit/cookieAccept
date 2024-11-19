<div class="cookie_notification">
    <button class="cookie_notification__close cookie_accept"></button>
    <p>Этот сайт использует файлы cookies и сервисы сбора технических данных посетителей (данные об IP-адресе, местоположении и др.) для обеспечения работоспособности и улучшения качества обслуживания. Продолжая использовать наш сайт, вы автоматически соглашаетесь с использованием данных технологий.</p>
    <div class="cookie_notification__buttons_container">
        <button class="cookie_notification__button cookie_accept">Хорошо</button>
        {if $policy_page}
            <a href="{$policy_page}" class="cookie_notification__button-secondary" target="_blank">Политика конфиденциальности</a>
        {/if}
    </div>
</div>