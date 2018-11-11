function Server() {

    let token;

    this.rotateTower = function (id, angle) {
        return $.get('api', { method: 'rotateTower', id, angle, token });
    };

    this.getStruct =  function () {
        return $.get('api', { method: 'getStruct', token });
    };

    this.login = async function (login, password) {
        const result = await $.get('api', { method: 'login', login, password });
        if (result.result) {
            token = result.data;
        }
        return result.result;
    };

    this.logout = async function (token) {
        const logout = await $.get('api', { method: 'logout', token});
        return logout;
    };
}