$(document).ready(async function() {
    const server = new Server();
    const canvas = new Canvas();

    function render(data) {
        const SIZE = 40;
        canvas.clear();
        const map = data.map;
        for (let i = 0; i < map.length; i++) {
            for (let j = 0; j < map[i].length; j++) {
                const color = (map[i][j].type === 'mount') ? 'blue' : 'green';
                canvas.printRect(i * SIZE, j * SIZE, SIZE, SIZE, color);
            }
        }
    }

    document.getElementById('auth').onclick = async function () {
        const login = document.getElementById('login').value;
        const password = document.getElementById('password').value;
        if (login && password) {
            const result  = await server.login(login, password);
            if (result) {
                console.log('Жизнь удалась!!!');
                
                document.getElementById('login').style.display ="none";
                document.getElementById('password').style.display ="none";
                document.getElementById('auth').style.display ="none";
                document.getElementById('GS').style.display ="inline";
                document.getElementById('logout').style.display ="inline";
                document.getElementById('choise').style.display="inline";
            } else {
                console.log('Ваще все плохо!');
            }
        }
    };

    document.getElementById('logout').onclick = async function () {
        const login = document.getElementById('login').value;
        const password = document.getElementById('password').value;
        const result = await $.get('api', { method: 'login', login, password });
        const token = result.data;
        const logout = await server.logout(token);
        if (logout){
            console.log('Чел вышел, токен удален');
            document.getElementById('login').style.display ="inline";
            document.getElementById('password').style.display ="inline";
            document.getElementById('auth').style.display ="inline";
            document.getElementById('GS').style.display ="none";
            document.getElementById('logout').style.display ="none";
            document.getElementById('choise').style.display="none";
        }
    };

    document.getElementById('GS').onclick = async function () {
        // выставить игроку его выбранный режим игры
        // запустить интервал обновления данных на клиенте (запрашивать getStruct)
        // скрыть элементы управления, показать карту
        const result = await server.getStruct();
        if (result.result) {
            render(result.data);
        }
    };
});
