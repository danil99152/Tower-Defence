function Server() {

    let token;

<<<<<<< HEAD
    this.rotateTower = function (angle) {
        return $.get('api', { method: 'rotateTower', angle, token });
    };

    this.getStruct = function () {
        return $.get('api', { method: 'getStruct', token });
=======
    this.rotateTower = function (id, angle) {
        return $.get('api', { method: 'rotateTower', id, angle, token });
    };

    this.getStruct =  function (token, choise) {
        return $.get('api', { method: 'getStruct', token, choise, });
>>>>>>> a708a937b73539abead501b7a1ff3968627b57ff
    };

    this.login = async function (login, password) {
        const result = await $.get('api', { method: 'login', login, password });
        if (result.result) {
            token = result.data;
        }
        return result.result;
    };

<<<<<<< HEAD
    this.logout = function () {
        return $.get('api', { method: 'logout', token});
=======
    this.logout = async function (token) {
        const logout = await $.get('api', { method: 'logout', token});
        return logout;
>>>>>>> a708a937b73539abead501b7a1ff3968627b57ff
    };
}