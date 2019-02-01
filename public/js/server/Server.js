function Server() {

    let token;

    this.rotateTower = function (angle) {
        return $.get('api', { method: 'rotateTower', angle, token });
        //transform - поворот за движением мыши
    };

    this.finishMob  = () => {
        return $.get('api', { method: 'finishMob'  , token});
    };

    this.moveMob = function (move) {
        return $.get('api', { method: 'moveMob', move, token});
    };

    this.shoting = function (shot) {
        return $.get('api', { method: 'shoting',shot, token });
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