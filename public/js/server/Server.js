function Server() {

    let token;

    this.rotateTower = function (angle) {
        return $.get('api', { method: 'rotateTower', angle, token });
        //transform - поворот за движением мыши
    };

    this.moveMob = function () {
        return $.get('api', { method: 'moveMob', token });
    };

    this.shoting = function () {
        return $.get('api', { method: 'shoting', token });
        //Линия пересекает ли моба(круг)
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