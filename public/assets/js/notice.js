document.addEventListener('DOMContentLoaded', function () {
    const flashMessages = document.querySelectorAll('.flash-message');
    flashMessages.forEach(msg => {
        setTimeout(() => {
            msg.remove();
        }, 5000);
    });
});