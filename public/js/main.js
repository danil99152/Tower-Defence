$(document).ready(async function() {
    const server = new Server();
    const user = new User({ server, callbacks: { loginSuccess, logoutSuccess } });
    const game = new Game({ server, callbacks: {} });

    function loginSuccess() {
        showPage('game-menu');
    }

    function logoutSuccess() {
        showPage('log-in');
    }

    function showPage(className) {
        $('.log-in').hide();
        $('.game-menu').hide();
        $('.' + className).show();
    }

    showPage('log-in');
});
