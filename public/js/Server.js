function Server() {

    this.rotateTower = function (id, angle) {
<<<<<<< HEAD
        return $.get('api', { method: 'rotateTower', id, angle });
=======
        return $.get('api', { method: 'rotateTower', id, angle, token });
    };

    this.getStruct =  function () {
        return $.get('api', { method: 'getStruct', token });
>>>>>>> parent of a708a93... Добавлены методы в BD, настроена кнопка "Начать игру"
    };

    this.getStruct =  function () {
        return $.get('api', { method: 'getStruct' });
    };

}