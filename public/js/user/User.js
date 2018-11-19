function User(options) {

    const server = options.server;
    const callbacks = options.callbacks || {};
    const loginSuccess = callbacks.loginSuccess;
    const logoutSuccess = callbacks.logoutSuccess;

    function init() {
        $('#auth').on('click', async () => {
            const login = $('#login').val();
            const password = $('#password').val();
            if (login && password) {
                const result = await server.login(login, password);
                if (result) {
                    loginSuccess();
                } else {
                    alert('Неудачная авторизация!');
                }
            } else {
                alert('Введите логин и пароль!');
            }
        });

        $('#logout').on('click', async () => {
            const result = await server.logout();
            if (result.result) {
                logoutSuccess();
            } else {
                alert('Что-то сломалось, вылогиниться не удалось!');
            }
        });
    }
    init();
}