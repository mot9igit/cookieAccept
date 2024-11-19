// cookieAccept
function checkCookies() {
    let cookieDate = localStorage.getItem('cookieDate');
    let cookieNotification = document.querySelector('.cookie_notification');
    if(cookieNotification) {
        let cookieBtn = cookieNotification.querySelectorAll('.cookie_accept');

        if (!cookieDate || (+cookieDate + Number(cookieacceptConfig.cookie_lifetime)) < Date.now()) {
            cookieNotification.classList.add('cookie_notification__show');
        }
        cookieBtn.forEach((el) => {
            el.addEventListener('click', function () {
                localStorage.setItem('cookieDate', Date.now());
                cookieNotification.classList.remove('cookie_notification__show');
            })
        })
    }
}

document.addEventListener('DOMContentLoaded', function() {
    checkCookies();
})