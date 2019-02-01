function Server() {

    let token;

    this.changeTower = function (change) {
        return $.get('api', { method: 'changeTower', change, token });
        //transform - поворот за движением мыши
    };

    this.moveMob = function (move) {
        return $.get('api', { method: 'moveMob', move, token});
    };

    this.getStruct = function () {
        return $.get('api', { method: 'getStruct', token });
    };

    this.login = async function (login, password) {
        const result = await $.get('api', { method: 'login', login, password });
        if (result.result) {
            token = result.data;
        }
        return result.result;
    };

    this.logout = function () {
        return $.get('api', { method: 'logout', token});
    };

    this.startGame = function(method){
        return $.get('api', { method, token});
    };
}