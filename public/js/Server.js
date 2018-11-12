function Server() {

    this.rotateTower = function (id, angle) {
        return $.get('api', { method: 'rotateTower', id, angle });
    };

    this.getStruct =  function () {
        return $.get('api', { method: 'getStruct' });
    };

}