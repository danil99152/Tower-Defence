$(document).ready(async function() {
    const server = new Server();
    const canvas = new Canvas();

    const result = await server.getStruct();

    const SIZE = 40;
    if (result.result) {
        canvas.clear();
        const map = result.data.map;
        for (let i = 0; i < map.length; i++) {
            for (let j = 0; j < map[i].length; j++) {
                const color = (map[i][j].type === 'mount') ? 'blue' : 'green';
                canvas.printRect(i * SIZE, j * SIZE, SIZE, SIZE, color);
            }
        }
<<<<<<< HEAD
    }
});
=======
    }*/

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
        }
    };

    document.getElementById('GS').onclick = async function () {

    };
});
>>>>>>> parent of a708a93... Добавлены методы в BD, настроена кнопка "Начать игру"
